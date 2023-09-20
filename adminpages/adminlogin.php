<?php
require('../db/adminfunctions.php');
include_once '../db/dbconn.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    <link rel="stylesheet" href="../css/login.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css
" rel="stylesheet">

<script src="adminscripts.js"></script>
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
    <div id="register-page">
      <!-- dito mapupunta register page pag cinlick yung sa register here -->
    </div>





<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Sign In</h5>
            <form action="../db/functions.php" method="POST">
              <div class="form-floating mb-3">
              <input type="email" class="form-control" id="adminemail" name="adminEmail" placeholder="Enter Email">
                <label for="adminemail">Email address</label>
              </div>
              <div class="form-floating mb-3">
              <input type="password" class="form-control" id="adminpassword" name="admninPassword1" placeholder="Enter password">
                <label for="userpassword">Password</label>
              </div>
              <div class="d-grid">
              <button type="submit" id="loginbutton" class="btn btn-primary btn-login text-uppercase fw-bold" name="loginadmin">Sign in</button>
              </div>
              <hr class="my-4">
            </form>
            <p class="registerlink" id="registerlnk">Don't have an account? <a href="#" id="register-link">Register here</a></p>
          </div>
        </div>
        <div id="alert-container"></div>
      </div>
    </div>
  </div>
  <script>
      // Function to show SweetAlert2 alert
      function showAlert(title, text, icon) {
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    }

  
    document.getElementById('loginbutton').addEventListener('click', function (event) {
        event.preventDefault();

      
        const email = document.getElementById('usermail').value;
        const password = document.getElementById('userpassword').value;

       
        $.ajax({
            type: 'POST',
            url: '../db/functions.php',
            data: {
                usrEmail: email,
                usrPassword1: password,
                loginusr: true
            },
            dataType: 'json',
            success: function (response) {
    console.log('Response:', response);
    if (response.status === 'success') {
        console.log('Redirecting to dashboard...');
        window.location.href = 'dashboard.php';
    } else {
        showAlert('Login Failed', 'Incorrect email or password.', 'error');
    }
},
            error: function () {
             
                showAlert('Error', 'An error occurred while processing your request.', 'error');
            }
        });
    });
  </script>
</body>


  </body>
</main>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  
</body>

</html>
