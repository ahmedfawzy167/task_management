<?php
session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['admin_id'] == "") {
    header("location:../auth/login.php");
    $_SESSION['login_error'] = "Please Login First";
    $_SESSION['back_to'] = $_SERVER["PHP_SELF"];
}
include '../includes/menubar.php';
include '../connection.php';

$sql = "SELECT * FROM cities WHERE active = 2";
$cities_list = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cities Trash - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>
    <div class="container">
        <h1 class="my-5 text-center text-white bg-danger"><i class="fa-solid fa-trash-can" style="color: #fafafa;"></i> Cities Trash</h1>
        <div class="row">
            <table class="table table-hover table-bordered">
                <tr class="table-dark">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                <?php
                while ($city = mysqli_fetch_assoc($cities_list)) {
                ?>
                    <tr>
                        <td><?php echo $city['id']; ?></td>
                        <td><?php echo $city['name']; ?></td>
                        <td><?php echo $city['active']; ?></td>
                        <td>
                            <a href="soft-delete.php?id=<?php echo $city['id']; ?> &action=restore" class="btn btn-success"><i class="fa-solid fa-trash-arrow-up" style="color: #f1f2f3;"></i> Restore</a>
                            <a href="soft-delete.php?id=<?php echo $city['id']; ?>&action=deleteforever" class="btn btn-danger"><i class="fa-solid fa-fire" style="color: #e8e8e8;"></i> Delete Forever</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js" integrity="sha512-X/YkDZyjTf4wyc2Vy16YGCPHwAY8rZJY+POgokZjQB2mhIRFJCckEGc6YyX9eNsPfn0PzThEuNs+uaomE5CO6A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../js/app.js"></script>
</body>

</html>