<?php $interface = 'Admin';
require_once "./partials/header.php"; ?>

<header class="jumbotron p-5 bg-light text-white mt-5">
    <h4 class="text-success ms-5 mt-2">Driver Interface Profile</h4>
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
                            </div>
                            <div class="col-6 col-md-8 align-self-center">
                                <h3>Username</h3>
                                <p>username@email.com | 03355815387</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 align-self-center">
                    </div>
                </div>
            </section>
            <section class="mt-5 mb-5">
                <div class="row">
                    <h3>Driver Details</h2>
                        <div class="col-sm-6 mt-5 align-self-center">
                            <h5>Car Type : Business Class</h5>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <p>Car Name : <b>Honda City</b></p>
                                </div>
                                <div class="col-6">
                                    <p>Reg Number : <b>PS-763</b></p>
                                </div>
                                <div class="col-6">
                                    <p>Car Color : <b>White</b></p>
                                </div>
                                <div class="col-6">
                                    <p>Seats Available : <b>04</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="">
                                <img src="car.jpg" class="img-fluid img-thumbnail" alt="Driver Car">
                            </div>
                        </div>
                </div>

            </section>
        </div>
    </main>
</div>


<script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>