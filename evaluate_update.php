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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $manager_id = $_POST['manager_id'];
    $project_id = $_POST['project_id'];
    $date = $_POST['date'];
    $remarks = $_POST['remarks'];

    // Insert or update the evaluation details
    $sql = "INSERT INTO evaluate (manager_id, project_id, date, remarks) VALUES (?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE date = VALUES(date), remarks = VALUES(remarks)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $manager_id, $project_id, $date, $remarks);

    if ($stmt->execute()) {
        $message = "Evaluation details updated successfully.";
    } else {
        $message = "Error: " . $stmt->error;
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
    <title>Update Evaluation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .message-box {
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
<div class="message-box">
    <h1>Update Status</h1>
    <p><?php echo htmlspecialchars($message); ?></p>
    <a href="dashboard.php" class="back-btn">Back to Dashboard</a>
</div>
</body>
</html>
