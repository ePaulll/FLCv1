<?php
require('../db/adminfunctions.php');
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

<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css
" rel="stylesheet">

    <script src="scripts.js"></script>

</head>

<body>
    <header>
        <!-- place navbar here -->
        <nav class="navbar">
            <div class="container-fluid d-flex justify-content-center">
                <a class="navbar-brand" href="#">
                <img src="../icons/White logo - no background.png" alt="" width="250" height="50" class="d-inline-block align-text-top">
                </a>

            </div>
        </nav>
    </header>
    <main>

        <body>
    <div id="login-page">
         <div class="container">
            <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
            <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Register</h5>
                    <form action="../db/adminfunctions.php" method="POST" class="needs-validation" novalidate>
                       

                    <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="adminname" name="adminName"
                                placeholder="Enter Admin Name" required value="<?php echo isset($_POST['adminName']) ? $_POST['adminName'] : ''; ?>">
                            <label for="adminname">Admin Name:</label>
                            <div class="invalid-feedback">Please enter an admin name.</div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="adminemail" name="adminEmail"
                                placeholder="Enter Email" required value="<?php echo isset($_POST['adminEmail']) ? $_POST['adminEmail'] : ''; ?>">
                            <label for="adminemail">Email:</label>
                            <div class="invalid-feedback">Please enter a valid email address.</div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="adminpassword" name="adminPassword"
                                placeholder="Enter Password" required value="<?php echo isset($_POST['adminPassword']) ? $_POST['adminPassword'] : ''; ?>">
                            <label for="adminpassword">Password:</label>
                            <div class="invalid-feedback">
                                Password must contain at least 8 characters, 1 uppercase letter, and 1 number.
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success" name="registeradmin">Register</button>
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


    <!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->


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