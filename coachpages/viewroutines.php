<?php

if (file_exists('db/database.php')) { include_once('db/database.php'); }
if (file_exists('../db/database.php')) { include_once('../db/database.php'); }


require('../db/coachfunctions.php');
include_once '../db/dbconn.php';









?>

<!doctype html>
<html lang="en">

<head>
    <title>FitLife</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
 

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>


    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/routinepage.css">
    <script src="coachscripts.js"></script>

    <script>






    </script>





</head>
<main>

    <body>
    
   
        <h2>Routine Names</h2>
        <ul class="list-group">
            
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Routine 1
                <span class="badge bg-primary rounded-pill">3 exercises</span>
            </li>
       
        </ul>

        <!-- Display Exercises for a Selected Routine -->
        <div class="mt-4">
            <h2>Exercises for Selected Routine</h2>
            <ul class="list-group">
                <!-- Replace these items with your PHP code to dynamically generate exercises -->
                <li class="list-group-item">Exercise 1</li>
            </ul>
        </div>
  


    </body>
</main>