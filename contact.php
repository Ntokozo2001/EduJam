<?php include_once "header.php"; ?>
<link rel="stylesheet" href="contact.css">
<p>&nbsp</p>
<div class="contact-hero">
    <div class="contact-card">
        <h1>Contact Us</h1>
        <p class="contact-desc">
            Need help or have a question? Fill out the form below and our team will get back to you as soon as possible.
        </p>
        <form class="contact-form" method="post" action="contactb.php">
            <div class="contact-row">
                <label for="name">Your Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="contact-row">
                <label for="email">Your Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="contact-row">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="contact-btn">Send Message</button>
        </form>
        <div class="contact-info">
            <p><b>Email:</b> support@edujam.com</p>
            
        </div>
    </div>
</div>
<footer class="main-footer">
    <p>&copy; <?php echo date("Y"); ?> AI-Powered Exam Question Generator. All rights reserved.</p>
</footer>
