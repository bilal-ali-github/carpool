<?php
session_start();
if (!isset($_SESSION['driver_logged_in']) || $_SESSION['driver_logged_in'] !== true || $_SESSION['driver_role'] != 'Driver') {
    header("location: index.php");
    
}
require "./database/db_controller.php";

$driver_id = $_SESSION['driver_id'];
$count = 0;
$sql_events = "SELECT * FROM `events` WHERE driver_id = $driver_id";
$stmt_events = mysqli_query($con,$sql_events);

$img_path = "";
$curr_status = "";
$sql_profile = "SELECT profile_img,status FROM `driver_profile` WHERE driver_id = ?";
$stmt_profile = mysqli_prepare($con,$sql_profile);
if($stmt_profile){
    mysqli_stmt_bind_param($stmt_profile,"i",$param_driver_id);
    $param_driver_id = $driver_id;
    if(mysqli_stmt_execute($stmt_profile)){
        mysqli_stmt_store_result($stmt_profile);
        if(mysqli_stmt_num_rows($stmt_profile) == 1){
            mysqli_stmt_bind_result($stmt_profile,$profile_img,$status);
            if(mysqli_stmt_fetch($stmt_profile)){
                $img_path = $profile_img;
                $curr_status = $status;
            }
        }
    }
}


mysqli_close($con);
$interface = 'Admin';
require_once "./partials/header.php";


?>

<header class="jumbotron p-5 bg-light text-white mt-5">
    <h4 class="text-success ms-5 mt-4">Driver Interface Profile</h4>
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
                                <?php if(empty($img_path) || $curr_status == 'Rejected' ){ echo '<span class="badge bg-success rounded-circle p-1 text-white" role="button" data-bs-toggle="modal" data-bs-target="#create-modal"><i class="bi bi-pencil-fill"></i></span>';} ?>
                                <!-- ModalBtn:End -->
                                <!-- Modal -->
                                <div class="modal fade" id="create-modal" aria-hidden="true" aria-labelledby="ModalToggle" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalToggleLabel">Driver Profile</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <section class="mt-5">
                                                    <h5 class="text-center mb-4 text-success">Create and Submit Profile</h2>
                                                        <form action="./functions/driver-submit.php" method="post" enctype="multipart/form-data">
                                                            <div class="mb-3 col-sm-8 m-auto">
                                                                <label for="profile-image" class="form-label">Upload Profile Picture</label>
                                                                <input class="form-control mb-1" type="file" name="profile_img" id="profile_img">
                                                            </div>
                                                            <div class="mb-3 col-sm-8 m-auto">
                                                                <label for="car_name" class="form-label">Car Name</label>
                                                                <input type="text" class="form-control " placeholder="Enter Car Name" name="car_name">
                                                            </div>
                                                            <div class="mb-3 col-sm-8 m-auto">
                                                                <label for="reg_num" class="form-label">Car Registration Number</label>
                                                                <input type="text" class="form-control" placeholder="Enter Car Registration Number" name="reg_num">
                                                            </div>
                                                            <div class="mb-3 col-sm-8 m-auto ">
                                                                <label for="car_img " class="form-label ">Car Image</label>
                                                                <input type="file" class="form-control" name="car_img">
                                                            </div>
                                                            <div class="mb-3 col-sm-8 m-auto ">
                                                                <label for="car_color" class="form-label">Car Color</label>
                                                                <input type="text" class="form-control " placeholder="Enter Car Color" name="car_color">
                                                            </div>
                                                            <div class="mb-3 col-sm-8 m-auto ">
                                                                <label for="car_seats" class="form-label">Car Seats</label>
                                                                <input type="number" class="form-control " placeholder="Enter Passenger Seats Available" name="car_seats">
                                                            </div>
                                                            <div class="mb-3 col-sm-8 m-auto ">
                                                                <div class="text-center ">
                                                                    <button type="submit" class="btn btn-success btn-md mt-5" name="profile_submit">Submit</button>
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
                                <p class=""><span class="badge bg-white rounded-pill" role="button" <?php if(empty($curr_status || $curr_status == 'Rejected')){echo "data-bs-toggle=\"tooltip\" data-bs-placement=\"right\" data-bs-html=\"true\" title=\"Please Submit Profile For Application as Driver \"";} ?>><a class="<?php if(empty($curr_status) || $curr_status == 'Rejected'){echo 'bi bi-exclamation-circle text-danger' ;}elseif($curr_status == 'Pending'){echo 'bi bi-arrow-repeat text-warning';}elseif($curr_status == 'Accepted'){echo 'bi bi-check2-circle text-success';} ?> text-decoration-none"> <?php if(empty($curr_status) || $curr_status == 'Rejected'){ echo 'Complete Profile';}elseif($curr_status == 'Pending'){echo 'In Review';}elseif($curr_status == 'Accepted'){echo 'Verified';}?> </a></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 align-self-center p-5 d-flex">
                        <?php if($curr_status == 'Pending' || $curr_status == 'Accepted'){echo '<p class="ms-5"><span class="badge bg-success p-2"><a href="#" class="bi bi-envelope-open-fill text-white text-decoration-none"> Responses</a></span></p> <p class="ms-5"><span class="badge bg-success p-2"><a href="driver-profile.php" class="bi bi-person-fill text-white text-decoration-none"> Profile</a></span></p>';} ?>
                    </div>
                </div>
            </section>

            <hr>

            <section class="mt-5">
                <h2>Create Event</h2>
                <div class="row">
                    <div class="col">
                        <form action="./functions/create-event.php" method="post">
                            <div class="mt-4">
                                <div class="row">
                                    <div class="p-1 col-sm">
                                        <label class="form-label" for="departure_city">Departure City</label>
                                        <select class="form-select" id="departure_city" name="departure_city" <?php if(empty($curr_status) || $curr_status == 'Pending' || $curr_status == 'Rejected' ){echo 'disabled';} ?>>
                                            <option selected>Select Departure City</option>
                                            <option  value="Islamabad">Islamabad</option>
                                            <option  value="Rawalpindi">Rawalpindi</option>
                                            <option value="Lahore">Lahore</option>
                                        </select>
                                    </div>
                                    <div class="p-1 col-sm">
                                        <label class="form-label" for="arrival_city">Arrival City</label>
                                        <select class="form-select" id="arrival_city" name="arrival_city" <?php if(empty($curr_status) || $curr_status == 'Pending' || $curr_status == 'Rejected'){echo 'disabled';} ?>>
                                            <option selected>Select Arrival City</option>
                                            <option  value="Islamabad">Islamabad</option>
                                            <option  value="Rawalpindi">Rawalpindi</option>
                                            <option  value="Lahore">Lahore</option>
                                        </select>
                                    </div>
                                    <div class="p-1 col-sm">
                                        <label class="form-label" for="date">Departure Date</label>
                                        <input type="date" class="form-control" name="date" id="date" <?php if(empty($curr_status) || $curr_status == 'Pending' || $curr_status == 'Rejected'){echo 'disabled';} ?>>
                                    </div>
                                    <div class="p-1 col-sm">
                                        <label class="form-label" for="time">Departure Time</label>
                                        <input type="time" class="form-control" name="time" id="time" <?php if(empty($curr_status) || $curr_status == 'Pending' || $curr_status == 'Rejected'){echo 'disabled';} ?>>
                                    </div>
                                    <div class="p-1 col-sm">
                                        <label class="form-label" for="fare">Pooling Fare</label>
                                        <input type="number" class="form-control" name="fare" id="fare" placeholder="Enter Fare" <?php if(empty($curr_status) || $curr_status == 'Pending' || $curr_status == 'Rejected'){echo 'disabled';} ?>>
                                    </div>
                                </div>
                                <div class="text-center ">
                                    <button name="create_event" type="submit" class="btn btn-outline-success btn-md mt-5" <?php if(empty($curr_status) || $curr_status == 'Pending' || $curr_status == 'Rejected'){echo 'disabled';} ?>>Create Event</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <hr>
            <?php $event_id = 0; ?>
            <?php if(isset($_POST['update_form'])) { ?>
                <?php $event_id_update = $_POST['update']; ?>
            <section class="mt-5 mb-5">
                <h5>Update Event, <small> ID : <?php echo $event_id_update; ?></small></h5>
                <div class="row">
                    <div class="col">
                        <form action="./functions/update-event.php" method="post">
                            <div class="mt-4">
                                <div class="row">
                                    <div class="p-1 col-sm">
                                        <input type="hidden" name="event_id" value="<?php echo $event_id_update; ?>">
                                        <label class="form-label" for="update_departure_city">Departure City</label>
                                        <select class="form-select" id="update_departure_city" name="update_departure_city">
                                            <option selected>Select Departure City</option>
                                            <option  value="Islamabad">Islamabad</option>
                                            <option  value="Rawalpindi">Rawalpindi</option>
                                            <option value="Lahore">Lahore</option>
                                        </select>
                                    </div>
                                    <div class="p-1 col-sm">
                                        <label class="form-label" for="update_arrival_city">Arrival City</label>
                                        <select class="form-select" id="update_arrival_city" name="update_arrival_city">
                                            <option selected>Select Arrival City</option>
                                            <option  value="Islamabad">Islamabad</option>
                                            <option  value="Rawalpindi">Rawalpindi</option>
                                            <option  value="Lahore">Lahore</option>
                                        </select>
                                    </div>
                                    <div class="p-1 col-sm">
                                        <label class="form-label" for="update_date">Departure Date</label>
                                        <input type="date" class="form-control" name="update_date" id="update_date">
                                    </div>
                                    <div class="p-1 col-sm">
                                        <label class="form-label" for="update_time">Departure Time</label>
                                        <input type="time" class="form-control" name="update_time" id="update_time">
                                    </div>
                                    <div class="p-1 col-sm">
                                        <label class="form-label" for="update_fare">Pooling Fare</label>
                                        <input type="number" class="form-control" name="update_fare" id="update_fare" placeholder="Enter Fare">
                                    </div>
                                </div>
                                <div class="text-center ">
                                    <button name="update_event" type="submit" class="btn btn-outline-success btn-md mt-5">Create Event</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <hr>
            <?php } ?>
            
            
            <section class="mt-5 mb-5">
                <h2>
                    Carpooling Events
                </h2>
                <div class="table-responsive mt-5">
                    <table class="table table-hover">
                        <thead>
                            <th>
                                #
                            </th>
                            <th>
                                Departure City
                            </th>
                            <th>
                                Arrival City
                            </th>
                            <th>
                                Departure Date
                            </th>
                            <th>
                                Departure Time
                            </th>
                            <th>
                                Pooling Fare
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Action
                            </th>
                        </thead>
                        <?php foreach($stmt_events as $event) { ?>
                        <tbody class="p-3">
                            
                            <td>
                                <?php echo $event_id = $event['id'];?>
                            </td>
                            <td>
                                <?php echo $event['departure_city']; ?>
                            </td>
                            <td>
                            <?php echo $event['arrival_city']; ?>
                            </td>
                            <td>
                            <?php echo $event['date']; ?>
                            </td>
                            <td>
                            <?php echo $event['time']; ?>
                            </td>
                            <td>
                            <?php echo $event['fare']; ?>
                            </td>
                            <td>
                            <?php echo $event['status']; ?>
                            </td>
                            <td>
                                <form action="" method="post">
                                <div class="d-flex">
                                    <input type="hidden" name="update" value="<?php echo $event_id; ?>">
                                    <button type="submit" name="update_form" class="btn btn-warning btn-sm m-auto <?php if($event['status']=='Accepted'){echo "disabled";} ?>">Update</button>
                                    <button type="button" class="btn btn-danger btn-sm m-auto">Delete</button>
                                </div>
                                </form>
                            </td>
                        </tbody>
                        <?php } ?>
                    </table>
                </div>
                <?php if(empty($curr_status || $curr_status == 'Pending' ) || $curr_status == 'Rejected'){echo '<div class="display-3 text-center mt-5 text-black-50">No Events Yet !</div>';} ?>
            </section>
        </div>
    </main>
</div>


<script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>