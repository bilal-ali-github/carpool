<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool System - User Interface Responses</title>

    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./styles/styles.css">
    <style>
        .display{
            display: none;
        }
    </style>
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
                    <a href="" class="text-success text-decoration-none me-2">Logout</a>
                </div>
            </div>
    </nav>

    <header class="jumbotron p-5 bg-light text-white mt-5">
        <h4 class="text-success ms-5 mt-2"> User Interface Responses </h4>
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
                    <h2>Responses</h2>
                    <div class="row mt-5">
                        <div class="col-12">
                            <h5>From : Driver Name</h5>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit velit dolorum odio, eius ullam facilis optio, iure delectus tenetur soluta provident rem incidunt, sit vitae quae? Sunt, placeat beatae dignissimos modi officiis
                                et eaque architecto, officia libero aperiam adipisci enim.</p>
                            <div class="row">
                                <div class="col-6 text-black-50">
                                    <p>Date: | Time: </p>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    <button id="reply-btn" class="btn btn-sm btn-outline-success">Reply</button>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <form  method="post" class="form-floating display" id="reply-form">
                                <textarea id="reply" name="reply" class="form-control"></textarea>
                                <label for="reply" class="form-label">Reply</label>
                                <div class="mt-3 m-auto">
                                    <button type="submit" class="btn btn-sm btn-success" id="reply-send">Send</button>
                                </div>
                            </form>
                            <p class="text-success display" id="sent"><i class="bi bi-check"></i> Sent !</p>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>


    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        const replyform = document.getElementById('reply-form')
        const replyBtn = document.getElementById('reply-btn')
        const replysendBtn = document.getElementById('reply-send')
        const sent = document.getElementById('sent')

        replyBtn.addEventListener('click',function(){
            replyform.classList.remove('display')
        })

        replysendBtn.addEventListener('click',function(){
            replyform.classList.add('display')
            sent.classList.remove('display')
        })
    </script>
</body>

</html>