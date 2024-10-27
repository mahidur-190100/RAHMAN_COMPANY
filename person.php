<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // If not logged in, redirect to login page
    header("Location: login.html");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "RAHMAN_COMPANY";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user's details from the person table using their email
$email = $_SESSION['email'];
$sql = "SELECT id, name, address, date_of_birth, email FROM person WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $personInfo = $result->fetch_assoc();
} else {
    echo "No data found for the logged-in user.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Person Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .person-info-box {
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
<div class="person-info-box">
    <h1>Person Information</h1>
    <p><strong>ID:</strong> <?php echo htmlspecialchars($personInfo['id']); ?></p>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($personInfo['name']); ?></p>
    <p><strong>Address:</strong> <?php echo htmlspecialchars($personInfo['address']); ?></p>
    <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($personInfo['date_of_birth']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($personInfo['email']); ?></p>
    <a href="dashboard.php" class="back-btn">Back to Dashboard</a>
</div>
</body>
</html>
