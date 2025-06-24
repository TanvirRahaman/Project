<?php
session_start();
include('../models/User.php');  // Your DB connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Query the managers table (no hashing here)
    $sql = "SELECT * FROM managers WHERE email='$email' AND password='$password' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $manager = $result->fetch_assoc();

        // Save manager info in session
        $_SESSION['manager_email'] = $manager['email'];
        $_SESSION['manager_name'] = $manager['name'];

        // Redirect to manager home page
        header("Location: ../views/Home.php");
        exit();
    } else {
        $_SESSION['login_error'] = "Incorrect email or password.";
        header("Location: ../views/Login.php");
        exit();
    }
} else {
    // If accessed directly, redirect to login
    header("Location: ../views/Login.php");
    exit();
}
?>
