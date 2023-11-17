<?php

if (file_exists('db/database.php')) { include_once('db/database.php'); }
if (file_exists('../db/database.php')) { include_once('../db/database.php'); }

header('Content-Type: application/json');
require('../db/coachfunctions.php');
include_once '../db/dbconn.php';

$exercise_id = $_GET['exercise_id'];
if (isset($_GET['exercise_id'])) {
    $exercise_id = $_GET['exercise_id'];
    echo $exercise_id;
 } else {
    echo 'Exercise ID: undefined';
 }



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
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css
" rel="stylesheet">
    <script src="coachscripts.js"></script>
    
<script> 

function loadPage(url,elementId) {
    if (window.XMLHttpRequest) {
            xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }   
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById(elementId).innerHTML="";
            document.getElementById(elementId).innerHTML=xmlhttp.responseText;	
        }
    }  
    xmlhttp.open("GET",url,true);
    xmlhttp.send();	   
}


</script>
  
</head>
<main>

    <body>
    <div class="content-container" id="content-container">
    <div class="container mt-5">
    <h2>Edit Exercise Details</h2>
    <a href="javascript:void(0);" class="btn btn-primary" onclick="loadPage('exercisecrud.php', 'content-container')"> 
    <i class="bi bi-arrow-left-square"></i> Back</a>
    
    <?php
    if (isset($_GET['exercise_id'])) {
        $exercise_id = $_GET['exercise_id'];

        // Assuming $conn is your database connection
        $query = "SELECT e.exercise_id, e.exercise_name, e.exercise_description, b.body_part_name
                  FROM tbl_exercises e
                  JOIN tbl_bodyparts b ON e.body_part_id = b.body_part_id
                  WHERE e.exercise_id = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $exercise_id);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $exercise = $result->fetch_assoc();
            ?>
            <input type="hidden" id="exercise_id" name="exercise_id" value="<?php echo $exercise['exercise_id']; ?>">
            <div class="mb-3">
                <label for="exerciseName" class="form-label">Exercise Name</label>
                <input type="text" class="form-control" id="exerciseName" name="exerciseName" value="<?php echo $exercise['exercise_name']; ?>">
            </div>
            <div class="mb-3">
                <label for="exerciseDescription" class="form-label">Exercise Description</label>
                <textarea class="form-control" id="exerciseDescription" name="exerciseDescription"><?php echo $exercise['exercise_description']; ?></textarea>
            </div>
            <div class="mb-3">
                <button type="button" class="btn btn-secondary" onclick="loadPage('exercisecrud.php', 'content-container')">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveExEdit()">Save</button>
            </div>
            <?php
        } else {
            echo '<p>No exercise found for the provided ID.</p>';
        }

        $stmt->close();
        $conn->close();
    } else {
        echo '<p>No exercise ID provided.</p>';
    }
    ?>
</div>






</div>
</div>







    </body>

</main>

