<?php include_once "header.php"; ?>
<link rel="stylesheet" href="examgen.css">
<p>&nbsp</p>
<div class="examgen-hero">
    <div class="examgen-card">
        <h1>Generate Exam Questions</h1>
        <form class="examgen-form" id="examgen-form" method="post" action="examgenb.php">
            <div class="examgen-row">
                <label for="school">School</label>
                <select id="school" name="school" required>
                    <option value="">Select School</option>
                    <option value="Nizamiye">Nizamiye</option>
                    <option value="Fatih">Fatih</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="examgen-row">
                <label for="subject">Subject</label>
                <select id="subject" name="subject" required>
                    <option value="">Select Subject</option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Physics">Physics</option>
                    <option value="Chemistry">Chemistry</option>
                    <option value="Biology">Biology</option>
                    <option value="English">English</option>
                    <option value="History">History</option>
                    <option value="Geography">Geography</option>
                    <option value="Computer Science">Computer Science</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="examgen-row">
                <label for="grade">Grade</label>
                <select id="grade" name="grade" required>
                    <option value="">Select Grade</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
            </div>
            <div class="examgen-row">
                <label for="topic">Topic</label>
                <select id="topic" name="topic" required>
                    <option value="">Select Topic</option>
                    <option value="Algebraic Expressions">Algebraic Expressions</option>
                    <option value="Quadratic Equations">Quadratic Equations</option>
                    <option value="Photosynthesis">Photosynthesis</option>
                    <option value="Periodic Table">Periodic Table</option>
                    <option value="World War II">World War II</option>
                    <option value="Programming Basics">Programming Basics</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="examgen-row">
                <label for="num_questions">Number of Questions</label>
                <input type="number" id="num_questions" name="num_questions" min="1" max="50" required>
            </div>
            <button type="submit" class="examgen-btn">Generate Exam</button>
        </form>
        <div class="examgen-divider"><span>or</span></div>
        <form class="examgen-form" id="custom-question-form" method="post" action="examgenb.php">
            <div class="examgen-row">
                <label for="custom_prompt">Ask a Custom Question</label>
                <textarea id="custom_prompt" name="custom_prompt" rows="3" placeholder="Type your custom exam question request here..."></textarea>
            </div>
            <button type="submit" class="examgen-btn">Ask AI</button>
        </form>
    </div>
    <div id="examgen-output" class="examgen-output" style="display:none;">
        <div class="examgen-output-header">
            <h2>Generated Exam Questions</h2>
            <button class="pdf-btn" onclick="downloadPDF()">Download as PDF</button>
        </div>
        <div id="examgen-questions" class="examgen-questions">
            <!-- AI-generated questions will appear here -->
        </div>
    </div>
</div>
<footer class="main-footer">
    <p>&copy; <?php echo date("Y"); ?> AI-Powered Exam Question Generator. All rights reserved.</p>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
function showExamgenOutput() {
    document.getElementById('examgen-output').style.display = 'block';
    window.scrollTo({top: document.getElementById('examgen-output').offsetTop - 40, behavior: 'smooth'});
}

// Handle standard exam generation form
document.getElementById('examgen-form').onsubmit = function(e) {
    e.preventDefault();
    let form = e.target;
    let formData = new FormData(form);

    // Always show the output box, even before response
    showExamgenOutput();
    document.getElementById('examgen-questions').innerHTML = "<div class='exam-question'>Generating questions, please wait...</div>";

    fetch('examgenb.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('examgen-questions').innerHTML = data;
        showExamgenOutput();
    })
    .catch(() => {
        document.getElementById('examgen-questions').innerHTML = "<div class='exam-question'>Failed to generate questions. Please try again.</div>";
        showExamgenOutput();
    });
};

// Handle custom prompt form
document.getElementById('custom-question-form').onsubmit = function(e) {
    e.preventDefault();
    let form = e.target;
    let formData = new FormData(form);

    showExamgenOutput();
    document.getElementById('examgen-questions').innerHTML = "<div class='exam-question'>working on it, please wait...</div>";

    fetch('examgenb.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('examgen-questions').innerHTML = data;
        showExamgenOutput();
    })
    .catch(() => {
        document.getElementById('examgen-questions').innerHTML = "<div class='exam-question'>Failed to generate questions. Please try again.</div>";
        showExamgenOutput();
    });
};

function downloadPDF() {
    const { jsPDF } = window.jspdf;
    let doc = new jsPDF();
    let content = Array.from(document.querySelectorAll('.exam-question')).map(q => q.innerText).join('\n\n');
    doc.setFont("helvetica", "bold");
    doc.setFontSize(16);
    doc.text("Generated Exam Questions", 14, 18);
    doc.setFont("helvetica", "normal");
    doc.setFontSize(12);
    doc.text(content, 14, 30);
    doc.save("exam-questions.pdf");
}
</script>
