<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Rahman Company</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
			background-image: url('background.png');
            background-size: contain;
            background-repeat:repeat;
            background-position: 
        }
        .sidebar {
            width: 250px;
            background-color: #007bff;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .sidebar h1 {
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar .features {
            display: flex;
            flex-direction: column;
        }
        .sidebar .feature-btn {
            background-color: #fff;
            color: #007bff;
            border: none;
            padding: 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 10px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .sidebar .feature-btn:hover {
            background-color: #0056b3;
            color: #fff;
        }
        .sidebar .logout-btn {
            margin-top: 20px;
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .sidebar .logout-btn:hover {
            background-color: #c82333;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h1>Dashboard</h1>
        <div class="features">
            <button class="feature-btn" onclick="window.location.href='person.php'">Person</button>
            <button class="feature-btn" onclick="window.location.href='manager.php'">Manager</button>
            <button class="feature-btn" onclick="window.location.href='employee.php'">Employee</button>
            <button class="feature-btn" onclick="window.location.href='salary.php'">Salary</button>
            <button class="feature-btn" onclick="window.location.href='project.php'">Project</button>
            <button class="feature-btn" onclick="window.location.href='workson.php'">WorksOn</button>
            <button class="feature-btn" onclick="window.location.href='evaluate.php'">Evaluate</button>
        </div>
        <button class="logout-btn" onclick="window.location.href='logout.php'">Logout</button>
    </div>
    <div class="main-content">
        <h1>Welcome to the Rahman Company Dashboard</h1>
        <p>Select an option from the sidebar to get started.</p>
    </div>
</body>
</html>
