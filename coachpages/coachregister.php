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

    <script src="coachscripts.js"></script>

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
                    <form action="../db/coachfunctions.php" method="POST" class="needs-validation" novalidate>
                        <h2>Register as Coach</h2>

                        <?php
                        // Retrieve and display error messages, if any
                        if (isset($_GET['error'])) {
                            $error = $_GET['error'];

                            if ($error === 'invalidemail') {
                                echo '<div class="alert alert-danger">Invalid email format.</div>';
                            } elseif ($error === 'invalidpassword') {
                                echo '<div class="alert alert-danger">Invalid password. Password must contain at least 8 characters, 1 uppercase letter, and 1 number.</div>';
                            } elseif ($error === 'passwordmismatch') {
                                echo '<div class="alert alert-danger">Passwords do not match.</div>';
                            } elseif ($error === 'databaseerror') {
                                echo '<div class="alert alert-danger">Error: Database error occurred.</div>';
                            }
                        }
                        ?>

                        <div class="form-floating mb-3">
                    
                            <input type="text" class="form-control" id="coachname" name="coachName"
                                placeholder="Enter Coach Name" required value="<?php echo isset($_POST['coachName']) ? $_POST['coachName'] : ''; ?>">
                                <label for="coachname">Coach Name:</label>
                                <div class="invalid-feedback">Please enter a coach name.</div>
                        </div>

                        <div class="form-floating mb-3">
                           
                            <input type="email" class="form-control" id="coachemail" name="coachEmail"
                                placeholder="Enter Coach Email" required value="<?php echo isset($_POST['coachEmail']) ? $_POST['coachEmail'] : ''; ?>">
                                <label for="coachemail">Coach Email:</label>
                                <div class="invalid-feedback">Please enter a valid coach email.</div>
                        </div>

                        <div class="form-floating mb-3">
                           
                            <input type="password" class="form-control" id="coachpassword" name="coachPassword"
                                placeholder="Enter Coach Password" required>
                                <label for="coachpassword">Coach Password:</label>
                            <div class="invalid-feedback">
                                Password must contain at least 8 characters, 1 uppercase letter, and 1 number.
                            </div>
                        </div>
                  
                        <div class="d-flex justify-content-center">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" id="cancelbutton" class="btn btn-danger">Cancel</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success" name="registercoach">Register</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <script>
                        (function() {'use strict'; window.addEventListener('load', function() {

                        var forms = document.getElementsByClassName('needs-validation');

                        var validation = Array.prototype.filter.call(forms, function(form) {
                            form.addEventListener('submit', function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                            }, false);
                        });
                      }, false);
                    })();
                </script>
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