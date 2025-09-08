<?php
include_once "db_config.php";
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="images/edujam2.png" type="image/x-icon">
    <title>EduJam</title>
    <link rel="stylesheet" href="header.css">
</head>
<body>
    <?php
        // Determine current page for active nav link
        $current_page = basename($_SERVER['PHP_SELF']);
    ?>
    <header class="main-header">
        <a href="home.php" class="header-link" style="text-decoration: none;">
            <div class="header-top">
                <div class="logo-container">
                    <img src="images/edujam1.png" alt="EduJam Logo" class="logo-img">
                    <span class="logo-text" > EDUJAM</span>
                </div>
            </div>
        </a>
        <div class="header-bottom">
            <div class="header-content">
                <nav class="header-nav">
                    <a href="home.php" class="nav-link<?php if($current_page=='home.php') echo ' active'; ?>"<?php if($current_page=='home.php') echo ' aria-current="page"'; ?>>Home</a>
                    <a href="teacherdashboard.php" class="nav-link<?php if($current_page=='teacherdashboard.php') echo ' active'; ?>"<?php if($current_page=='teacherdashboard.php') echo ' aria-current="page"'; ?>>Dashboard</a>
                    <a href="register.php" class="nav-link<?php if($current_page=='register.php') echo ' active'; ?>"<?php if($current_page=='register.php') echo ' aria-current="page"'; ?>>Register</a>
                    <a href="login.php" class="nav-link<?php if($current_page=='login.php') echo ' active'; ?>"<?php if($current_page=='login.php') echo ' aria-current="page"'; ?>>Login</a>
                    <a href="contact.php" class="nav-link<?php if($current_page=='contact.php') echo ' active'; ?>"<?php if($current_page=='contact.php') echo ' aria-current="page"'; ?>>Contact</a>
                     <a href="about.php" class="nav-link<?php if($current_page=='about.php') echo ' active'; ?>"<?php if($current_page=='about.php') echo ' aria-current="page"'; ?>>About</a>
                </nav>
            </div>
        </div>
    </header>
</body>
</html>
