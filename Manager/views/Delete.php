<?php
// Start session and include DB connection
session_start();
include('../models/User.php');

if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);

    // Delete query
    $sql = "DELETE FROM users WHERE id = $userId";
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "User deleted successfully.";
    } else {
        $_SESSION['message'] = "Error deleting user: " . $conn->error;
    }

    $conn->close();
} else {
    $_SESSION['message'] = "No user ID provided.";
}

// Redirect back to the user list
header("Location: EmployeeList.php");
exit();
?>
