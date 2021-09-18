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

$sql_requests = "SELECT * FROM `event_join` WHERE `driver_id` = $driver_id AND `status` = 'Requested'";
$stmt_requests = mysqli_query($con,$sql_requests);

mysqli_close($con);
?>

<?php $interface = 'Driver';
require_once "./partials/header.php"; ?>

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
                            </div>
                            <div class="col-6 col-md-8 align-self-center">
                                <h3>Username</h3>
                                <p>username@email.com | 03355815387</p>
                                <p class=""><span class="badge bg-white rounded-pill" role="button" <?php if(empty($curr_status || $curr_status == 'Rejected')){echo "data-bs-toggle=\"tooltip\" data-bs-placement=\"right\" data-bs-html=\"true\" title=\"Please Submit Profile For Application as Driver \"";} ?>><a class="<?php if(empty($curr_status) || $curr_status == 'Rejected'){echo 'bi bi-exclamation-circle text-danger' ;}elseif($curr_status == 'Pending'){echo 'bi bi-arrow-repeat text-warning';}elseif($curr_status == 'Accepted'){echo 'bi bi-check2-circle text-success';} ?> text-decoration-none"> <?php if(empty($curr_status) || $curr_status == 'Rejected'){ echo 'Complete Profile';}elseif($curr_status == 'Pending'){echo 'In Review';}elseif($curr_status == 'Accepted'){echo 'Verified';}?> </a></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 align-self-center p-5 d-flex">
                    </div>
                </div>
            </section>
            <section class="mt-5 mb-5">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>
                                Event ID
                            </th>
                            <th>
                                User ID
                            </th>
                            <th>
                                Request to Join
                            </th>
                        </thead>
                        <?php foreach($stmt_requests as $reqs) { ?>
                        <tbody>
                            <td>
                                <?php echo $reqs['event_id']; ?>
                            </td>
                            <td>
                                <?php echo $reqs['user_id']; ?>
                            </td>
                            <td>
                                <form>
                                    <div class="d-flex m-auto">
                                        <button type="submit" name="accept_req" class="btn btn-success btn-sm">Accept</button>
                                        <button type="submit" name="accept_req" class="btn btn-success btn-sm">Accept</button>
                                    </div>
                                </form>
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
</httml>
