<?php
require('../db/coachfunctions.php');
include_once '../db/dbconn.php';
// ini_set('display_errors', 0);

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

<script src="coachscripts.js"></script>
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
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <!-- Login column -->
          <form action="../db/coachfunctions.php" method="POST">
            <h2>Login as Coach</h2>
            <div class="form-group text-center">
              <input type="text" class="form-control" id="coachEmail" name="coachEmail" placeholder="Enter Email">
            </div>
            <div class="form-group text-center">
              <input type="password" class="form-control" id="coachPassword" name="coachPassword1" placeholder="Enter password">
            </div>
            <div class="d-flex justify-content-end">
              <button type="submit" id="loginbutton" class="btn btn-success" name="logincoach">Login</button>
            </div> 
            <p class="registerlink" id="registerlnk">Don't have an account? <a href="#" id="register-link">Register here</a></p>
          </form>
        </div>
      </div>  
    </div>
  </body>
</main>
  <footer>
      <!-- <p>About us</p>
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