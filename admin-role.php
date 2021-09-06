<?php

session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true || $_SESSION['admin_role'] != 'Admin') {
    header("location: index.php");
}
require "./database/db_controller.php";

$sql_table = "SELECT id,name,email,role FROM `sign-up` WHERE `role` = 'User' OR `role`='Driver'";
$stmt = mysqli_query($con, $sql_table);

?>

<?php $interface = 'Admin';
require_once "./partials/header.php"; ?>

<header class="jumbotron p-5 bg-light text-white mt-5">
    <h4 class="text-success ms-5 mt-2">Admin Interface Main</h4>
</header>

<div class="pad px-2">
    <main class="container border border-white border-5 rounded-3 mt-5 bg-white px-2">
        <div class="col-lg-8 m-auto">
            <div class="table-responsive mt-5 mb-5">
                <h3>Change Roles</h3>
                <table class="table table-hover">
                    <thead>
                        <th>
                            #
                        </th>
                        <th>
                            Username
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Current Role
                        </th>
                        <th>
                            Actions
                        </th>
                    </thead>
                    <?php foreach($stmt as $user) { ?>
                    <tbody>
                        <td>
                            <?php echo $user['id'];?>
                        </td>
                        <td>
                        <?php echo $user['name'];?>
                        </td>
                        <td>
                        <?php echo $user['email'];?>
                        </td>
                        <td>
                        <?php echo $user['role'];?>
                        </td>
                        <td>
                            <form action="./functions/change_role.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $user['id'];?>">
                            <button type="submit" name="change_role" class="btn btn-sm btn-outline-success">Change Role</button>
                        </form>
                        </td>
                    </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
    </main>
</div>
<main class="container mt-5">
    <div class="col-lg-8 m-auto">

</main>

<script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>