<?php 
include_once "header.php"; 
include_once "db_config.php"; 

// Fetch contacts from the database
$sql = "SELECT id, name, email, message, created_at FROM contacts ORDER BY created_at DESC";
$result = $conn->query($sql);
$contacts = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $contacts[] = $row;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Contacts</title>
    <link rel="stylesheet" href="viewcontacts.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .contacts-container {
            max-width: 1200px;
            margin: 40px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.1);
            padding: 36px 32px;
        }
        .contacts-header {
            text-align: center;
            margin-bottom: 24px;
        }
        .contacts-header h1 {
            color: #6b082e;
            font-size: 2.5rem;
            margin-bottom: 8px;
        }
        .contacts-header p {
            color: #a0134a;
            font-size: 1.2rem;
        }
        .contacts-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 24px;
        }
        .contacts-table th, .contacts-table td {
            padding: 12px 16px;
            text-align: left;
        }
        .contacts-table th {
            background-color: #6b082e;
            color: #fff;
            font-weight: bold;
        }
        .contacts-table tr:nth-child(even) {
            background-color: #f8e6ee;
        }
        .contacts-table tr:hover {
            background-color: #f4c2d1;
        }
        .contacts-table td {
            color: #6b082e;
        }
        .contacts-message {
            max-width: 400px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .contacts-footer {
            text-align: center;
            margin-top: 24px;
            color: #6b082e;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="contacts-container">
        <div class="contacts-header">
            <h1>Contact Messages</h1>
            <p>View all messages sent by users through the contact form.</p>
        </div>
        <table class="contacts-table">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
            <?php if (!empty($contacts)): ?>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($contact['name']); ?></td>
                        <td><?php echo htmlspecialchars($contact['email']); ?></td>
                        <td class="contacts-message"><?php echo htmlspecialchars($contact['message']); ?></td>
                        <td><?php echo date("F j, Y, g:i a", strtotime($contact['created_at'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align:center; color:red;">No contacts found.</td>
                </tr>
            <?php endif; ?>
        </table>
        <div class="contacts-footer">
            &copy; <?php echo date("Y"); ?> Bi-week Report. All rights reserved.
        </div>
    </div>
</body>
</html>
