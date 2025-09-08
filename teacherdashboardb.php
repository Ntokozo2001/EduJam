<?php
include_once "db_config.php";
session_start();
if (!isset($_SESSION['teacher_id']) || intval($_SESSION['teacher_id']) <= 0) {
    header("Location: login.php");
    exit();
}

$teacher_id = intval($_SESSION['teacher_id']);
$data = null;

if ($teacher_id > 0) {
    $stmt = $conn->prepare("SELECT id, school_id, first_name, surname, subjects, experience_years, cv_filename, created_at, email FROM teachers WHERE id = ?");
    $stmt->bind_param("i", $teacher_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $data = $row;
    }
    $stmt->close();
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
