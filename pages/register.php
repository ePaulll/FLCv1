<?php
require('../db/functions.php');
include_once '../db/dbconn.php';

?>
<!doctype html>
<html lang="en">

<head>
    <title>FitLife</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/register.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <script src="scripts.js"></script>

</head>

<body>
    <header>
        <!-- place navbar here -->
        <nav class="navbar">
            <div class="container-fluid d-flex justify-content-center">
                <a class="navbar-brand" href="#">
                    <img src="../icons/White logo - no background.png" alt="" width="250" height="50"
                        class="d-inline-block align-text-top">
                </a>

            </div>
        </nav>
    </header>
    <main>

        <body>
            <div id="login-page">


                <div class="container mx-auto">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <!-- Right column -->
                            <form action="../db/functions.php" method="POST">
                                <h2>Register</h2>
                                <div class="form-group">
                                    <label for="Email">Email:</label>
                                    <input type="text" class="form-control" id="emailaddress" name="usrEmail"
                                        placeholder="Enter Email" required>
                                </div>
                                <div class="form-group">
                                    <label for="Username">Username:</label>
                                    <input type="text" class="form-control" id="username" name="usrName"
                                        placeholder="Enter Username" required>
                                </div>

                                <div class="form-group">
                                    <label for="username">Password:</label>
                                    <input type="password" class="form-control" id="password1" name="usrPassword1"
                                        placeholder="Enter Password" required>
                                </div>

                                <div class="form-group">
                                    <label for="username">Confirm Password:</label>
                                    <input type="password" class="form-control" id="password2" name="usrPassword2"
                                        placeholder="Re-type Password" required>
                                </div>

                                <div class="form-group">
                                    <label for="bodyweight">Body Weight (in kg):</label>
                                    <input type="number" class="form-control" id="bodyweight" name="usrBodyweight"
                                        placeholder="Enter Body Weight" required>
                                </div>

                                <div class="form-group">
                                    <label for="height">Height (in cm):</label>
                                    <input type="number" class="form-control" id="height" name="usrHeight"
                                        placeholder="Enter Height" required>
                                </div>


                                <div class="form-group">
                                    <label for="age">Age:</label>
                                    <input type="number" class="form-control" id="age" name="usrAge"
                                        placeholder="Enter Age" required>
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="usrGender" id="male"
                                            value="male" checked>
                                        <label class="form-check-label" for="male"> Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="usrGender" id="female"
                                            value="female">
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" id="cancelbutton"
                                                class="btn btn-danger">Cancel</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-success"
                                                name="registerusr">Register</button>
                                        </div>
                                    </div>
                                </div>


                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
            </div>
        </body>
        </div>
    </main>
    <footer>
        <!-- <p>placeholder</p>
    <p>placeholder</p>  
    <P>placeholder</P> -->
    </footer>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>


</html>