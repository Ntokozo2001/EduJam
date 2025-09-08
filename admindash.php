
<?php 
include_once "header.php"; 
include_once "db_config.php"; 
session_start();

// Fetch total users
$total_users_query = "SELECT COUNT(*) AS total_users FROM teachers";
$total_users_result = $conn->query($total_users_query);
$total_users = $total_users_result->fetch_assoc()['total_users'];

// Fetch total schools
$total_schools_query = "SELECT COUNT(*) AS total_schools FROM schools";
$total_schools_result = $conn->query($total_schools_query);
$total_schools = $total_schools_result->fetch_assoc()['total_schools'];

// Fetch total exams generated
$total_exams_query = "SELECT COUNT(*) AS total_exams FROM question_papers";
$total_exams_result = $conn->query($total_exams_query);
$total_exams = $total_exams_result->fetch_assoc()['total_exams'];

$conn->close();
?>
<!DOCTYPE html>

<html>
<head>
    
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admindash.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #15305D;
            margin: 0;
            padding: 0;
            color: #FFFFFF;
        }
        .admin-dashboard-container {
            max-width: 1200px;
            margin: 40px auto;
            background: #FFFFFF;
            border-radius: 10px;
            box-shadow: 0 4px 24px rgba(21,48,93,0.2);
            padding: 36px 32px;
        }
        .dashboard-header {
            text-align: center;
            margin-bottom: 24px;
            background: #15305D;
            padding: 24px 0;
            border-radius: 10px 10px 0 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .dashboard-header h1 {
            color: #FFD700;
            font-size: 2.5rem;
            margin-bottom: 8px;
        }
        .dashboard-header p {
            color: #FFFFFF;
            font-size: 1.2rem;
        }
        .dashboard-stats {
            display: flex;
            justify-content: space-between;
            margin-top: 24px;
        }
        .stat-card {
            flex: 1;
            margin: 0 12px;
            background: #FFD700;
            border-radius: 10px;
            padding: 24px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(21,48,93,0.2);
        }
        .stat-card h2 {
            color: #15305D;
            font-size: 2rem;
            margin-bottom: 8px;
        }
        .stat-card p {
            color: #FFFFFF;
            font-size: 1.2rem;
        }
        .dashboard-footer {
            text-align: center;
            margin-top: 24px;
            color: #FFD700;
            font-size: 1rem;
        }
        .dashboard-footer a {
            color: #FFD700;
            text-decoration: none;
        }
        .dashboard-footer a:hover {
            text-decoration: underline;
        }
        .dashboard-stats a {
            background: #15305D;
            color: #FFD700;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s, color 0.3s;
        }
        .dashboard-stats a:hover {
            background: #FFD700;
            color: #15305D;
        }
    </style>
</head>
<body>
    
    <div class="admin-dashboard-container">
        <div class="dashboard-header">
            <h1>Admin Dashboard</h1>
            <p>Monitor and manage the platform's statistics and data.</p>
        </div>
        <div class="dashboard-stats">
            <div class="stat-card">
                <h2><?php echo $total_users; ?></h2>
                <p>Total Users</p>
            </div>
            <div class="stat-card">
                <h2><?php echo $total_schools; ?></h2>
                <p>Total Schools</p>
            </div>
            <div class="stat-card">
                <h2><?php echo $total_exams; ?></h2>
                <p>Total Exams Generated</p>
            </div>
        </div>
        <div style="text-align: center; margin-top: 24px;">
            <a href="viewcontacts.php" style="background: #15305D; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold;">View Contacts</a>
        </div>
        <div class="dashboard-footer">
            &copy; <?php echo date("Y"); ?> Bi-week Report. All rights reserved.
        </div>
    </div>
</body>
</html>
