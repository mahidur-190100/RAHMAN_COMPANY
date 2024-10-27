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

$managerInfo = null;
$error = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $manager_id = $_POST['manager_id'];

    $sql = "SELECT * FROM manager WHERE manager_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $manager_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $managerInfo = $result->fetch_assoc();
    } else {
        $error = "You are not manager. Work hard if you want to become manager.";
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
    <title>Manager Details</title>
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
    <h1>Manager Details</h1>
    <?php if ($managerInfo): ?>
        <p><strong>Manager ID:</strong> <?php echo htmlspecialchars($managerInfo['manager_id']); ?></p>
        <p><strong>Person ID:</strong> <?php echo htmlspecialchars($managerInfo['id']); ?></p>
        <p><strong>Joining Date:</strong> <?php echo htmlspecialchars($managerInfo['join_date']); ?></p>
        <p><strong>Salary ID:</strong> <?php echo htmlspecialchars($managerInfo['salary_id']); ?></p>
        <p><strong>Salary Date:</strong> <?php echo htmlspecialchars($managerInfo['salary_date']); ?></p>
    <?php elseif ($error): ?>
        <p><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <a href="dashboard.php" class="back-btn">Back to Dashboard</a>
</div>
</body>
</html>
