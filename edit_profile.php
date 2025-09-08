<!DOCTYPE html>
<?php 
include_once "header.php"; 
include_once "db_config.php";
session_start();

if (!isset($_SESSION['teacher_id']) || intval($_SESSION['teacher_id']) <= 0) {
    header("Location: login.php");
    exit();
}

$teacher_id = intval($_SESSION['teacher_id']);
$stmt = $conn->prepare("SELECT first_name, surname, subjects, experience_years, cv_filename, email FROM teachers WHERE id = ?");
$stmt->bind_param("i", $teacher_id);
$stmt->execute();
$stmt->bind_result($first_name, $surname, $subjects, $experience_years, $cv_filename, $email);
$stmt->fetch();
$stmt->close();
$conn->close();
?>
<html>
<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" type="text/css" href="edit_profile.css">
    <script>
    function addSubjectField() {
        var subjectsList = document.getElementById('subjects-list');
        var input = document.createElement('input');
        input.type = 'text';
        input.name = 'subjects[]';
        input.className = 'subject-input';
        input.placeholder = 'Enter subject';
        input.required = true;
        subjectsList.appendChild(input);
    }
    </script>
</head>
<body>
    <header>
        <h1>Edit Profile</h1>
    </header>
    <div class="edit-profile-container">
        <form class="edit-profile-form" method="post" enctype="multipart/form-data" action="edit_profileb.php">
            <div class="register-row">
                <label for="name">First Name</label>
                <input type="text" id="name" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" required>
            </div>
            <div class="register-row">
                <label for="surname">Surname</label>
                <input type="text" id="surname" name="surname" value="<?php echo htmlspecialchars($surname); ?>" required>
            </div>
            <div class="register-row">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="register-row" id="subjects-row">
                <label>Subjects</label>
                <div id="subjects-list">
                    <?php 
                    $subjects_array = explode(",", $subjects);
                    foreach ($subjects_array as $subject) {
                        echo '<input type="text" name="subjects[]" class="subject-input" value="' . htmlspecialchars($subject) . '" required>';
                    }
                    ?>
                </div>
                <button type="button" class="add-subject-btn" onclick="addSubjectField()">+ Add Another Subject</button>
            </div>
            <div class="register-row">
                <label for="experience">Experience (years)</label>
                <input type="number" id="experience" name="experience_years" value="<?php echo htmlspecialchars($experience_years); ?>" min="0" required>
            </div>
            <div class="register-row">
                <label for="cv">Upload CV</label>
                <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx">
                <?php if (!empty($cv_filename)): ?>
                    <p>Current CV: <a href="uploads/cv/<?php echo htmlspecialchars($cv_filename); ?>" target="_blank">Download CV</a></p>
                <?php endif; ?>
            </div>
            <button type="submit" class="save-btn register-btn">Save Changes</button>
        </form>
    </div>
</body>
</html>
