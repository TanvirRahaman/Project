<?php
// profile.php
session_start();
include('../models/User.php');

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: Login.php");
    exit();
}

// Fetch user info from database
$email = $_SESSION['email'];
$sql = "SELECT name, email, gender FROM users WHERE email='$email'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_name = $_POST['name'];

    $update_sql = "UPDATE users SET name='$new_name' WHERE email='$email'";
    if ($conn->query($update_sql) === TRUE) {
        $message = "✅ Profile updated successfully!";
        // Refresh user info
        $result = $conn->query("SELECT name, email, gender FROM users WHERE email='$email'");
        $user = $result->fetch_assoc();
    } else {
        $message = "❌ Error updating profile: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <style>
        body {
            background-color: moccasin;
            font-family: Arial, sans-serif;
        }

        #example4 {
            background-color: orange;
            text-align: center;
            margin: auto;
            position: absolute;
            border: 2px solid black;
            padding: 50px;
            border-radius: 25px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 350px;
        }

        input[type="text"] {
            width: 90%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            margin-bottom: 15px;
        }

        button {
            padding: 10px 20px;
            background-color: #f0ad4e;
            border: none;
            border-radius: 5px;
            color: black;
            font-weight: bold;
            cursor: pointer;
        }

        .message {
            color: green;
            font-weight: bold;
            margin-bottom: 15px;
        }
.btn-back {
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    font-weight: bold;
    text-decoration: none;
    text-align: center;
    display: inline-block;
    flex: 1;
}

.btn-back:hover {
    background-color: #218838;
}

    </style>
</head>
<body>
    <div id="example4">
        <h2>Profile Information</h2>
        <?php if (isset($message)) echo "<div class='message'>$message</div>"; ?>
        <form method="POST">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" required><br>

            <label for="email">Email:</label><br>
            <input type="text" id="email" value="<?= htmlspecialchars($user['email']) ?>" readonly><br>

            <label for="gender">Gender:</label><br>
            <input type="text" id="gender" value="<?= htmlspecialchars($user['gender']) ?>" readonly><br><br>

            <button type="submit">Update</button>
        </form>
        <br>
        <a href="../controllers/logout.php" class="button">Logout</a>
        <a href="../views/Home.php" class="btn-back" role="button">Back</a>

    </div>
</body>
</html>
