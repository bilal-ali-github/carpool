<?php
session_start();
if (!isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] !== true && $_SESSION['user_role'] != 'User') {
    header("location: index.php");
}
require "./database/db_controller.php";
$user_id = $_SESSION['user_id'];
$img_path = "";
$sql = "SELECT profile_img FROM `user_profile` WHERE user_id = ?";
$stmt = mysqli_prepare($con,$sql);
if($stmt){
    mysqli_stmt_bind_param($stmt,"i",$param_user_id);
    $param_user_id = $user_id;
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1){
            mysqli_stmt_bind_result($stmt,$profile_img);
            if(mysqli_stmt_fetch($stmt)){
                $img_path = $profile_img;
            }
        }
    }
    mysqli_stmt_close($stmt);
}

$sql_events = "SELECT * FROM `events` WHERE `status` = 'Accepted'";
$stmt_events = mysqli_query($con,$sql_events);

mysqli_close($con);
?>


<?php $interface = 'User'; require_once "./partials/header.php"; ?>


<header class="jumbotron p-5 bg-light text-white mt-5">
    <h4 class="text-success ms-5 mt-4"> User Interface Main </h4>
</header>


<div class="pad px-2">
    <main class="container border border-white border-5 rounded-3 mt-5 bg-white px-2">
        <div class="col-lg-8 m-auto">
            <section class="mt-5">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-6 col-md-4">
                                <img src="<?php if(empty($img_path)){echo "./images/default.jpg";}else{echo $img_path;} ?>" class="img-fluid rounded-circle border border-5 border-success" alt="Profile Image">
                                <!-- ModalBtn -->
                                <?php if(empty($img_path)){ echo '<span class="badge bg-success rounded-circle p-1 text-white" role="button" data-bs-toggle="modal" data-bs-target="#exampleModalToggle"><i class="bi bi-pencil-fill"></i></span>';} ?>
                                <!-- ModalBtn:End -->
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalToggleLabel">Please Sign In to Continue</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <section class="mt-5">
                                                    <h5 class="text-center mb-4 text-success">Add / Change Profile Image,</h2>
                                                        <form action="./functions/user-submit.php" method="post" enctype="multipart/form-data">
                                                            <div class="mb-3 col-sm-6 m-auto">
                                                                <label for="upload" class="form-label ">Upload Picture</label>
                                                                <input type="file" class="form-control" name="profile_img">
                                                            </div>
                                                            <div class="col-sm-6 m-auto">
                                                                <div class="text-center">
                                                                    <button name="submit-profile" type="submit" class="btn btn-success btn-md mt-5">Submit</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal:End -->
                            </div>
                            <div class="col-6 col-md-8 align-self-center">
                                <h3>Username</h3>
                                <p>username@email.com | 03355815387</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 align-self-center">
                    <div class="row py-5">
                        <div class="col d-grid gap-2">
                            <button class="btn btn-success"><a href="" class="bi bi-arrow-repeat text-white text-decoration-none"> Event Running</a></button>
                        </div>
                        <div class="col d-grid gap-2">
                            <button class="btn btn-success"><a href="user-response.php" class="bi bi-question-circle-fill text-white text-decoration-none"> Queries</a></button>
                        </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="mt-5">
                <h2 class="">Search,</h2>
                <form action="" method="post">
                    <div class="mt-4 col-sm m-auto">
                        <div class="row">
                            <div class="p-1 col-sm-4">
                                <select class="form-select" id="departure_city">
                                    <option selected>Select Departure City</option>
                                    <option value="1">Islamabad</option>
                                    <option value="2">Rawalpind</option>
                                    <option value="3">Lahore</option>
                                </select>
                            </div>
                            <div class="p-1 col-sm-4">
                                <select class="form-select" id="arrival_city">
                                    <option selected>Select Arrival City</option>
                                    <option value="1">Islamabad</option>
                                    <option value="2">Rawalpind</option>
                                    <option value="3">Lahore</option>
                                </select>
                            </div>
                            <div class="p-1 col-sm-4">
                                <input type="date" class="form-control" name="date" id="date">
                            </div>
                        </div>
                        <div class="text-center ">
                            <button id="submit" type="button " class="btn btn-outline-success btn-md mt-5 " onclick="">Search Event</button>
                        </div>
                    </div>
                </form>
            </section>

            <hr>

            <section class="mt-5 mb-5">
                <h2>On Going Events</h2>
                <div class="m-auto mt-4 table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>
                                Departure City
                            </th>
                            <th>
                                Arrival City
                            </th>
                            <th>
                                Date | Time
                            </th>
                            <th>
                                Ride Fare
                            </th>
                            <th>
                                &nbsp;
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </thead>
                        <?php foreach($stmt_events as $event) { ?>
                        <tbody>
                            <td>
                                <?php echo $event['departure_city']; ?>
                            </td>
                            <td>
                                <?php echo $event['arrival_city']; ?>
                            </td>
                            <td>
                                <?php echo $event['date']; ?> | <?php echo $event['time']; ?>
                            </td>
                            <td>
                                <?php echo $event['fare']; ?>
                            </td>
                            <td>
                                <form action="./view-driver-profile.php" method="post">
                                    <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                                    <input type="hidden" name="driver_id" value="<?php echo $event['driver_id']; ?>">
                                    <button type="submit" name="view_driver" class="btn btn-sm btn-success">More Info</button>
                                </form>
                            </td>
                            <td>
                                
                            </td>
                        </tbody>
                        <?php } ?>
                    </table>
                </div>
            </section>
        </div>
    </main>
</div>


<script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>