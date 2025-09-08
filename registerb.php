<?php
include_once "db_config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get and sanitize input
    $school = trim($_POST['school']);
    $first_name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);
    $subjects = isset($_POST['subjects']) ? $_POST['subjects'] : [];
    $experience = intval($_POST['experience']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate required fields
    if (
        empty($school) || empty($first_name) || empty($surname) ||
        empty($email) || empty($subjects) || empty($experience) ||
        empty($password) || empty($confirm_password)
    ) {
        die("All fields are required.");
    }

    // Password match check
    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Email uniqueness check
    $stmt = $conn->prepare("SELECT id FROM teachers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        die("Email already registered.");
    }
    $stmt->close();

    // Handle CV upload
    $cv_filename = "";
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
        $allowed_ext = ['pdf', 'doc', 'docx'];
        $file_tmp = $_FILES['cv']['tmp_name'];
        $file_name = basename($_FILES['cv']['name']); // Fixed: missing closing quote
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if (!in_array($file_ext, $allowed_ext)) {
            die("Invalid CV file type.");
        }
        $cv_filename = uniqid("cv_") . "." . $file_ext;
        $upload_dir = "uploads/cv/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        if (!move_uploaded_file($file_tmp, $upload_dir . $cv_filename)) {
            die("Failed to upload CV.");
        }
    } else {
        die("CV upload required.");
    }

    // Prepare data for DB
    $subjects_str = implode(",", array_map('trim', $subjects));
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Get school_id (if not found, insert as 'Other' or set to a default valid id)
    $school_id = null;
    $school_stmt = $conn->prepare("SELECT id FROM schools WHERE name = ?");
    $school_stmt->bind_param("s", $school);
    $school_stmt->execute();
    $school_stmt->bind_result($school_id_result);
    if ($school_stmt->fetch()) {
        $school_id = $school_id_result;
    }
    $school_stmt->close();

    // If school_id is still null, set to a default value (e.g., for 'Other')
    if ($school_id === null) {
        // Try to get 'Other' school id, or insert it if not exists
        $other_school = "Other";
        $other_stmt = $conn->prepare("SELECT id FROM schools WHERE name = ?");
        $other_stmt->bind_param("s", $other_school);
        $other_stmt->execute();
        $other_stmt->bind_result($other_id);
        if ($other_stmt->fetch()) {
            $school_id = $other_id;
        } else {
            $other_stmt->close();
            // Insert 'Other' school if not exists
            $insert_stmt = $conn->prepare("INSERT INTO schools (name) VALUES (?)");
            $insert_stmt->bind_param("s", $other_school);
            if ($insert_stmt->execute()) {
                $school_id = $insert_stmt->insert_id;
            }
            $insert_stmt->close();
        }
        $other_stmt->close();
    }

    // Insert into teachers table
    $stmt = $conn->prepare("INSERT INTO teachers (school_id, first_name, surname, subjects, experience_years, cv_filename, created_at, email, password) VALUES (?, ?, ?, ?, ?, ?, NOW(), ?, ?)");
    $stmt->bind_param(
        "isssisss",
        $school_id,
        $first_name,
        $surname,
        $subjects_str,
        $experience,
        $cv_filename,
        $email,
        $hashed_password
    );
    if ($stmt->execute()) {
        // Registration successful
        $stmt->close();
        header("Location: login.php?registered=1");
        exit();
    } else {
        $error = $stmt->error;
        $stmt->close();
        die("Registration failed: " . $error);
    }
}

$conn->close();
?>