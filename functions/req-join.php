<?php
session_start();
if (!isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] !== true && $_SESSION['user_role'] != 'User') {
    header("location: index.php");
}
require "../database/db_controller.php";

if(isset($_POST['req_join'])){
    $event_id = $_POST['event_id'];
    $user_id = $_POST['user_id'];
    $driver_id = $_POST['driver_id'];
    $status = 'Requested';

    $sql = "INSERT INTO `event_join`(user_id,driver_id,event_id,status) VALUES($user_id,$driver_id,$event_id,'$status')";
    $stmt = mysqli_query($con,$sql);
    if($stmt){
        header("location: ../user-interface.php");
    }
    else{
        echo "Something Went Wrong";
    }
}

mysqli_close($con);