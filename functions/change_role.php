<?php

session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true || $_SESSION['admin_role'] != 'Admin') {
    header("location: ../index.php");
}
require "../database/db_controller.php";

if(isset($_POST['change_role'])){
    $id = $_POST['id'];
    $curr_role = '';
    $sql = "SELECT role FROM `sign-up` WHERE `id` = ?";
    $stmt = mysqli_prepare($con,$sql);
    if($stmt){
        mysqli_stmt_bind_param($stmt,"i",$param_id);
        $param_id = $id;
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1){
            mysqli_stmt_bind_result($stmt, $role);
            mysqli_stmt_fetch($stmt);
            $curr_role = $role;
            if($curr_role == 'User'){
                $sql = "UPDATE `sign-up` SET `role`= 'Driver' WHERE `id` = $id";
                $stmt = mysqli_query($con,$sql);
                if($stmt){
                    header("location: ../admin-role.php");
                }
            }
            elseif($curr_role = 'Driver'){
                $sql_1 = "UPDATE `sign-up` SET `role` = 'User' WHERE `id` = $id";
                $stmt_1 = mysqli_query($con,$sql_1);
                $sql_2 = "DELETE FROM `driver_profile` WHERE `driver_id` = $id";
                $stmt_2 = mysqli_query($con,$sql_2);
                $sql_3 = "DELETE FROM `events` WHERE `driver_id` = $id";
                $stmt = mysqli_query($con,$sql_3);
                if($sql_1 && $sql_2 && $sql_3){
                    header("location: ../admin-role.php");
                }
            }
        }
    }
    mysqli_close($con);
}