<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Manager Login</title>
    <style>
        body {
            background-color: moccasin;
            font-family: Arial, sans-serif;
            margin: 0; padding: 0;
        }
        #login-box {
            background-color: maroon;
            color: white;
            width: 350px;
            padding: 50px;
            margin: auto;
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 25px;
            border: 2px solid black;
            text-align: center;
        }
        input[type="email"], input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
        }
        input[type="submit"], .back-button {
            background-color: #f0ad4e;
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }
        input[type="submit"]:hover, .back-button:hover {
            background-color: #ec971f;
        }
        a {
            color: #ffc107;
            text-decoration: none;
            display: block;
            margin-top: 10px;
        }
        a:hover {
            text-decoration: underline;
        }
        #errorMsg {
            color: yellow;
            font-weight: bold;
        }
    </style>
</head>
<body>

<form id="login" method="post" action="../controllers/LoginController.php" onsubmit="return isValid();">
    <div id="login-box">
        <h2>Manager Login</h2>

        <p id="errorMsg">
            <?php 
                if (isset($_SESSION['login_error'])) {
                    echo $_SESSION['login_error'];
                    unset($_SESSION['login_error']);
                }
            ?>
        </p>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" placeholder="Enter your email" required><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" placeholder="Enter your password" required><br>

        <input type="submit" value="Login"><br>

        <a href="../../index.php"><button type="button" class="back-button">← Back to Main Page</button></a>
    </div>
</form>

<script>
function isValid() {
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();
    let errorMsg = document.getElementById("errorMsg");

    if (email === "" || password === "") {
        errorMsg.textContent = "Please enter both email and password.";
        return false;
    }

    if (!/\S+@\S+\.\S+/.test(email)) {
        errorMsg.textContent = "Please enter a valid email address.";
        return false;
    }

    return true;
}
</script>

</body>
</html>
