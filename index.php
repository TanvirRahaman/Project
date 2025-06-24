<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome | Login Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Welcome to the Employee Management System</h1>
    </header>

    <main>
        <div class="login-options">
            <a href="Manager/views/Login.php" class="login-button manager">Manager Login</a>
            <a href="Employee/views/Login.php" class="login-button employee">Employee Login</a>
        </div>
    </main>

    <footer>
        <p>&copy; <?= date("Y") ?> All rights reserved | Developed by <strong>Shafi</strong></p>
    </footer>

</body>
</html>
