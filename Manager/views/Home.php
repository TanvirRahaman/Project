<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            background-color: moccasin;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .home {
            display: flex;
            flex-direction: row;
            width: 100%;
            height: 100vh;
        }

        .sidebar {
            width: 200px;
            background-color: maroon;
            color: white;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
        }

        .sidebar button {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: saddlebrown;
            color: white;
            font-size: 1em;
            cursor: pointer;
        }

        .logout-btn {
            background-color: #dc3545;
        }

        .sidebar form {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="home">
        <div class="sidebar">
            <button onclick="location.href='profile.php'">Profile</button>
            <button onclick="location.href='reset_password.php'">Change Password</button>
            <button onclick="location.href='EmployeeList.php'">Employee List</button>

            <form action="../controllers/logout.php" method="post">
                <button type="submit" class="logout-btn">🔓 Logout</button>
            </form>
        </div>
    </div>
</body>
</html>
