<?php
session_start();
if (!isset($_SESSION['teacher_id']) || intval($_SESSION['teacher_id']) <= 0) {
    header("Location: login.php");
    exit();
}
include_once "header.php";
?>
<link rel="stylesheet" href="tdashboard.css">
<style>
    .info-value {
        word-wrap: break-word;
        white-space: pre-wrap;
        max-height: 100px;
        overflow-y: auto;
    }
</style>
<div class="dashboard-flex">
    <aside class="dashboard-sidebar">
        <h3>Quick Actions</h3>
        <div class="actions-list">
            <a href="examgen.php" class="dashboard-action">Generate Exam Papers</a>
            <a href="view_generated_exams.php" class="dashboard-action">View Generated Exams</a>
            <a href="edit_profile.php" class="dashboard-action">Edit Profile</a>
            <a href="logout.php" class="dashboard-action">Logout</a>
        </div>
    </aside>
    <div class="dashboard-container" id="dashboard-container">
        <!-- Content will be filled by JS -->
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    fetch('teacherdashboardb.php')
        .then(response => response.json())
        .then(data => {
            if (!data) {
                document.getElementById('dashboard-container').innerHTML = "<div style='color:red;'>Teacher data not found.</div>";
                return;
            }
            // Welcome section
            let welcome = `
                <section class="dashboard-welcome">
                    <div class="dashboard-3d-avatar">
                        <div class="avatar-shadow"></div>
                        <div class="avatar-3d">
                            <img src="images/nizamiyelogo.png" alt="Teacher Avatar">
                        </div>
                    </div>
                    <h2>Welcome, ${data.first_name} ${data.surname}</h2>
                    <p class="welcome-desc">
                        Here is your personalized dashboard. Access your tools, manage your exams, and view your teaching stats!
                    </p>
                </section>
            `;
            // Info cards
            let info = `
                <section class="teacher-info-cards">
                    <div class="info-card">
                        <div class="info-icon">📚</div>
                        <div>
                            <div class="info-label">Subjects</div>
                            <div class="info-value">${data.subjects.replace(/,/g, '<br>')}</div>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-icon">🗓️</div>
                        <div>
                            <div class="info-label">Experience</div>
                            <div class="info-value">${data.experience_years} Years</div>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-icon">📄</div>
                        <div>
                            <div class="info-label">CV</div>
                            <div class="info-value"><a href="uploads/cv/${data.cv_filename}" target="_blank">Download CV</a></div>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-icon">📧</div>
                        <div>
                            <div class="info-label">Email</div>
                            <div class="info-value">${data.email}</div>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-icon">🕒</div>
                        <div>
                            <div class="info-label">Joined</div>
                            <div class="info-value">${(new Date(data.created_at)).toLocaleDateString()}</div>
                        </div>
                    </div>
                </section>
            `;
            // ...you can add more dynamic sections as needed...
            document.getElementById('dashboard-container').innerHTML = welcome + info +
                `<!-- ...existing static or dynamic sections can follow here... -->`;
        })
        .catch(error => {
            console.error("Error fetching teacher data:", error);
            document.getElementById('dashboard-container').innerHTML = "<div style='color:red;'>Failed to load teacher data.</div>";
        });
});
</script>
        </section>
    </div>
</div>
