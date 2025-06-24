<?php
session_start();
include('../models/User.php');

// Check if manager is logged in
$email = $_SESSION['manager_email'] ?? null;

if (!$email) {
    header("Location: ../views/managerLogin.php");
    exit();
}

// Fetch data from managers table
$sql = "SELECT name, email, gender FROM managers WHERE email='$email'";
$result = $conn->query($sql);
$manager = $result->fetch_assoc();

$showSuccessAlert = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_name = $conn->real_escape_string($_POST['name']);
    $new_email = $conn->real_escape_string($_POST['email']);
    $new_gender = $conn->real_escape_string($_POST['gender']);

    $update_sql = "UPDATE managers SET name='$new_name', email='$new_email', gender='$new_gender' WHERE email='$email'";

    if ($conn->query($update_sql) === TRUE) {
        $showSuccessAlert = true;
        $_SESSION['manager_email'] = $new_email; // Update session if email changes
        $email = $new_email;
    } else {
        $message = "❌ Error updating profile: " . $conn->error;
    }

    // Refresh data
    $sql = "SELECT name, email, gender FROM managers WHERE email='$email'";
    $result = $conn->query($sql);
    $manager = $result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Manager Profile</title>
    <style>
        body {
            background-color: moccasin;
            font-family: Arial, sans-serif;
        }

        #example4 {
            background-color: maroon;
            color: white;
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
            width: 350px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

        input[type="text"], select {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: none;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 10px;
        }

        button, .btn-link {
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            border: none;
            flex: 1;
        }

        button {
            background-color: #f0ad4e;
            color: black;
        }

        button:hover {
            background-color: #ec971f;
        }

        .btn-link {
            background-color: #007bff;
            color: white;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-link:hover {
            background-color: #0056b3;
        }

        .btn-logout {
            background-color: #dc3545;
            color: white;
        }

        .btn-logout:hover {
            background-color: #c82333;
        }

        .message {
            color: #ffcccb;
        }
    </style>
</head>
<body>
    <div id="example4">
        <h2>Profile Information</h2>

        <?php if (isset($message)) echo "<p class='message'>$message</p>"; ?>

        <form method="POST" id="profileForm">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($manager['name']) ?>" required />

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?= htmlspecialchars($manager['email']) ?>" required />

            <label for="gender">Gender:</label>
            <select name="gender" id="gender" required>
                <option value="Male" <?= $manager['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                <option value="Female" <?= $manager['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                <option value="Other" <?= $manager['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
            </select>

            <div class="button-container">
                <button type="submit">Update</button>
                <a href="../views/Home.php" class="btn-link">Back</a>
                <a href="../controllers/logout.php" class="btn-logout">Logout</a>
            </div>
        </form>
    </div>

    <?php if ($showSuccessAlert): ?>
        <script>
            alert("✅ Profile updated successfully!");
            window.location.href = '../views/Home.php';
        </script>
    <?php endif; ?>
</body>
</html>
