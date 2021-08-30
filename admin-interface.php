<?php

session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true || $_SESSION['admin_role'] != 'Admin') {
    header("location: index.php");
}
require "./database/db_controller.php";

$sql_table = "SELECT * FROM `events` WHERE `status` = 'Pending'";
$stmt = mysqli_query($con, $sql_table);

?>

<?php $interface = 'Admin'; require_once "./partials/header.php"; ?>

<header class="jumbotron p-5 bg-light text-white mt-5">
    <h4 class="text-success ms-5 mt-2">Admin Interface Main</h4>
</header>

<div class="pad px-2">
    <main class="container border border-white border-5 rounded-3 mt-5 bg-white px-2">
        <section class="mt-5">
            <div class="col-md-8 m-auto">
                <div class="row text-center">
                    <div class="col-6 align-self-center">
                        <h5>View Driver Requests</h5>
                    </div>
                    <div class="col-6">
                        <a href="admin-reqs.php" class="btn btn-sm btn-outline-success">Requests</a>
                    </div>
                </div>
            </div>
            <div class="mt-3 col-md-8 m-auto">
                <div class="row text-center">
                    <div class="col-6 align-self-center">
                        <h5>Restrict / Delete Events</h5>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-sm btn-outline-success px-3">Events</button>
                    </div>
                </div>
            </div>
            <div class="mt-3 col-md-8 m-auto">
                <div class="row text-center">
                    <div class="col-6 align-self-center">
                        <h5>Change Passenger and Driver Roles</h5>
                    </div>
                    <div class="col-6 align-self-center">
                        <button class="btn btn-sm btn-outline-success px-3">Roles</button>
                    </div>
                </div>
            </div>
        </section>
        <br>
        <hr>
        <br>
        <section class="mb-5">
            <center class="mb-5">
                <h4> Carpooling Event Requests</h4>
            </center>
            <div class="col-lg-8 m-auto">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="text-center">
                            <th>
                                Trip ID
                            </th>
                            <th>
                                Driver ID
                            </th>
                            <th>
                                From | To
                            </th>
                            <th>
                                Date | Time
                            </th>
                            <th>
                                Fare
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Actions
                            </th>
                        </thead>
                        <?php foreach ($stmt as $event) { ?>
                            <tbody class="text-center">
                                <td>
                                    <?php echo $event['id']; ?>
                                </td>
                                <td>
                                    <?php echo $event['driver_id']; ?>
                                </td>
                                <td>
                                    <?php echo $event['departure_city']; ?> | <?php echo $event['arrival_city']; ?>
                                </td>
                                <td>
                                    <?php echo $event['date']; ?> | <?php echo $event['time']; ?>
                                </td>
                                <td>
                                    <?php echo $event['fare']; ?> Rs
                                </td>
                                <td>
                                    <?php echo $event['status']; ?>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <form action="./functions/event-req.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
                                            <button name="accept_req" type="submit" class="btn btn-sm btn-success my-1">Accept</button>

                                            <button name="reject_req" type="submit" class="btn btn-sm btn-danger my-1">Reject</button>
                                        </form>
                                    </div>
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