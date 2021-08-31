<?php

session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true || $_SESSION['admin_role'] != 'Admin') {
    header("location: index.php");
}
require "./database/db_controller.php";
$sql = "SELECT `sign-up`.`id`,`sign-up`.`name`,`sign-up`.`email`,`driver_profile`.`driver_id`, `driver_profile`.`status` FROM `sign-up` INNER JOIN `driver_profile` ON `sign-up`.`id` = `driver_profile`.`driver_id` AND `driver_profile`.`status` = 'Pending'";
$stmt = mysqli_query($con, $sql);

?>


<?php $interface = 'Admin';
require_once "./partials/header.php"; ?>

<header class="jumbotron p-5 bg-light text-white mt-5">
    <h4 class="text-success ms-5 mt-2">Interface Interface Main</h4>
</header>

<div class="pad px-2">
    <main class="container border-white border-5 rounded-3 mt-5 bg-white px-2">
        <section class="py-5">
            <div class="col-lg-8 m-auto">
                <h2>
                    Accept / Reject Driver Requests
                </h2>
                <hr>
                <div class="table-responsive mt-5">
                    <table class="table table-hover">
                        <thead>
                            <th>
                                Driver ID
                            </th>
                            <th>
                                Username
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Information Status
                            </th>
                            <th>
                                Actions
                            </th>
                        </thead>
                        <?php foreach ($stmt as $req) { ?>
                            <tbody>
                                <td>
                                    <?php echo $req['driver_id']; ?>
                                </td>
                                <td>
                                    <?php echo $req['name']; ?>
                                </td>
                                <td>
                                    <?php echo $req['email']; ?>
                                </td>
                                <td>
                                    <?php echo $req['status']; ?>
                                </td>
                                <td>
                                    <form action="./functions/driver-req.php" method="post">
                                        <div class="d-flex">
                                            <input type="hidden" name="driver_id" value="<?php echo $req['driver_id']; ?>">
                                            <button type="submit" name="details" class="btn btn-sm btn-secondary m-auto">Detail</button>
                                            <button type="submit" name="accept_req" class="btn btn-sm btn-success m-auto">Accept</button>
                                            <button type="submit" name="reject_req" class="btn btn-sm btn-danger m-auto">Reject</button>
                                        </div>
                                    </form>
                                </td>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </section>

    </main>
</div>

<script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>