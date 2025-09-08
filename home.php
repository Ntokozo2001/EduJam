<?php include_once "header.php"; ?>
<link rel="stylesheet" href="home.css">
<p>&nbsp</p>
<div class="home-hero">
    <div class="hero-content">
        <h1>
            <span class="hero-ai">AI Powered Learning</span> <br>
            Exam Generation & Study Buddy
        </h1>
        <p class="hero-desc">
            Create, customize, and manage exam questions with advanced AI tools.<br>
            Access your personal Study Buddy for interactive learning, revision, and support.<br>
            Designed for teachers, lecturers, and students to make education engaging, efficient, and collaborative.
        </p>
    <a href="#explore-section" class="hero-btn">Explore</a>
    </div>
    <div class="hero-3d">
        <div class="cube">
            <div class="face front">AI</div>
            <div class="face back">?</div>
            <div class="face right">Study</div>
            <div class="face left">Buddy</div>
            <div class="face top">EXAM</div>
            <div class="face bottom">GEN</div>
        </div>
    </div>
</div>
<!-- Mission & Vision Section -->
<style>
    .mv-section {
        display: flex;
        justify-content: center;
        gap: 40px;
        margin: 60px 0;
    }
    .mv-card {
        background: rgba(60, 50, 120, 0.5);
        border-radius: 32px;
        box-shadow: 0 4px 32px rgba(0,0,0,0.12);
        padding: 40px 32px 32px 32px;
        color: #d1d5f6;
        width: 420px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        transition: box-shadow 0.2s;
    }
    .mv-card:hover {
        box-shadow: 0 8px 40px rgba(80,60,180,0.18);
    }
    .mv-icon {
        background: #7c6cf7;
        border-radius: 50%;
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
    }
    .mv-title {
        font-size: 2.1rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .mv-desc {
        font-size: 1.18rem;
        margin-bottom: 28px;
        color: #d1d5f6;
    }
    .mv-tags {
        background: #7c6cf7;
        color: #fff;
        border-radius: 22px;
        padding: 10px 28px;
        font-weight: 600;
        font-size: 1.08rem;
        letter-spacing: 0.02em;
        margin-top: 8px;
        box-shadow: 0 2px 12px rgba(124,108,247,0.12);
    }
    @media (max-width: 900px) {
        .mv-section {
            flex-direction: column;
            align-items: center;
            gap: 28px;
        }
        .mv-card {
            width: 95vw;
            max-width: 420px;
        }
    }
</style>
<div class="mv-section">
    <div class="feature-card">
        <div class="feature-icon">🚀</div>
        <h3>Our Mission</h3>
        <p>Empower every learner and educator with accessible, engaging robotics and AI experiences that spark creativity, critical thinking, and real-world problem solving.</p>
    </div>
    <div class="feature-card">
        <div class="feature-icon">👁️</div>
        <h3>Our Vision</h3>
        <p>To create a future where all students and teachers can innovate, collaborate, and excel in technology and robotics, shaping the next generation of leaders and creators.</p>
    </div>
</div>
<section class="features-section">
    <h2>Why Choose Us?</h2>
    <div class="features-list">
        <div class="feature-card">
            <div class="feature-icon">🤖</div>
            <h3>AI-Driven</h3>
            <p>Generate high-quality, curriculum-aligned questions in seconds using advanced AI.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">⚡</div>
            <h3>Save Time</h3>
            <p>Automate repetitive tasks and spend more time engaging with your students.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🎯</div>
            <h3>Customizable</h3>
            <p>Tailor questions to your subject, difficulty, and specific classroom needs.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🔒</div>
            <h3>Secure & Private</h3>
            <p>Your data and exam papers are safe, secure, and accessible only to you.</p>
        </div>
    </div>
</section>
    <!-- Explore Section -->
    <h2 id="explore-section" style="text-align:center; color:#15305D; font-size:2.3rem; font-weight:900; margin-top:60px;">Explore</h2>
    <section class="roles-section">
        <h2>For Teachers, Lecturers & Students</h2>
        <p>Empowering educators and learners with resources, tools, and collaborative opportunities for robotics and technology education.</p>
        <div class="roles-container">
            <div class="role-card">
                <div class="role-icon"><span>🧑‍🏫</span></div>
                <h3>Lectures and Teachers</h3>
                <ul>
                    <li>Saves Time – Automates question paper creation</li>
                    <li>Generates Variety – Prevents repetition of the same questions</li>
                    <li>Customizable – Choose subject, topic, and difficulty</li>
                    <li>Instant Exam Papers – Ready-to-use question sets</li>
                    <li>Improves Fairness – Balanced mix of easy, medium, and hard questions</li>
                </ul>
                    <a href="teacherdashboard.php" class="hero-btn" style="margin-top:12px;">Sign Up (Teachers/Lecturers)</a>
            </div>
            <div class="role-card">
                <div class="role-icon"><span>🎓</span></div>
                <h3>Students</h3>
                <ul>
                    <li>Unlimited Practice – Fresh questions every time</li>
                    <li>Adaptive Difficulty – Practice from easy to challenging levels</li>
                    <li>Instant Feedback – Correct answers and explanations</li>
                    <li>Boosts Confidence – More exposure to exam-style questions</li>
                    <li>Personalized Learning – Focus on weak topics</li>
                </ul>
                    <a href="register.php" class="hero-btn" style="margin-top:12px;">Sign Up (Students)</a>
            </div>
        </div>
    </section>
<section class="cta-section">
    <h2>Ready to revolutionize your exam creation?</h2>
    <a href="teacherdashboard.php" class="cta-btn">Join Now</a>
    <a href="admindash.php" class="cta-btn">admin view</a>
</section>
<footer class="main-footer">
    <p>&copy; <?php echo date("Y"); ?> EduJam. All rights reserved.</p>
</footer>
