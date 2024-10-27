<?php
// Start session
session_start();

// Destroy session
session_destroy();

// Redirect to a "lgout success" page
header("Location: logout_success.php");
exit();
?>
