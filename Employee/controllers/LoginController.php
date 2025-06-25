<?php
session_start();
include('../models/User.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    if (!$stmt) {
        $_SESSION['login_error'] = "Database error: " . $conn->error;
        header("Location: ../views/Login.php");
        exit();
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();


    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();


        if (password_verify($password, $user['password'])) {

            $_SESSION['email'] = $user['email'];
            $_SESSION['name'] = $user['name'];

            header("Location: ../views/Home.php");
            exit();
        } else {

            $_SESSION['login_error'] = "❌ Incorrect password.";
            header("Location: ../views/Login.php");
            exit();
        }
    } else 
    {
        $_SESSION['login_error'] = "❌ No account found with that email.";
        header("Location: ../views/Login.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
