<?php
session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['admin_id'] == "") {
    header("location:../auth/login.php");
    $_SESSION['login_error'] = "Please Login First";
}
include '../connection.php';
$id = $_GET['id'];
$action = $_GET['action'];

if ($action == "delete") {
    $sql = "UPDATE tasks SET active = 2 WHERE id = $id";
    $_SESSION['message'] = 'Task Trashed Successfully';

    $loc = "list.php";
} elseif ($action == "restore") {
    $sql = "UPDATE tasks SET active = 1 WHERE id = $id";
    $_SESSION['message'] = 'Task Restored Successfully';

    $loc = "list.php";
} elseif ($action == "deleteforever") {
    $sql = "DELETE FROM tasks WHERE id = $id";
    $_SESSION['message'] = 'Task Deleted Successfully';
    $loc = "list.php";
}

mysqli_query($conn, $sql);
header("location:$loc");
