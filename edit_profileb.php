<?php
include_once "db_config.php";
session_start();

if (!isset($_SESSION['teacher_id']) || intval($_SESSION['teacher_id']) <= 0) {
    header("Location: login.php");
    exit();
}

$teacher_id = intval($_SESSION['teacher_id']);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = trim($_POST['first_name']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);
    $subjects = isset($_POST['subjects']) ? implode(",", array_map('trim', $_POST['subjects'])) : '';
    $experience_years = intval($_POST['experience_years']);
    $cv_filename = "";

    // Handle CV upload
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
        $allowed_ext = ['pdf', 'doc', 'docx'];
        $file_tmp = $_FILES['cv']['tmp_name'];
        $file_name = basename($_FILES['cv']['name']);
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
    }

    // Update teacher details
    $stmt = $conn->prepare("UPDATE teachers SET first_name = ?, surname = ?, email = ?, subjects = ?, experience_years = ?, cv_filename = ? WHERE id = ?");
    $stmt->bind_param("ssssisi", $first_name, $surname, $email, $subjects, $experience_years, $cv_filename, $teacher_id);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: teacherdashboard.php?profile_updated=1");
        exit();
    } else {
        $error = $stmt->error;
        $stmt->close();
        die("Failed to update profile: " . $error);
    }
}

$conn->close();
?>
