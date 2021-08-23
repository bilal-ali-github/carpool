<?php
session_start();
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true || $_SESSION['user_role'] != 'User') {
    header("location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool System - User Interface Main</title>

    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./node_modules/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body class="bg-success">
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
            <a class="navbar-brand ms-sm-5" href="#">
                <h2 class="text-success">Intercity Carpooling</h2>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <div class=" me-5">
                    <a href="./functions/logout.php" class="text-success text-decoration-none me-2">Logout</a>
                </div>
            </div>
    </nav>

    <header class="jumbotron p-5 bg-light text-white mt-5">
        <h4 class="text-success ms-5 mt-2"> User Interface Main </h4>
    </header>

    <div class="pad px-2">
        <main class="container border border-white border-5 rounded-3 mt-5 bg-white px-2">
            <div class="col-lg-8 m-auto">
                <section class="mt-5">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6 col-md-4">
                                    <img src="picture.jpg" class="img-fluid rounded-circle border border-5 border-success" alt="Profile Image">
                                    <!-- ModalBtn -->
                                    <span class="badge bg-success rounded-circle p-1 text-white" role="button" data-bs-toggle="modal" data-bs-target="#exampleModalToggle"><i class="bi bi-pencil-fill"></i></span>
                                    <!-- ModalBtn:End -->
                                </div>
                                <div class="col-6 col-md-8 align-self-center">
                                    <h3>Username</h3>
                                    <p>username@email.com | 03355815387</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 align-self-center">
                            <p class="ms-5 py-5"><span class="badge bg-success p-2"><a href="#" class="bi bi-envelope-open-fill text-white text-decoration-none"> Responses</a></span></p>
                        </div>
                    </div>
                </section>
                <section class="mt-5">
                    <h2 class="">Search,</h2>
                    <form action="" method="post">
                        <div class="mt-4 col-sm m-auto">
                            <div class="row">
                                <div class="p-1 col-sm-4">
                                    <select class="form-select" id="departure_city">
                                        <option selected>Select Departure City</option>
                                        <option value="1">Islamabad</option>
                                        <option value="2">Rawalpind</option>
                                        <option value="3">Lahore</option>
                                    </select>
                                </div>
                                <div class="p-1 col-sm-4">
                                    <select class="form-select" id="arrival_city">
                                        <option selected>Select Arrival City</option>
                                        <option value="1">Islamabad</option>
                                        <option value="2">Rawalpind</option>
                                        <option value="3">Lahore</option>
                                    </select>
                                </div>
                                <div class="p-1 col-sm-4">
                                    <input type="date" class="form-control" name="date" id="date">
                                </div>
                            </div>
                            <div class="text-center ">
                                <button id="submit" type="button " class="btn btn-outline-success btn-md mt-5 " onclick="">Search Event</button>
                            </div>
                        </div>
                    </form>
                </section>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalToggleLabel">Please Sign In to Continue</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <section class="mt-5">
                                    <h5 class="text-center mb-4 text-success">Add / Change Profile Image,</h2>
                                        <form action="" method="post">
                                            <div class="mb-3 col-sm-6 m-auto">
                                                <label for="upload" class="form-label ">Upload Picture</label>
                                                <input type="file" class="form-control" name="profile_img">
                                            </div>
                                            <div class="col-sm-6 m-auto">
                                                <div class="text-center">
                                                    <button name="submit" type="submit" class="btn btn-success btn-md mt-5 ">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                </section>
                            </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
                <!-- Modal:End -->

                <hr>

                <section class="mt-5 mb-5">
                    <h2>On Going Events</h2>
                    <div class="m-auto mt-4 table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <th>
                                    Departure City
                                </th>
                                <th>
                                    Arrival City
                                </th>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Ride Fare
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </thead>
                            <tbody>
                                <td>
                                    Islamabad
                                </td>
                                <td>
                                    Lahore
                                </td>
                                <td>
                                    2020-08-12
                                </td>
                                <td>
                                    500
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-success">More Info</button>
                                </td>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </main>
    </div>


    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>