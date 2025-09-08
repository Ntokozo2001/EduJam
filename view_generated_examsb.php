<?php
include_once "db_config.php";

// Fetch all question papers, newest first
$sql = "SELECT id, title, subject, grade_level, teacher_id, questions, created_at FROM question_papers ORDER BY created_at DESC";
$result = $conn->query($sql);

$papers = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $papers[] = $row;
    }
}

// Output as JSON for frontend AJAX or include as needed
header('Content-Type: application/json');
echo json_encode($papers);

$conn->close();
?>
