<?php
session_start();
if (!isset($_SESSION['driver_logged_in']) || $_SESSION['driver_logged_in'] !== true || $_SESSION['driver_role'] != 'Driver') {
    header("location: index.php");
    
}
require "./database/db_controller.php";

$driver_id = $_SESSION['driver_id'];
$count = 0;
$sql_events = "SELECT * FROM `events` WHERE driver_id = $driver_id";
$stmt_events = mysqli_query($con,$sql_events);

$img_path = "";
$curr_status = "";
$sql_profile = "SELECT profile_img,status FROM `driver_profile` WHERE driver_id = ?";
$stmt_profile = mysqli_prepare($con,$sql_profile);
if($stmt_profile){
    mysqli_stmt_bind_param($stmt_profile,"i",$param_driver_id);
    $param_driver_id = $driver_id;
    if(mysqli_stmt_execute($stmt_profile)){
        mysqli_stmt_store_result($stmt_profile);
        if(mysqli_stmt_num_rows($stmt_profile) == 1){
            mysqli_stmt_bind_result($stmt_profile,$profile_img,$status);
            if(mysqli_stmt_fetch($stmt_profile)){
                $img_path = $profile_img;
                $curr_status = $status;
            }
        }
    }
}
$sql_response = "SELECT `sign-up`.`name`,`responses`.`id`,`responses`.`from`,`responses`.`message` FROM `sign-up` INNER JOIN `responses` ON `responses`.`to` = $driver_id AND `sign-up`.`id` = `responses`.`from`";
$stmt_response = mysqli_query($con,$sql_response);
mysqli_close($con);
?>

<?php $interface = 'Driver';
require_once "./partials/header.php"; ?>

<header class="jumbotron p-5 bg-light text-white mt-5">
    <h4 class="text-success ms-5 mt-4">Driver Interface Profile</h4>
</header>

<div class="pad px-2">
    <main class="container border border-white border-5 rounded-3 mt-5 bg-white px-2">
        <div class="col-lg-8 m-auto">
            <section class="mt-5">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-6 col-md-4">
                                <img src="<?php if(empty($img_path)){echo "./images/default.jpg";}else{echo $img_path;} ?>" class="img-fluid rounded-circle border border-5 border-success" alt="Profile Image">
                            </div>
                            <div class="col-6 col-md-8 align-self-center">
                                <h3>Username</h3>
                                <p>username@email.com | 03355815387</p>
                                <p class=""><span class="badge bg-white rounded-pill" role="button" <?php if(empty($curr_status || $curr_status == 'Rejected')){echo "data-bs-toggle=\"tooltip\" data-bs-placement=\"right\" data-bs-html=\"true\" title=\"Please Submit Profile For Application as Driver \"";} ?>><a class="<?php if(empty($curr_status) || $curr_status == 'Rejected'){echo 'bi bi-exclamation-circle text-danger' ;}elseif($curr_status == 'Pending'){echo 'bi bi-arrow-repeat text-warning';}elseif($curr_status == 'Accepted'){echo 'bi bi-check2-circle text-success';} ?> text-decoration-none"> <?php if(empty($curr_status) || $curr_status == 'Rejected'){ echo 'Complete Profile';}elseif($curr_status == 'Pending'){echo 'In Review';}elseif($curr_status == 'Accepted'){echo 'Verified';}?> </a></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 align-self-center p-5 d-flex">
                    </div>
                </div>
            </section>
            <hr>
            <section class="mt-5 mb-5">
                    <h2>Responses</h2>
                    <?php foreach($stmt_response as $query) { ?>
                    <div class="row mt-5">
                        <div class="col-12">
                            <h5>From : <?php echo $query['name'] ?> </h5>
                            <p><?php echo $query['message']; ?></p>
                            <div class="row">
                                <div class="col-6 text-black-50">
                                    <p>Date: | Time: </p>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex">
                                    <form action="./functions/delete-response.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $query['id']; ?>">
                                        <button name="delete" type="submit" class="btn btn-sm btn-outline-danger me-5">Delete</button>
                                    </form>
                                    <button class="btn btn-sm btn-outline-success " name="reply-btn">Reply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <form action="./functions/send-response.php"  method="post" class="form-floating display" name="reply-form">
                                <input type="hidden" name="reply_to" value="<?php echo $query['from']; ?>">
                                <textarea id="reply" name="reply" class="form-control"></textarea>
                                <label for="reply" class="form-label">Reply</label>
                                <div class="mt-3 m-auto">
                                    <button type="submit" name="send_response" class="btn btn-sm btn-success" name="reply-send">Send</button>
                                </div>
                            </form>
                            <p class="text-success display" name="sent"><i class="bi bi-check"></i> Sent !</p>
                        </div>
                    </div>
                    <?php } ?>
                </section>
        </div>
    </main>
</div>


<script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
        const replyform = document.getElementsByName("reply-form")
        const replyBtn = document.getElementsByName("reply-btn")
        const replysendBtn = document.getElementsByName("reply-send")
        const sent = document.getElementsByName("sent")

        replyBtn.addEventListener('click',function(){
            replyform.parentElement.classList.remove('display')
        })

        replysendBtn.addEventListener('click',function(){
            replyform.classList.add('display')
            sent.classList.remove('display')
        })
    </script>

</body>

</html>