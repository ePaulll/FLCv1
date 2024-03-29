<?php
session_start();
require('../db/functions.php');
include_once '../db/dbconn.php';

print_r($_SESSION);

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
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="scripts.js"></script>
</head>


  <header>
    <nav class="navbar fixed-top">
      <div class="container-fluid d-flex justify-content-center">
        <a class="navbar-brand mx-auto" href="dashboard.php">
          <img src="../icons/White logo - no background.png" alt="" width="250" height="50" class="d-inline-block align-text-top">
      </a>
        <button class="navbar-toggler order-first" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
          aria-controls="offcanvasNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
          aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Navigation</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              
             
              
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#" > <i class="bi bi-house-fill"></i>Home</a>
               
              </li>
              <li class="nav-item">
                <a class="nav-link" href="coach_list.php"><i class="bi bi-person-fill"></i>Coaches</a>
              </li>
            
              <li class="nav-item">
                <a class="nav-link" href="routinepage.php"><i class="bi bi-card-checklist"></i>Routines</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="exerciselist.php"><i class="bi bi-list-ol"></i>Exercise List</a>
              </li>
            
              <li class="nav-item">
                <a class="nav-link" href="statisticspage.php"><i class="bi bi-bar-chart-line-fill"></i>Statistics</a>
              </li>
              
        
        
            </ul>
           
          </div>
        </div>
      </div>
      <!-- Logout button -->
      <div class="navbar fixed-bottom">
            <div class="container-fluid d-flex justify-content-center">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><i class="bi bi-box-arrow-right"></i>Logout</a>
                    </li>
                </ul>
              </div>
        </div>
    </nav>
  </header>

  <main>
 
  
<body>
<div class="main-content" id="main-content"></div>
</body>


  </main>
  <footer>
    
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


