<?php

session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true || $_SESSION['admin_role'] != 'Admin') {
    header("location: ../index.php");
}
require "../database/db_controller.php";
if(isset($_POST['accept_req'])){
    $driver_id = $_POST['driver_id'];
    if(empty(trim($_POST['vehicle_type']))){
        $vehicle_err = "Vehicle Type Required";
    }
    else{
        $vehicle = trim($_POST['vehicle_type']);
    }
    $sql = "UPDATE `driver_profile` SET `status` = 'Accepted',`vehicle_type` = '$vehicle' WHERE `driver_id` = $driver_id";
    $stmt = mysqli_query($con,$sql);
    echo var_dump($stmt);
    if($stmt){
        header("location: ../admin-reqs.php");
    }
    mysqli_close($con);
}
elseif(isset($_POST['reject_req'])){
    $driver_id = $_POST['driver_id'];
    $sql = "UPDATE `driver_profile` SET `status` = 'Rejected' WHERE `driver_id` = $driver_id";
    $stmt = mysqli_query($con,$sql);
    echo var_dump($stmt);
    if($stmt){
        header("location: ../admin-reqs.php");
    }
    mysqli_close($con);
}
