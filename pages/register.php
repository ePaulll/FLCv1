<?php
require('../db/functions.php');
include_once '../db/dbconn.php';

session_start();
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
                    <img src="" alt="" width="30" height="30" class="d-inline-block align-text-top">
                    FitLife
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
                    <form action="../db/functions.php" method="POST" class="needs-validation" novalidate>
                        <h2>Register</h2>

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

                        <div class="form-group">
                            <label for="emailaddress">Email:</label>
                            <input type="email" class="form-control" id="emailaddress" name="usrEmail"
                                placeholder="Enter Email" required value="<?php echo isset($_POST['usrEmail']) ? $_POST['usrEmail'] : ''; ?>">
                            <div class="invalid-feedback">Please enter a valid email address.</div>
                        </div>

                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="usrName"
                                placeholder="Enter Username" required value="<?php echo isset($_POST['usrName']) ? $_POST['usrName'] : ''; ?>">
                            <div class="invalid-feedback">Please enter a username.</div>
                        </div>

                        <div class="form-group">
                            <label for="password1">Password:</label>
                            <input type="password" class="form-control" id="password1" name="usrPassword1"
                                placeholder="Enter Password" required value="<?php echo isset($_POST['usrPassword1']) ? $_POST['usrPassword1'] : ''; ?>">
                            <div class="invalid-feedback">
                                Password must contain at least 8 characters, 1 uppercase letter, and 1 number.
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password2">Confirm Password:</label>
                            <input type="password" class="form-control" id="password2" name="usrPassword2"
                                placeholder="Re-type Password" required value="<?php echo isset($_POST['usrPassword2']) ? $_POST['usrPassword2'] : ''; ?>">
                            <div class="invalid-feedback">Passwords do not match.</div>
                        </div>

                        <div class="form-group">
                            <label for="bodyweight">Body Weight (in kg):</label>
                            <input type="number" class="form-control" id="bodyweight" name="usrBodyweight"
                                placeholder="Enter Body Weight" required value="<?php echo isset($_POST['usrBodyweight']) ? $_POST['usrBodyweight'] : ''; ?>">
                            <div class="invalid-feedback">Please enter a valid body weight.</div>
                        </div>

                        <div class="form-group">
                            <label for="height">Height (in cm):</label>
                            <input type="number" class="form-control" id="height" name="usrHeight"
                                placeholder="Enter Height" required value="<?php echo isset($_POST['usrHeight']) ? $_POST['usrHeight'] : ''; ?>">
                            <div class="invalid-feedback">Please enter a valid height.</div>
                        </div>

                        <div class="form-group">
                            <label for="age">Age:</label>
                            <input type="number" class="form-control" id="age" name="usrAge" placeholder="Enter Age"
                                required value="<?php echo isset($_POST['usrAge']) ? $_POST['usrAge'] : ''; ?>">
                            <div class="invalid-feedback">Please enter a valid age.</div>
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="usrGender" id="male" value="male"
                                    <?php echo (isset($_POST['usrGender']) && $_POST['usrGender'] === 'male') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="male"> Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="usrGender" id="female" value="female"
                                    <?php echo (isset($_POST['usrGender']) && $_POST['usrGender'] === 'female') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>
                            <!-- lagyan niyo nalang ng checkbox dito parang ganto -->
                            <div class="form-group">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
								<label class="form-check-label" for="invalidCheck">	Agree to terms and conditions </label>
								<div class="invalid-feedback"> You must agree before submitting. </div>
							</div>
                        <div class="d-flex justify-content-center">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" id="cancelbutton" class="btn btn-danger">Cancel</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success" name="registerusr">Register</button>
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