<?php
session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['admin_id'] == "") {
   header("location:../auth/login.php");
   $_SESSION['login_error'] = "Please Login First";
   $_SESSION['back_to'] = $_SERVER["PHP_SELF"];
}
include '../connection.php';
$id = $_GET['id'];
$action = $_GET['action'];

if ($action == "delete") {
   $sql = "UPDATE cities SET active = 2 WHERE id = $id";
   $_SESSION['message'] = 'City Trashed Successfully';
   $loc = "list.php";
} elseif ($action == "restore") {
   $sql = "UPDATE cities SET active = 1 WHERE id = $id";
   $_SESSION['message'] = 'City Restored Successfully';
   $loc = "list.php";
} elseif ($action == "deleteforever") {
   $sql = "DELETE FROM cities WHERE id = $id";
   $_SESSION['message'] = 'City Deleted Successfully';
   $loc = "list.php";
}

mysqli_query($conn, $sql);
header("location:$loc");
