<?php
session_start();

require "../database/db_controller.php";

if (!$_SESSION['driver_id']) {
    $driver_id_err = "Something Went Wrong";
    exit;
} else {
    $driver_id = $_SESSION['driver_id'];
}
if (isset($_POST['profile_submit'])) {
    $sql = "SELECT `driver_id` FROM `driver_profile` WHERE `driver_id` = ?";
    $stmt = $stmt = mysqli_prepare($con, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = $driver_id;
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                if (empty($_FILES['profile_img'])) {
                    $profile_img_err = "Please Input Image File";
                } else {
                    $profile_img = $_FILES['profile_img'];
                }
                if (empty(trim($_POST['car_name']))) {
                    $car_name_err = "Please Enter Car Name";
                } else {
                    $car_name = trim($_POST['car_name']);
                }
                if (empty(trim($_POST['reg_num']))) {
                    $reg_num_err = "Please Enter Car Registration Number";
                } else {
                    $reg_num = trim($_POST['reg_num']);
                }
                if (empty(($_FILES['car_img']))) {
                    $car_img_err = "Please Input Car Image";
                } else {
                    $car_img = $_FILES['car_img'];
                }
                if (empty(trim($_POST['car_color']))) {
                    $car_color_err = "Please Enter Car Color";
                } else {
                    $car_color = $_POST['car_color'];
                }
                if (empty(trim($_POST['car_seats']))) {
                    $car_seats_err = "Please Enter Car Seats";
                } else {
                    $car_seats = $_POST['car_seats'];
                }
                if (empty($profile_img_err) || empty($car_name_err) || empty($reg_num_err) || empty($car_img_err) || empty($car_color_err) || empty($car_seats_err)) {
                    if (!is_dir('../images/drivers')) {
                        mkdir('../images/drivers');
                    }
                    $filename_profile = $driver_id . $_FILES['profile_img']['name'];
                    $tempname = $_FILES['profile_img']['tmp_name'];
                    $folder_profile = "./images/drivers/" . $filename_profile;
                    move_uploaded_file($tempname, "../images/drivers/" . $filename_profile);

                    if (!is_dir('../images/drivers/car_images')) {
                        mkdir('../images/drivers/car_images');
                    }
                    $filename_car = $driver_id . $_FILES['car_img']['name'];
                    $tempname = $_FILES['car_img']['tmp_name'];
                    $folder_car = "./images/drivers/car_images/" . $filename_car;
                    move_uploaded_file($tempname, "../images/drivers/car_images/" . $filename_car);

                    $sql = "UPDATE `driver_profile` SET `driver_id` = $driver_id, `profile_img` = '$folder_profile', `car_name` = '$car_name', `reg_num` = '$reg_num', `car_img` = '$folder_car', `car_color` = '$car_color', `car_seats` = $car_seats, `status` = 'Pending'";
                    $stmt = mysqli_query($con, $sql);
                    if ($stmt) {
                        header("location: ../driver-interface.php");
                    }
                }
                mysqli_close($con);
            }
            else {
                echo "Inelses";
                $profile_img = $profile_img_err = "";
                $car_name = $car_name_err = "";
                $reg_num = $reg_num_err = "";
                $car_img = $car_img_err = "";
                $car_color = $car_color_err = "";
                $car_seats = $car_seats_err = 0;
                $status = "Pending";

                if (empty($_FILES['profile_img'])) {
                    $profile_img_err = "Please Input Image File";
                } else {
                    $profile_img = $_FILES['profile_img'];
                }
                if (empty(trim($_POST['car_name']))) {
                    $car_name_err = "Please Enter Car Name";
                } else {
                    $car_name = trim($_POST['car_name']);
                }
                if (empty(trim($_POST['reg_num']))) {
                    $reg_num_err = "Please Enter Car Registration Number";
                } else {
                    $reg_num = trim($_POST['reg_num']);
                }
                if (empty(($_FILES['car_img']))) {
                    $car_img_err = "Please Input Car Image";
                } else {
                    $car_img = $_FILES['car_img'];
                }
                if (empty(trim($_POST['car_color']))) {
                    $car_color_err = "Please Enter Car Color";
                } else {
                    $car_color = $_POST['car_color'];
                }
                if (empty(trim($_POST['car_seats']))) {
                    $car_seats_err = "Please Enter Car Seats";
                } else {
                    $car_seats = $_POST['car_seats'];
                }
                if (empty($profile_img_err) || empty($car_name_err) || empty($reg_num_err) || empty($car_img_err) || empty($car_color_err) || empty($car_seats_err)) {
                    if (!is_dir('../images/drivers')) {
                        mkdir('../images/drivers');
                    }
                    $filename_profile = $driver_id . $_FILES['profile_img']['name'];
                    $tempname = $_FILES['profile_img']['tmp_name'];
                    $folder_profile = "./images/drivers/" . $filename_profile;
                    move_uploaded_file($tempname, "../images/drivers/" . $filename_profile);

                    if (!is_dir('../images/drivers/car_images')) {
                        mkdir('../images/drivers/car_images');
                    }
                    $filename_car = $driver_id . $_FILES['car_img']['name'];
                    $tempname = $_FILES['car_img']['tmp_name'];
                    $folder_car = "./images/drivers/car_images/" . $filename_car;
                    move_uploaded_file($tempname, "../images/drivers/car_images/" . $filename_car);

                    $sql = "INSERT INTO `driver_profile`(driver_id,profile_img,car_name,reg_num,car_img,car_color,car_seats,status) VALUES($driver_id,'$folder_profile','$car_name','$reg_num','$folder_car','$car_color',$car_seats,'$status')";
                    $stmt = mysqli_query($con, $sql);
                    if ($stmt) {
                        
                    }
                }
                mysqli_close($con);
            } 
        }
    }
}
