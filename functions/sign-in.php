<?php
session_start();

require_once "../database/db_controller.php";

$email = $email_err = "";
$password = $password_err = "";
$role = "";

if (isset($_POST['sign-in'])) {
    $email = trim($_POST['email']);
    if (empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Please Enter Email";
    }
    $password = trim($_POST['password']);
    if (empty($password)) {
        $password_err = "Please Enter Password";
    }
    $sql = "SELECT id,email,password,role FROM `sign-up` WHERE email =?";
    $stmt = mysqli_prepare($con, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $param_email);
        $param_email = $email;
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password, $role);
                if (mysqli_stmt_fetch($stmt)) {
                    if (password_verify($password, $hashed_password)) {
                        if ($role == 'User') {
                            $_SESSION['user_id'] = $id;
                            $_SESSION['user_email'] = $email;
                            $_SESSION['user_role'] = $role;
                            $_SESSION['user_logged_in'] = true;
                            header("location: ../user-interface.php");
                        }
                        elseif($role == 'Driver'){
                            $_SESSION['driver_id'] = $id;
                            $_SESSION['driver_email'] = $email;
                            $_SESSION['driver_role'] = $role;
                            $_SESSION['driver_logged_in'] = true;
                            header("location: ../driver-interface.php");
                        }
                        elseif($role == 'Admin'){
                            $_SESSION['admin_id'] = $id;
                            $_SESSION['admin_role'] = $role;
                            $_SESSION['admin_logged_in'] = true;
                            header("location: ../admin-interface.php");
                        }
                    }
                }
            }
        }
    }
}
