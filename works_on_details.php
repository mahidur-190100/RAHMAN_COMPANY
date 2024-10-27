<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "RAHMAN_COMPANY";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$worksOnInfo = null;
$error = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST['employee_id'];
    $project_id = $_POST['project_id'];

    $sql = "SELECT * FROM works_on WHERE employee_id = ? AND project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $employee_id, $project_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $worksOnInfo = $result->fetch_assoc();
    } else {
        $error = "Invalid ID.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Works On Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .details-box {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #007bff;
        }
        p {
            font-size: 18px;
            color: #333;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="details-box">
    <h1>Works On Details</h1>
    <?php if ($worksOnInfo): ?>
        <p><strong>Project ID:</strong> <?php echo htmlspecialchars($worksOnInfo['project_id']); ?></p>
        <p><strong>Employee ID:</strong> <?php echo htmlspecialchars($worksOnInfo['employee_id']); ?></p>
        <p><strong>Work Date:</strong> <?php echo htmlspecialchars($worksOnInfo['work_date']); ?></p>
    <?php elseif ($error): ?>
        <p><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <a href="dashboard.php" class="back-btn">Back to Dashboard</a>
</div>
</body>
</html>
