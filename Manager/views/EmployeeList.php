<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User List</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 50px;
        background-color: #f4f4f4;
    }

    h2 {
        color: #333;
    }

    a.btn {
        padding: 8px 16px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 4px;
    }

    a.btn:hover {
        background-color: #0056b3;
    }

    table {
        width: 50%;
        border-collapse: collapse;
        background-color: #fff;
    }

    table, th, td {
        border: 1px solid black;
    }

    th, td {
        padding: 10px;
        text-align: left;
    }

    .action-buttons {
        margin-top: 20px;
    }

    button {
        padding: 10px 20px;
        margin-right: 10px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
    }

    button.delete {
        background-color: #dc3545;
    }

    button:hover {
        opacity: 0.9;
    }

    input[type="checkbox"] {
        transform: scale(1.2);
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

<script>
    function confirmEdit(event, url) {
        event.preventDefault();
        if (confirm("Are you sure you want to edit this user?")) {
            window.location.href = url;
        }
    }

    function confirmDelete(event, url) {
        event.preventDefault();
        if (confirm("Are you sure you want to delete this user?")) {
            window.location.href = url;
        }
    }
</script>

</head>
<body>

<div class="user_1">
    <?php if (isset($_SESSION['message'])): ?>
    <div style="padding:10px; background:#d1ecf1; color:#0c5460; margin-bottom:15px; border:1px solid #bee5eb;">
        <?= $_SESSION['message']; unset($_SESSION['message']); ?>
    </div>
<?php endif; ?>

<h2>List of Users</h2>
<a class="btn" href="../views/Register.php" role="button">Add New User</a>
<br><br>

<form action="BatchActions.php" method="post">
<table id="myTable" class="table">
    <thead>
    <tr>
        <th>Select</th>
        <th>Name</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    session_start();
    include('../models/User.php');

    $sql ="SELECT * FROM users";
    $result = $conn->query($sql);

    if(!$result){
        die("Invalid query:" . $conn->error);
    }

    while($row = $result->fetch_assoc()) {
        $editUrl = "Edit.php?id={$row['id']}";
        $deleteUrl = "Delete.php?id={$row['id']}";
        echo "<tr>
                <td><input type='checkbox' name='user_ids[]' value='{$row['id']}'></td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['gender']}</td>
                <td>
                    <a href='#' class='btn' onclick=\"confirmEdit(event, '$editUrl')\">Edit</a> |
                    <a href='#' class='btn' style='background-color:#dc3545;' onclick=\"confirmDelete(event, '$deleteUrl')\">Remove</a>
                </td>
              </tr>";
    }
    $conn->close();
    ?>
    </tbody>
</table>

<div class="action-buttons">
    <button type="submit" name="action" value="delete" class="delete">Delete Selected Users</button>
    <!--<button type="submit" name="action" value="edit">Edit Selected User</button>-->
    <a href="../views/Home.php" class="btn-back" role="button">Back</a>

</div>


</form>
<br>
<a href="../controllers/logout.php" class="btn" style="background-color: #6c757d;">Logout</a>
</div>

</body>
</html>
