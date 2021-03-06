<?php  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool System</title>
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles/styles.css">

</head>

<body class="bg-success">
    <nav class="navbar  navbar-expand-lg navbar-light bg-white">
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
                <!-- ModalBtn -->
                <div class=" me-5">
                    <a href="" class="text-success text-decoration-none me-2" data-bs-toggle="modal" data-bs-target="#exampleModalToggle2">Sign Up</a>
                    <a href="" class="text-success text-decoration-none" data-bs-toggle="modal" data-bs-target="#exampleModalToggle">Sign In</a>
                </div>
                <!-- ModalBtn:End -->
                <!-- Modal -->
                <div class="modal fade" id="exampleModalToggle" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-black" id="exampleModalToggleLabel">Please Sign In to Continue</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <section class="mt-5">
                                    <h2 class="ms-3 mb-4 text-success">Sign In,</h2>
                                    <form action="./functions/sign-in.php" method="post" class="text-black">
                                        <div class="mb-3 col-sm-6 m-auto">
                                            <label for="email" class="form-label ">Email</label>
                                            <input type="email" class="form-control" placeholder="Enter Email" name="email">
                                        </div>
                                        <div class="mb-3 col-sm-6 m-auto">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" class="form-control" placeholder="Enter Password" aria-label="Password" name="password">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 m-auto">
                                                <div class="text-center ">
                                                    <button name="sign-in" type="submit" class="btn btn-success btn-md mt-5 ">Sign
                                                        In
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="mt-5">
                                        <a href="" class="text-success" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">
                                            <p>Don't have an account ? <br> Sign Up Here Easily !</p>
                                        </a>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModalToggle2" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-black" id="exampleModalToggleLabel2">Please Sign Up to Continue</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <section class="mt-5">
                                    <h2 class="text-success">Sign Up,</h2>
                                    <form action="./functions/sign-up.php" method="post" class="text-black">
                                        <div class="mb-3 col-sm-10 m-auto mt-5">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="name" class="form-label ">Name</label>
                                                    <input type="text" class="form-control" placeholder="Enter Name" aria-label="Name" name="name">
                                                </div>
                                                <div class="col">
                                                    <label for="phone_no" class="form-label">Contact No.</label>
                                                    <input type="text" class="form-control" placeholder="Enter Contact Number" name="phone_no">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-sm-10 m-auto">
                                            <label for="email" class="form-label ">Email</label>
                                            <input type="email" class="form-control" placeholder="Enter Email" name="email">
                                        </div>
                                        <div class="mb-3 col-sm-10 m-auto">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="password" class="form-control" placeholder="Enter Password" aria-label="Password" name="password">
                                                </div>
                                                <div class="col">
                                                    <input type="password" class="form-control" placeholder="Confirm Password" aria-label="Password" name="confirm_password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-5 col-sm-10 m-auto">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="role" id="flexRadioDefault1" value="User" checked>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Sign up as <b> User</b>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="role" id="flexRadioDefault2" value="Driver">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    Sign up as <b> Driver</b>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 m-auto">
                                            <div class="text-center ">
                                                <button type="submit" class="btn btn-success btn-md mt-5" name="sign-up">Sign
                                                    Up</button>
                                            </div>
                                        </div>
                                    </form>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal:End -->
            </div>
        </div>
    </nav>
    <header class="bg-success" style="height: 70vh;">
        <center style="padding-top: 35vh;">
            <h1 class="text-white display-1">Carpooling</h1>
        </center>
    </header>
    <div class="bg-white w-100">
        <div class="container">
            <div class="row" style="min-height: 10rem;">
                <div class="col-sm p-5 bg-white">
                    <h3 class="text-success"><i class="bi bi-arrow-right-square-fill"></i> Carpooling Listing</h3>
                    <ul class="text-success  mt-5">
                        <li>See all Listing Events</li>
                        <li>All Listing with Full Information</li>
                    </ul>
                </div>
                <div class="col-sm p-5 bg-white">
                    <h3 class="text-success"><i class="bi bi-arrow-right-square-fill"></i> Carpooling Listing</h3>
                    <ul class="text-success  mt-5">
                        <li>See all Listing Events</li>
                        <li>All Listing with Full Information</li>
                    </ul>
                </div>
                <div class="col-sm p-5 bg-white">
                    <h3 class="text-success"><i class="bi bi-arrow-right-square-fill"></i> Carpooling Listing</h3>
                    <ul class="text-success  mt-5">
                        <li>See all Listing Events</li>
                        <li>All Listing with Full Information</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="pad px-2">
        <main class="container border border-white border-5 rounded-3 mt-5 bg-white px-2">
            <section class="mt-5">
                <form action="" method="post">
                    <div class="mt-4 col-sm-8 m-auto">
                        <h2 class="mb-5">Search,</h2>
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
            <hr>
            <section class="mt-5 mb-5">
                <div class="col-sm-8 m-auto mt-4 table-responsive">
                    <h2 class=" mb-5">On Going Events</h2>
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
                                <!-- ModalBtn -->
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalToggle">More Info</button>
                                <!-- ModalBtn:End -->
                            </td>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>