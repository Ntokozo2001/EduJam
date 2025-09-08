<?php
include_once "db_config.php";
session_start();

// Function: Generate exam questions using OpenAI API (OpenRouter)
function generate_questions_with_custom_gpt($prompt) {
    $api_url = "https://openrouter.ai/api/v1/chat/completions";
    $api_key = "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"; // Replace with your real API key

    $data = [
        "model" => "openai/gpt-4o",
        "messages" => [
            ["role" => "user", "content" => $prompt]
        ],
        // Reduce max_tokens for faster response (try 256 or 512)
        "max_tokens" => 512,
        "temperature" => 0.7
    ];

    $headers = [
        "Content-Type: application/json",
        "Authorization: Bearer $api_key"
    ];

    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    // Set a lower timeout for faster failover (10 seconds)
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        error_log("Curl error: " . curl_error($ch));
        curl_close($ch);
        return "Curl error: " . curl_error($ch);
    }

    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code !== 200) {
        error_log("OpenAI API HTTP error $http_code. Response: $response");
        return "OpenAI API error ($http_code): $response";
    }

    $result = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("JSON decode error: " . json_last_error_msg());
        return "JSON decode error: " . json_last_error_msg();
    }

    if (isset($result['choices'][0]['message']['content'])) {
        return $result['choices'][0]['message']['content'];
    }

    error_log("Unexpected OpenAI API response structure.");
    return "Unexpected OpenAI API response: $response";
}

// Main logic: When form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $teacher_id = isset($_SESSION['teacher_id']) && intval($_SESSION['teacher_id']) > 0 ? intval($_SESSION['teacher_id']) : 1;
    $subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
    $grade = isset($_POST['grade']) ? trim($_POST['grade']) : '';
    $topic = isset($_POST['topic']) ? trim($_POST['topic']) : '';
    $school = isset($_POST['school']) ? trim($_POST['school']) : '';
    $num_questions = isset($_POST['num_questions']) ? intval($_POST['num_questions']) : 0;
    $custom_prompt = isset($_POST['custom_prompt']) ? trim($_POST['custom_prompt']) : '';

    // Improved: Build a clear, concise prompt for the AI using selected options
    if (!empty($custom_prompt)) {
        $prompt = $custom_prompt;
    } else {
        $prompt = "You are an expert exam question generator. ";
        $prompt .= "Create exactly $num_questions ";
        $prompt .= "well-formatted, original exam questions for a ";
        $prompt .= "Grade $grade student in the subject of $subject";
        if (!empty($topic) && strtolower($topic) !== "other") {
            $prompt .= ", focusing on the topic '$topic'";
        }
        if (!empty($school) && strtolower($school) !== "other") {
            $prompt .= " (school: $school)";
        }
        $prompt .= ". Number each question. Do not include answers. Format clearly for easy reading.";
    }

    // Title generation
    $title = (!empty($subject) && !empty($grade) && !empty($topic))
        ? "$subject - Grade $grade - $topic"
        : ((!empty($subject) && !empty($grade)) ? "$subject - Grade $grade" : "Generated Exam Paper");

    // Generate questions via OpenAI
    $questions = generate_questions_with_custom_gpt($prompt);

    // If the API returns an error message instead of real questions
    if (stripos($questions, "error") !== false || stripos($questions, "unexpected") !== false) {
        echo "<div style='color:red;'><strong>Failed to generate questions:</strong><br>$questions</div>";
        exit();
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO question_papers (title, subject, grade_level, teacher_id, questions, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssis", $title, $subject, $grade, $teacher_id, $questions);

    if ($stmt->execute()) {
        // Output formatted questions
        $output = "";
        $lines = preg_split('/\r\n|\r|\n/', $questions);
        foreach ($lines as $line) {
            if (trim($line) !== "") {
                $output .= "<div class='exam-question'>" . htmlspecialchars($line) . "</div>";
            }
        }
        echo $output;
        $stmt->close();
        exit();
    } else {
        $error = $stmt->error;
        $stmt->close();
        die("Failed to save question paper: " . $error);
    }
}

$conn->close();
?>
        $error = $stmt->error;
        $stmt->close();
        die("Failed to save question paper: " . $error);
    }
}

$conn->close();
?>
