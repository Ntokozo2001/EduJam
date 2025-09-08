<?php include_once "header.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>View Generated Exams</title>
    <link rel="stylesheet" type="text/css" href="view_generated_exams.css">
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch('view_generated_examsb.php')
            .then(response => response.json())
            .then(data => {
                const table = document.querySelector('.container table');
                // Remove static rows
                table.querySelectorAll('tr:not(:first-child)').forEach(tr => tr.remove());
                if (data.length === 0) {
                    let row = document.createElement('tr');
                    row.innerHTML = `<td colspan="3" style="text-align:center;">No exams found.</td>`;
                    table.appendChild(row);
                } else {
                    data.forEach(exam => {
                        let date = new Date(exam.created_at);
                        let formatted = date.toLocaleString('en-US', {
                            year: 'numeric', month: 'long', day: 'numeric',
                            hour: '2-digit', minute: '2-digit'
                        });
                        let row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${exam.title}</td>
                            <td>${formatted}</td>
                            <td>
                                <form action="view_exam_full.php" method="get" style="margin:0;">
                                    <input type="hidden" name="exam_id" value="${exam.id}">
                                    <button type="submit" class="view-btn">View Full</button>
                                </form>
                            </td>
                        `;
                        table.appendChild(row);
                    });
                }
            });
    });
    </script>
</head>
<body>
    <header>
        <h1>Generated Exams</h1>
    </header>
    <div class="container">
        <h2>All Generated Exams</h2>
        <table>
            <tr>
                <th>Exam Title</th>
                <th>Date Generated</th>
                <th>Action</th>
            </tr>
            <!-- Dynamic rows will be inserted here -->
        </table>
    </div>
    <footer>
        &copy; 2024 Bi-week Report. All rights reserved.
    </footer>
</body>
</html>