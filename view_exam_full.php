<?php
include_once "header.php";
include_once "db_config.php";

$exam_id = isset($_GET['exam_id']) ? intval($_GET['exam_id']) : 0;
$exam = null;

if ($exam_id > 0) {
    $stmt = $conn->prepare("SELECT title, subject, grade_level, questions, created_at FROM question_papers WHERE id = ?");
    $stmt->bind_param("i", $exam_id);
    $stmt->execute();
    $stmt->bind_result($title, $subject, $grade_level, $questions, $created_at);
    if ($stmt->fetch()) {
        $exam = [
            'title' => $title,
            'subject' => $subject,
            'grade_level' => $grade_level,
            'questions' => $questions,
            'created_at' => $created_at
        ];
    }
    $stmt->close();
}
$conn->close();
?>
<p>&nbsp</p>
<!DOCTYPE html>
<html>
<head>
    <title>Exam Full View</title>
    <link rel="stylesheet" type="text/css" href="view_generated_exams.css">
    <style>
        .exam-full-container {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            color: #6b082e;
            border-radius: 10px;
            box-shadow: 0 4px 24px rgba(107,8,46,0.10);
            padding: 36px 32px 28px 32px;
        }
        .exam-full-title {
            color: #6b082e;
            font-size: 2rem;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .exam-full-meta {
            color: #a0134a;
            font-size: 1.1rem;
            margin-bottom: 18px;
        }
        .exam-full-questions {
            margin-top: 24px;
        }
        .exam-question {
            margin-bottom: 18px;
            padding: 14px 18px;
            background: #f8e6ee;
            border-radius: 7px;
            font-size: 1.08rem;
            color: #6b082e;
            box-shadow: 0 1px 4px rgba(107,8,46,0.04);
        }
        .back-btn {
            display: inline-block;
            margin-bottom: 18px;
            background: #6b082e;
            color: #fff;
            border: none;
            padding: 8px 18px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.2s;
        }
        .back-btn:hover {
            background: #a0134a;
        }
        .pdf-btn {
            background: #6b082e;
            color: #fff;
            border: none;
            padding: 8px 18px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            margin-bottom: 18px;
            margin-left: 10px;
            transition: background 0.2s;
        }
        .pdf-btn:hover {
            background: #a0134a;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
    function downloadPDF() {
        const { jsPDF } = window.jspdf;
        let doc = new jsPDF();
        let title = document.querySelector('.exam-full-title').innerText;
        let meta = document.querySelector('.exam-full-meta').innerText;
        let questions = Array.from(document.querySelectorAll('.exam-question')).map(q => q.innerText).join('\n\n');
        doc.setFont("helvetica", "bold");
        doc.setFontSize(16);
        doc.text(title, 14, 18);
        doc.setFont("helvetica", "normal");
        doc.setFontSize(12);
        doc.text(meta, 14, 28);
        doc.setFontSize(12);
        doc.text(questions, 14, 40);
        doc.save("exam-questions.pdf");
    }
    </script>
</head>
<body>
    <div class="exam-full-container">
        <a href="view_generated_exams.php" class="back-btn">&larr; Back to Exams</a>
        <button class="pdf-btn" onclick="downloadPDF()">Download as PDF</button>
        <?php if ($exam): ?>
            <div class="exam-full-title"><?php echo htmlspecialchars($exam['title']); ?></div>
            <div class="exam-full-meta">
                Subject: <?php echo htmlspecialchars($exam['subject']); ?> |
                Grade: <?php echo htmlspecialchars($exam['grade_level']); ?> |
                Date: <?php echo date("F j, Y, g:i a", strtotime($exam['created_at'])); ?>
            </div>
            <div class="exam-full-questions">
                <?php
                // Split questions by line and display each in a styled box
                $lines = preg_split('/\r\n|\r|\n/', $exam['questions']);
                $qnum = 1;
                foreach ($lines as $line) {
                    $line = trim($line);
                    if ($line !== "") {
                        // If not already numbered, add number
                        if (!preg_match('/^\d+\./', $line)) {
                            $line = $qnum . ". " . $line;
                        }
                        echo "<div class='exam-question'>" . htmlspecialchars($line) . "</div>";
                        $qnum++;
                    }
                }
                ?>
            </div>
        <?php else: ?>
            <div style="color:red;">Exam not found.</div>
        <?php endif; ?>
    </div>
</body>
</html>
