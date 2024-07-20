<?php
session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['admin_id'] == "") {
   header("location:../auth/login.php");
   $_SESSION['login_error'] = "Please Login First";
   $_SESSION['back_to'] = $_SERVER["PHP_SELF"];
}
include '../includes/menubar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>New Category</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="../css/main.css">
</head>

<body>

   <div class="container">
      <div class="row">
         <?php
         if (isset($_SESSION['category'])) {
            echo '<div class="alert alert-success">' . $_SESSION['category'] . '</div>';
            unset($_SESSION['category']);
         } ?>
         <h1 class="text-center text-white bg-primary mt-4"><i class="fa-solid fa-plus"></i> Add New Category</h1>
         <form action="save.php" method="post">
            <div class="form-group">
               <label for="category_name">Category Name</label>
               <input type="text" id="category_name" name="category_name" class="form-control mt-2 mb-4" required>
            </div>

            <div class="text-center">
               <button type="submit" class="btn btn-primary btn-lg">Add</button>
               <a href="list.php" class="btn btn-secondary btn-lg">Back To List</a>
            </div>
         </form>

      </div>


      <script src="../js/jquery-3.7.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js" integrity="sha512-X/YkDZyjTf4wyc2Vy16YGCPHwAY8rZJY+POgokZjQB2mhIRFJCckEGc6YyX9eNsPfn0PzThEuNs+uaomE5CO6A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="../js/app.js"></script>

</body>

</html>