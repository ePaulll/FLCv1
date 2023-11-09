<?php

if (file_exists('db/database.php')) { include_once('db/database.php'); }
if (file_exists('../db/database.php')) { include_once('../db/database.php'); }


require('../db/coachfunctions.php');
include_once '../db/dbconn.php';


$coachId = $_SESSION['coach_id'];

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

function editroutine(user_id,routine) {
        //var routine = document.getElementById('routine').value;
loadPage('editroutine.php?user_id='+user_id+'&routine_name='+routine,'right-con');
}

    </script>





</head>
<main>

    <body>
    
    <a href="javascript:void(0);" class="btn btn-primary" onclick="loadPage('clientlist.php', 'main-content')"> <i class="bi bi-arrow-left-square"></i> Back</a>
<div class="row col-4">

<ul class="list-group">
    <?php
    if (isset($_GET['user_id'])) {
        $userId = $_GET['user_id'];
    } else {
        echo 'User ID not provided.';
        exit; // Exit if user ID is missing
    }
    
    
    $sql = "SELECT routine_id, routine_name FROM tbl_routines 
            WHERE coach_id = $coachId AND user_id = $userId";
    
    $result = mysqli_query($db_connection, $sql);
    
    if (!$result) {
        die('Query failed: ' . mysqli_error($db_connection));
    }
    
    // 5. Display the routine names.
    echo '<h2>Routines</h2>';
    echo '<ul class="list-group">';
    
    while ($row = mysqli_fetch_assoc($result)) {
        $routineId = $row['routine_id'];
        $routineName = $row['routine_name'];
    
        // Display routine names here
        echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
        echo $routineName;
        
        // Add a button here
        echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="editroutine('. $routineId .',\''.$routineName.'\')">Edit routine</a>';
        
        echo '</li>';
    }
    
    echo '</ul>';
    
    // Close the database connection
    mysqli_close($db_connection);
    ?>

</ul>

    
</div>
<div class="col-6">
<div id="right-con"></div>
</div>
    </body>
 
</main>