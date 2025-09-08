<?php include_once "header.php"; ?>
<link rel="stylesheet" href="register.css">
<p>&nbsp</p>
<div class="register-hero">
    <div class="register-card">
        <h1>Teacher Login</h1>
        <form class="register-form" method="post" action="loginb.php">
            <div class="register-row">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="register-row">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="register-btn">Login</button>
        </form>
        <div style="margin-top:18px;">
            <span>Don't have an account?</span>
            <a href="register.php" style="color:#6b082e;font-weight:600;text-decoration:underline;">Register</a>
        </div>
    </div>
</div>
<footer class="main-footer">
    <p>&copy; <?php echo date("Y"); ?> AI-Powered Exam Question Generator. All rights reserved.</p>
</footer>
