<?php

session_start();
if (!isset($_SESSION['driver_logged_in']) || $_SESSION['driver_logged_in'] !== true || $_SESSION['driver_role'] != 'Driver') {
    header("location: index.php");
    
}

require "../database/db_controller.php";

if(isset($_POST['update_event'])){
    $event_id = $_POST['event_id'];
    $update_departure_city = $update_departure_city_err = "";
    $update_arrival_city = $update_arrival_city_err = "";
    $date = $date_err = "";
    $time = $time_err = "";
    $fare = $fare_err = "";
    $status = "Pending";
    if (empty($_POST['update_departure_city'])){
        $update_departure_city_err = "Please Select Departure City";
        
    } else {
        $update_departure_city = $_POST['update_departure_city'];
        var_dump($update_departure_city);
    }
    
    if (empty($_POST['update_arrival_city'])) {
        $update_arrival_city_err = "Please Select update_Arrival City";
    } else {
        $update_arrival_city = $_POST['update_arrival_city'];
        var_dump($update_arrival_city);
    }
    if (empty($_POST['update_date'])) {
        $date_err = "Please Select Date";
    } else {
        $date = date('Y-m-d', strtotime($_POST['update_date']));
        var_dump($date);
    }
    if (empty($_POST['update_time'])) {
        $time_err = "Please Select Time";
    } else {
        $time = date('H:i:s', strtotime($_POST['update_time']));
        var_dump($time);
    }
    if (empty($_POST['update_fare'])) {
        $fare_err = "Please Enter Fare";
    } else {
        $fare = $_POST['update_fare'];
        var_dump($fare);
    }
    if (empty($update_departure_city_err) && empty($update_arrival_city_err) && empty($date_err) && empty($time_err) && empty($fare_err)) {
        echo "Here";
        $sql = "UPDATE `events` SET `departure_city`= '$update_departure_city',`arrival_city`='$update_arrival_city',`date`= '$date',`time`='$time',`fare`= $fare WHERE `id` = $event_id";
        $stmt = mysqli_query($con, $sql);
        var_dump($stmt);
        if ($stmt) {
            header("location: ../driver-interface.php");
        }
    }
    mysqli_close($con);
}

