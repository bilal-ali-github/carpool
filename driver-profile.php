<?php
session_start();
if (!isset($_SESSION['driver_logged_in']) || $_SESSION['driver_logged_in'] !== true || $_SESSION['driver_role'] != 'Driver') {
    header("location: index.php");
    
}
require "./database/db_controller.php";

$driver_id = $_SESSION['driver_id'];
$sql = "SELECT `sign-up`.`name`,`sign-up`.`email`,`sign-up`.`phone_no`,`driver_profile`.`profile_img`,`driver_profile`.`car_name`,`driver_profile`.`reg_num`,`driver_profile`.`car_img`,`driver_profile`.`car_color`,`driver_profile`.`car_seats`,`driver_profile`.`status`,`driver_profile`.`vehicle_type` FROM `sign-up` INNER JOIN `driver_profile` ON `sign-up`.`id` = ? AND `driver_profile`.`driver_id` = ?";
$stmt = mysqli_prepare($con,$sql);
$driver_name = '';
$driver_email = '';
$driver_phone = '';
$driver_img = '';
$driver_car_name = '';
$driver_reg_num = '';
$driver_car_img = '';
$driver_car_color = '';
$driver_car_seats = 0;
$driver_status = '';
$driver_vehicle_type = '';
if($stmt){
    mysqli_stmt_bind_param($stmt,"ii",$param_id,$param_id_);
    $param_id = $param_id_ = $driver_id;
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1){
            mysqli_stmt_bind_result($stmt,$name,$email,$phone,$profile_img,$car_name,$reg_num,$car_img,$car_color,$car_seats,$status,$vehicle_type);
            if(mysqli_stmt_fetch($stmt)){
                $driver_name = $name;
                $driver_email = $email;
                $driver_phone = $phone;
                $driver_img = $profile_img;
                $driver_car_name = $car_name;
                $driver_reg_num = $reg_num;
                $driver_car_img = $car_img;
                $driver_car_color = $car_color;
                $driver_car_seats = $car_seats;
                $driver_status = $status;
                $driver_vehicle_type = $vehicle_type;
            }
        }
    }
}

?>
<?php $interface = 'Driver';
require_once "./partials/header.php"; ?>

<header class="jumbotron p-5 bg-light text-white mt-5">
    <h4 class="text-success ms-5 mt-3">Driver Interface Profile</h4>
</header>

<div class="pad px-2">
    <main class="container border border-white border-5 rounded-3 mt-5 bg-white px-2">
        <div class="col-lg-8 m-auto">
            <section class="mt-5">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-6 col-md-4">
                                <img src="<?php echo $driver_img; ?>" class="img-fluid rounded-circle border border-5 border-success" alt="Profile Image">
                            </div>
                            <div class="col-6 col-md-8 align-self-center">
                                <h3><?php echo $driver_name; ?></h3>
                                <p><?php echo $driver_email; ?> | <?php echo $driver_phone; ?></p>
                                <p class=""><span class="badge bg-white rounded-pill" role="button" <?php if(empty($driver_status || $driver_status == 'Rejected')){echo "data-bs-toggle=\"tooltip\" data-bs-placement=\"right\" data-bs-html=\"true\" title=\"Please Submit Profile For Application as Driver \"";} ?>><a class="<?php if(empty($driver_status) || $driver_status == 'Rejected'){echo 'bi bi-exclamation-circle text-danger' ;}elseif($driver_status == 'Pending'){echo 'bi bi-arrow-repeat text-warning';}elseif($driver_status == 'Accepted'){echo 'bi bi-check2-circle text-success';} ?> text-decoration-none"> <?php if(empty($driver_status) || $driver_status == 'Rejected'){ echo 'Complete Profile';}elseif($driver_status == 'Pending'){echo 'In Review';}elseif($driver_status == 'Accepted'){echo 'Verified';}?> </a></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 align-self-center">
                    </div>
                </div>
            </section>
            <section class="mt-5 mb-5">
                <div class="row">
                    <h3>Driver Info</h2>
                        <div class="col-sm-6  align-self-center">
                            <h5>Car Type : <?php echo $driver_vehicle_type; ?></h5>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <p>Car Name : <b><?php echo $driver_car_name; ?></b></p>
                                </div>
                                <div class="col-6">
                                    <p>Reg Number : <b><?php echo $driver_reg_num; ?></b></p>
                                </div>
                                <div class="col-6">
                                    <p>Car Color : <b><?php echo $driver_car_color; ?></b></p>
                                </div>
                                <div class="col-6">
                                    <p>Seats Available : <b>0<?php echo $driver_car_seats; ?></b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="">
                                <img src="<?php echo $driver_car_img; ?>" class="img-fluid img-thumbnail" alt="Driver <?php echo $driver_name; ?> Car">
                            </div>
                        </div>
                </div>
            </section>
        </div>
    </main>
</div>


<script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>