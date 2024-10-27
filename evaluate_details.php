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

$manager_id = null;
$project_id = null;
$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $manager_id = $_POST['manager_id'];
    $project_id = $_POST['project_id'];

    // Validate manager ID
    $sql = "SELECT * FROM manager WHERE manager_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $manager_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $error = "Invalid Manager ID.";
    }

    $stmt->close();

    // Validate project ID if manager ID is valid
    if (!$error) {
        $sql = "SELECT * FROM project WHERE project_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $project_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            $error = "Invalid Project ID.";
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation Details</title>
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
<div class="details-box">
    <?php if ($error): ?>
        <h1>Error</h1>
        <p><?php echo htmlspecialchars($error); ?></p>
        <a href="dashboard.php" class="back-btn">Back to Dashboard</a>
    <?php else: ?>
        <h1>Enter Evaluation Details</h1>
        <form action="evaluate_update.php" method="POST">
            <input type="hidden" name="manager_id" value="<?php echo htmlspecialchars($manager_id); ?>">
            <input type="hidden" name="project_id" value="<?php echo htmlspecialchars($project_id); ?>">
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="remarks">Remarks (out of 10):</label>
                <input type="number" id="remarks" name="remarks" min="0" max="10" required>
            </div>
            <button type="submit">Submit</button>
        </form>
        <a href="dashboard.php" class="back-btn">Back to Dashboard</a>
    <?php endif; ?>
</div>
</body>
</html>
