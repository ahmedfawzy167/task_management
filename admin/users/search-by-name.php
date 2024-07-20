<?php
session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['admin_id'] == "") {
  header("location:../auth/login.php");
  $_SESSION['login_error'] = "Please Login First";
  $_SESSION['back_to'] = $_SERVER["PHP_SELF"];
}
include '../includes/menubar.php';
include '../connection.php';

if (isset($_GET["name"])) {
  $name = $_GET["name"];
  $sql = "SELECT * FROM users WHERE `name` LIKE '%$name%'";
} else {
  $sql = "SELECT cities.name AS cityname, users.* 
  FROM users, cities 
  WHERE cities.id = users.city_id And users.status = 1";
}
$users_list = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Users - Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../css/main.css">
</head>

<body>

  <div class="container">
    <h1 class="text-center text-white bg-warning"><i class="fa-solid fa-user"></i> Search User By Name</h1>
    <form class="row mb-3" action="" method="get">
      <div class="col-10">
        <input type="text" value="<?php if (isset($_GET["name"])) {
                                    echo $_GET["name"];
                                  } ?>" name="name" id="name" class="form-control">
      </div>

      <div class="col-2">
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="../users/search-by-name.php" class="btn btn-secondary">Reset</a>
      </div>
    </form>

    <div class="row">
      <table class="table table-hover table-bordered">
        <tr class="table-dark">
          <th>ID</th>
          <th>Image</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Address</th>
          <th>City</th>
          <th>Actions</th>
        </tr>
        <?php
        while ($user = mysqli_fetch_assoc($users_list)) { ?>
          <tr>
            <td><?php echo $user['id']; ?></td>
            <td><img src="<?php echo $user['image']; ?>" width="100px" class="rounded-circle"></td>
            <td><?php echo $user['name']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['phone']; ?></td>
            <td><?php echo $user['address']; ?></td>
            <td><?php echo $user['cityname']; ?></td>
            <td>
              <a href="show.php?id=<?php echo $user['id']; ?>" class="btn btn-primary">View</a>
              <a href="edit.php?id=<?php echo $user['id']; ?>" class="btn btn-info">Edit</a>
              <a href="delete.php?id=<?php echo $user['id']; ?>" class="btn btn-danger">Delete</a>
            </td>
          </tr>
        <?php
        } ?>

      </table>

    </div>

  </div>



  <script src="../js/jquery-3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js" integrity="sha512-X/YkDZyjTf4wyc2Vy16YGCPHwAY8rZJY+POgokZjQB2mhIRFJCckEGc6YyX9eNsPfn0PzThEuNs+uaomE5CO6A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="../js/app.js"></script>

</body>

</html>