<?php
session_start();

require "../database/db_controller.php";

if (!$_SESSION['user_id']) {
    $user_id_err = "Something Went Wrong";
    exit;
} else {
    $user_id = $_SESSION['user_id'];
}
if (isset($_POST['submit-profile'])) {
    if (!is_dir('../images/users')) {
        mkdir('../images/users');
    }
    $filename = $user_id.$_FILES['profile_img']['name'];
    $tempname = $_FILES['profile_img']['tmp_name'];
    $folder = "./images/users/" . $filename;
    move_uploaded_file($tempname, "../images/users/" . $filename);
    $sql = "INSERT INTO `user_profile`(user_id,profile_img) VALUES($user_id,'$folder')";
    $stmt = mysqli_query($con, $sql);
    var_dump($stmt);
    mysqli_close($con);
    if($stmt){
        header("location: ../user-interface.php");
    }
}
