<?php include_once "header.php"; ?>
<link rel="stylesheet" href="register.css">
<p>&nbsp</p>
<div class="register-hero">
    <div class="register-card">
        <h1>Teacher Registration</h1>
        <form class="register-form" method="post" enctype="multipart/form-data" action="registerb.php">
            <div class="register-row">
                <label for="school">School</label>
                <select id="school" name="school" required>
                    <option value="">Select your school</option>
                    <option value="Nizamiye">Nizamiye</option>
                    <option value="Fatih">Fatih</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="register-row">
                <label for="name">First Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="register-row">
                <label for="surname">Surname</label>
                <input type="text" id="surname" name="surname" required>
            </div>
            <div class="register-row">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email">
            </div>
            <div class="register-row" id="subjects-row">
                <label>Subjects</label>
                <div id="subjects-list">
                    <input type="text" name="subjects[]" class="subject-input" required placeholder="Enter subject">
                </div>
                <button type="button" class="add-subject-btn" onclick="addSubjectField()">+ Add Another Subject</button>
            </div>
            <div class="register-row">
                <label for="cv">Upload CV</label>
                <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx" required>
            </div>
            <div class="register-row">
                <label for="experience">Experience (years)</label>
                <input type="number" id="experience" name="experience" min="0" required>
            </div>
            
            <div class="register-row">
                <label for="password">Password</label>
                <div style="position:relative;">
                    <input type="password" id="password" name="password" required minlength="6" placeholder="Enter password">
                    <span onclick="togglePassword('password', this)" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);cursor:pointer;font-size:1.1em;">👁️</span>
                </div>
            </div>
            <div class="register-row">
                <label for="confirm_password">Confirm Password</label>
                <div style="position:relative;">
                    <input type="password" id="confirm_password" name="confirm_password" required minlength="6" placeholder="Re-enter password">
                    <span onclick="togglePassword('confirm_password', this)" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);cursor:pointer;font-size:1.1em;">👁️</span>
                </div>
            </div>
            <button type="submit" class="register-btn">Register</button>
        </form>
        <div class="register-login-link">
            Already have an account?
            <a href="login.php">Login here</a>
        </div>
    </div>
</div>
<footer class="main-footer">
    <p>&copy; <?php echo date("Y"); ?> AI-Powered Exam Question Generator. All rights reserved.</p>
</footer>
<script>
function addSubjectField() {
    var container = document.getElementById('subjects-list');
    var input = document.createElement('input');
    input.type = 'text';
    input.name = 'subjects[]';
    input.className = 'subject-input';
    input.required = true;
    input.placeholder = 'Enter subject';
    container.appendChild(input);
}

// Toggle password visibility
function togglePassword(fieldId, icon) {
    var input = document.getElementById(fieldId);
    if (input.type === "password") {
        input.type = "text";
        icon.textContent = "🙈";
    } else {
        input.type = "password";
        icon.textContent = "👁️";
    }
}
</script>
