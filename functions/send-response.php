<?php
session_start();
if (!isset($_SESSION['driver_logged_in']) || $_SESSION['driver_logged_in'] !== true || $_SESSION['driver_role'] != 'Driver') {
    header("location: index.php");
    
}
require "../database/db_controller.php";

$driver_id = $_SESSION['driver_id'];

if(isset($_POST['send_response'])){
    $user_id = $_POST['reply_to'];
    $message = $_POST['reply'];
    $sql = "INSERT INTO `responses`(`from`,`to`,`message`) VALUES($driver_id,$user_id,'$message')";
    $stmt = mysqli_query($con,$sql);
    if($stmt){
        header("location: ../driver-response.php");
    }
}