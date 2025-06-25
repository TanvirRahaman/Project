<?php
session_start();
include('../models/User.php');


if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);
    $sql = "SELECT * FROM users WHERE id = $userId";
    $result = $conn->query($sql);

    if ($result->num_rows !== 1) {
        die("User not found.");
    }

    $user = $result->fetch_assoc();
} else {
    die("Invalid request.");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $gender = $conn->real_escape_string($_POST['gender']);

    $updateSql = "UPDATE users SET name='$name', email='$email', gender='$gender' WHERE id=$userId";

    if ($conn->query($updateSql) === TRUE) {
        $_SESSION['message'] = "User updated successfully.";
        header("Location: EmployeeList.php");
        exit();
    } else {
        $error = "Error updating user: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <style>
        body {
            font-family: Arial;
            margin: 50px;
        }
        form {
            max-width: 400px;
        }
        label {
            display: block;
            margin-top: 15px;
        }
        input[type="text"], input[type="email"], select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        input[type="submit"] {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<h2>Edit User</h2>

<?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

<form method="post">
    <label>Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>

    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

    <label>Gender:</label>
    <select name="gender" required>
        <option value="Male" <?= $user['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
        <option value="Female" <?= $user['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
        <option value="Other" <?= $user['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
    </select>

    <input type="submit" value="Update">
</form>

</body>
</html>
