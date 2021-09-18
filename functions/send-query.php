<?php
session_start();
if(!isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] !== true && $_SESSION['user_role'] != 'User') {
    header("location: index.php");
    
}
require "../database/db_controller.php";

if(isset($_POST['send_query'])){
    $driver_id = $_POST['driver_id'];
    $user_id = $_SESSION['user_id'];
    $message = $_POST['query'];
    var_dump($driver_id);
    var_dump($user_id);
    var_dump($message);
    $sql = "INSERT INTO `responses`(`from`,`to`,`message`) VALUES($user_id,$driver_id,'$message')";
    $stmt = mysqli_query($con,$sql);
    if($stmt){
        header("location: ../user-interface.php");
    }
    else{
        echo "Something Went Wrong";
    }
}