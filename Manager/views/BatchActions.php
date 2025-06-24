<?php
include('../models/User.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_ids'])) {
    $ids = $_POST['user_ids'];
    $action = $_POST['action'];

    if ($action === 'delete') {
        foreach ($ids as $id) {
            $conn->query("DELETE FROM users WHERE id=$id");
        }
        header("Location: EmployeeList.php");
        exit();
    }

    if ($action === 'edit' && count($ids) === 1) {
        header("Location: Edit.php?id=" . $ids[0]);
        exit();
    } else if ($action === 'edit') {
        echo "Please select only one user to edit.";
    }
} else {
    echo "No users selected.";
}
$conn->close();
?>
