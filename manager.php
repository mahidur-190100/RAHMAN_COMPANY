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
        $error = "Wrong Manager ID.";
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
    <title>Manager Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-box {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #007bff;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        button:hover {
            background-color: #0056b3;
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
<div class="form-box">
    <h1>Enter Manager ID</h1>
    <form action="manager_details.php" method="POST">
        <div class="form-group">
            <label for="manager_id">Manager ID:</label>
            <input type="text" id="manager_id" name="manager_id" required>
        </div>
        <button type="submit">Submit</button>
    </form>
    <a href="dashboard.php" class="back-btn">Back to Dashboard</a>
</div>
</body>
</html>
