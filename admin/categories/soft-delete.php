<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == "") {
   header("location:../auth/login.php");
   $_SESSION['login_error'] = "Please Login First";
   $_SESSION['back_to'] = $_SERVER["PHP_SELF"];
}
include '../connection.php';
$id = $_GET['id'];
$action = $_GET['action'];

if ($action == "delete") {
   $sql = "UPDATE categories SET active = 2 WHERE id = $id";
   $_SESSION['message'] = 'Category Trashed Successfully';
   $loc = "list.php";
} elseif ($action == "restore") {
   $sql = "UPDATE categories SET active = 1 WHERE id = $id";
   $_SESSION['message'] = 'Category Restored Successfully';
   $loc = "list.php";
} elseif ($action == "deleteforever") {
   $sql = "DELETE FROM categories WHERE id = $id";
   $_SESSION['message'] = 'Category Deleted Successfully';
   $loc = "list.php";
}

mysqli_query($conn, $sql);
header("location:$loc");
