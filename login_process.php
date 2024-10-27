<?php
// Start session
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
    $email = $_POST['email'];
    $password = intval($_POST['password']);
    
    // Fetch user by email
    $sql = "SELECT * FROM person WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Check if password matches
        if ($password === intval($row['password'])) {
            // Store email in session
            $_SESSION['email'] = $email;

            // Redirect to the dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "You are not in this company.";
    }
}

$conn->close();
?>
