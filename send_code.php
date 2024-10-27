<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['phone'];
    
    // In real implementation, you would send a verification code to the phone number here
    
    echo "A verification code has been sent to " . htmlspecialchars($phone);
}
?>
