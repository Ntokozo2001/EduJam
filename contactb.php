<?php
include_once "db_config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (empty($name) || empty($email) || empty($message)) {
        die("All fields are required.");
    }

    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        // Success: redirect or show message
        $stmt->close();
        header("Location: contact.php?success=1");
        exit();
    } else {
        $error = $stmt->error;
        $stmt->close();
        die("Failed to send message: " . $error);
    }
}

$conn->close();
?>