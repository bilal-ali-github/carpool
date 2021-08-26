<?php

session_start();

require "../database/db_controller.php";

if (!$_SESSION['driver_id']) {
    $driver_id_err = "Something Went Wrong";
    exit;
} else {
    $driver_id = $_SESSION['driver_id'];
}

if (isset($_POST['create_event'])) {
    $departure_city = $departure_city_err = "";
    $arrival_city = $arrival_city_err = "";
    $date = $date_err = "";
    $time = $time_err = "";
    $fare = $fare_err = "";
    $status = "Pending";
    if (empty($_POST['departure_city'])){
        $departure_city_err = "Please Select Departure City";
        
    } else {
        $departure_city = $_POST['departure_city'];
        var_dump($departure_city);
    }
    
    if (empty($_POST['arrival_city'])) {
        $arrival_city_err = "Please Select Arrival City";
    } else {
        $arrival_city = $_POST['arrival_city'];
        var_dump($arrival_city);
    }
    if (empty($_POST['date'])) {
        $date_err = "Please Select Date";
    } else {
        $date = date('Y-m-d', strtotime($_POST['date']));
        var_dump($date);
    }
    if (empty($_POST['time'])) {
        $time_err = "Please Select Time";
    } else {
        $time = date('H:i:s', strtotime($_POST['time']));
        var_dump($time);
    }
    if (empty($_POST['fare'])) {
        $fare_err = "Please Enter Fare";
    } else {
        $fare = $_POST['fare'];
        var_dump($fare);
    }
    if (empty($departure_city_err) && empty($arrival_city_err) && empty($date_err) && empty($time_err) && empty($fare_err)) {
        echo "Here";
        $sql = "INSERT INTO `events` (driver_id,departure_city,arrival_city,date,time,fare,status) VALUES ($driver_id,'$departure_city','$arrival_city','$date','$time',$fare,'$status')";
        $stmt = mysqli_query($con, $sql);
        var_dump($stmt);
        if ($stmt) {
            header("location: ../driver-interface.php");
        }
    }
}
