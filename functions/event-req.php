<?php

session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true || $_SESSION['admin_role'] != 'Admin') {
    header("location: index.php");
}
require "../database/db_controller.php";
if (isset($_POST['accept_req'])) {
    $event_id = $_POST['id'];
    $sql = "UPDATE `events` SET `status` = 'Accepted' WHERE `id` = $event_id";
    $stmt = mysqli_query($con, $sql);
    if ($stmt) {
        header("location: ../admin-interface.php");
    } else {
        echo "Something Went Wrong";
    }
}
if (isset($_POST['reject_req'])) {
    $event_id = $_POST['id'];
    $sql = "UPDATE `events` SET `status` = 'Rejected' WHERE `id` = $event_id";
    $stmt = mysqli_query($con, $sql);
    if ($stmt) {
        header("location: ../admin-interface.php");
    } else {
        echo "Something Went Wrong";
    }
}
mysqli_close($con);
