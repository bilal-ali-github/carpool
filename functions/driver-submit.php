<?php
session_start();

require "../database/db_controller.php";

if (!$_SESSION['driver_id']) {
    $driver_id_err = "Something Went Wrong";
    exit;
} else {
    $driver_id = $_SESSION['driver_id'];
}
$profile_img = $profile_img_err = "";
$car_name = $car_name_err = "";
$reg_num = $reg_num_err = "";
$car_img = $car_img_err = "";
$car_color = $car_color_err = "";
$car_seats = $car_seats_err = 0;

if (isset($_POST['profile_submit'])) {
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
    if (empty(trim($_FILES['car_img']))) {
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
        $folder_car = "./images/drivers/" . $filename_car;
        move_uploaded_file($tempname, "../images/drivers/" . $filename_car);

        $sql = "INSERT INTO `driver_profile`(driver_id,profile_img,car_name,reg_num,car_img,car_color,car_seats) VALUES($driver_id,'$folder_profile','$car_name','$reg_num','$folder_car','$car_color',$car_seats)";
        $stmt = mysqli_query($con, $sql);
        if ($stmt) {
            header("location: ../driver-interface.php");
        }
    }
    mysqli_close($con);
}
