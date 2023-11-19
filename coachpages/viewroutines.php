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

// function editroutine(user_id,routine,routine_id) {
//         //var routine = document.getElementById('routine').value;
// loadPage('editroutine.php?user_id='+user_id+'&routine_name=','main-content');
// console.log(routine + routineId);
// }


//gumagana pero pag pinindot yung button walng nag lo load
// function editroutine(user_id, routine, routine_id) {
//     loadPage('editroutine.php?user_id=' + user_id + '&routine_name=' + routine + '&routine_id=' + routine_id, 'right-con');
//     console.log(routine_id); // Just for logging, remove it if not needed
    
//     }

function editroutine(user_id, routine_name, routine_id) {
    loadPage('editroutine.php?user_id=' + user_id + '&routine_name=' + routine_name + '&routine_id=' + routine_id, 'right-con');
    console.log("RID :" + routine_id); // Just for logging, remove it if not needed
    console.log("UID :" + user_id);
    console.log("RN :" + routine_name);
}
    </script>





</head>
<main>

    <body>
    <div class="container">
    <a href="javascript:void(0);" class="btn btn-primary" onclick="loadPage('clientlist.php', 'main-content')"> <i class="bi bi-arrow-left-square"></i> Back</a>
<div class="row">
    <div class="col-4">
<ul class="list-group">
    <?php
    if (isset($_GET['user_id'])) {
        $userId = $_GET['user_id'];
    } else {
        echo 'User ID not provided.';
        exit; // Exit if user ID is missing
    }
    
    // if (isset($_GET['routine_id'])) {
    //     $routineId = $_GET['routine_id'];
    // } else {
    //     echo 'Routine id not provided.';
    //     exit; 
    // }
    


    $sql = "SELECT routine_id, routine_name FROM tbl_routines 
            WHERE coach_id = $coachId AND user_id = $userId";
    
    $result = mysqli_query($db_connection, $sql);
    
    if (!$result) {
        die('Query failed: ' . mysqli_error($db_connection));
    }
    
    
    echo '<h2>Routines</h2>';
    echo '<ul class="list-group">';
    
    while ($row = mysqli_fetch_assoc($result)) {
        $routineId = $row['routine_id'];
        $routineName = $row['routine_name'];
    
  
        echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
        echo $routineName;
        
       
        // echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="editroutine('. $routineId .',\''.$routineName.'\')" >Edit routine</a>';
        echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="editroutine(' . $userId . ', \'' . $routineName . '\', ' . $routineId . ')" >Edit routine</a>';
        echo '</li>';
    }
    
    echo '</ul>';
    
    // Close the database connection
    mysqli_close($db_connection);
    ?>

</ul>


    </div>
<div class="col-8">
        <div id="right-con">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>
</div>
    </body>

</main>