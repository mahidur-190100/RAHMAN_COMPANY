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

$salaryInfo = null;
$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $salary_id = $_POST['salary_id'];
    $sql = "SELECT * FROM salary WHERE salary_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $salary_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $salaryInfo = $result->fetch_assoc();
    } else {
        $error = "Invalid Salary ID.";
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
    <title>Salary Details</title>
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
    <h1>Salary Details</h1>
    <?php if ($salaryInfo): ?>
        <p><strong>Salary ID:</strong> <?php echo htmlspecialchars($salaryInfo['salary_id']); ?></p>
        <p><strong>Main Salary:</strong> <?php echo htmlspecialchars($salaryInfo['main_salary']); ?></p>
        <p><strong>Bonus:</strong> <?php echo htmlspecialchars($salaryInfo['bonus']); ?></p>
    <?php elseif ($error): ?>
        <p><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <a href="dashboard.php" class="back-btn">Back to Dashboard</a>
</div>
</body>
</html>
