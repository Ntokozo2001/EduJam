<?php
include_once "db_config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        die("Email and password are required.");
    }

    $stmt = $conn->prepare("SELECT id, password FROM teachers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            // Login success: set session or redirect
            session_start();
            $_SESSION['teacher_id'] = $user_id;
            $_SESSION['logged_in'] = true; // Keep session active
            $stmt->close();
            header("Location: teacherdashboard.php");
            exit();
        } else {
            $stmt->close();
            die("Invalid email or password.");
        }
    } else {
        $stmt->close();
        die("Invalid email or password.");
    }
}

$conn->close();
?>
