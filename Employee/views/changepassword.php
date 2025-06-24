<?php
// changepassword.php
session_start();
include('../models/User.php');

// Handle password change
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_SESSION['email'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // Check if current password is correct
    $sql = "SELECT password FROM user WHERE email='$email'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    if ($user['password'] !== $current_password) {
        $message = "Current password is incorrect.";
    } elseif ($new_password !== $confirm_new_password) {
        $message = "New passwords do not match.";
    } elseif ($current_password === $new_password) {
        $message = "New password cannot be the same as the current password.";
    } else {
        // Update the password
        $update_sql = "UPDATE users SET password='$new_password' WHERE email='$email'";
        if ($conn->query($update_sql) === TRUE) {
            $message = "Password updated successfully!";
        } else {
            $message = "Error updating password: " . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <title>Change Password</title>
    <style>
	#example3 {
		background-color: orange;
	    text-align: center;
		margin: auto;
		position: absolute;
		justify-content: center;
        border: 2px solid black;
        padding: 50px;
        border-radius: 25px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);	
		
		.form-group label {
        display: block;
        margin-bottom: 5px;
        }
		
		
		
		div.absolute {
        position: absolute;
        down: 80px;
        right: 0;
        width: 100px;
        height: 100px;
}


    </style>
</head>
<body>
    <div id="example3">
        <h2>Change Password</h2>
        <?php if (isset($message)) { echo "<p>$message</p>"; } ?>
        <form id="changePassword" method="POST">
            <label for="current_password">Current Password:</label>
            <input type="password" id="current_password" name="current_password" required>
			<br><br>
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required>
			<br><br>
            <label for="confirm_new_password">Confirm New Password:</label>
            <input type="password" id="confirm_new_password" name="confirm_new_password" required>
			<br><br>
            
            <button type="submit" class="button">Update Password</button>
        </form>
        <div class="absolute">
            <a href="../controllers/Logout.php">Logout</a>
        </div>
    </div>


    <script>
        document.getElementById('changePassword').addEventListener('submit', function(e) {
            var currentPassword = document.getElementById('current_password').value;
            var newPassword = document.getElementById('new_password').value;
            var confirmNewPassword = document.getElementById('confirm_new_password').value;
            var errorMsg = document.querySelector('p'); // Assumes there's only one paragraph for error messages

            // Validation checks
            if (currentPassword === newPassword) {
                e.preventDefault();
                errorMsg.textContent = "New password cannot be the same as the current password.";
                return;
            }

            if (newPassword !== confirmNewPassword) {
                e.preventDefault();
                errorMsg.textCont
