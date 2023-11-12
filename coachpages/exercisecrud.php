<?php

if (file_exists('db/database.php')) { include_once('db/database.php'); }
if (file_exists('../db/database.php')) { include_once('../db/database.php'); }


require('../db/coachfunctions.php');
include_once '../db/dbconn.php';


$query = "SELECT e.exercise_id, e.exercise_name, e.exercise_description, b.body_part_name
          FROM tbl_exercises e
          JOIN tbl_bodyparts b ON e.body_part_id = b.body_part_id";

$result = mysqli_query($conn, $query);

if (!$result) {
    die('Query failed: ' . mysqli_error($conn));
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
function addExerciseToList() {
        // Get values from the form
        var exerciseName = $('#exerciseName').val();
        var exerciseDescription = $('#exerciseDescription').val();
        var bodyPart = $('#bodyPartSelect').val();

        // Validate the inputs
        if (!exerciseName || !exerciseDescription || bodyPart === 'Select Body Part') {
            Swal.fire('Error', 'Please fill in all the fields', 'error');
            return;
        }

        // Prepare the data to be sent
        var data = {
            exerciseName: exerciseName,
            exerciseDescription: exerciseDescription,
            bodyPart: bodyPart
        };

        // Use jQuery AJAX to send data to the server
        $.ajax({
            type: 'POST',
            url: 'addexercise.php',
            data: data,
            dataType: 'json',
            success: function(response) {
                // Handle success
                if (response.success) {
                    Swal.fire('Success', 'Exercise added successfully', 'success');
                } else {
                    Swal.fire('Error', 'Failed to add exercise', 'error');
                }
            },
            error: function(error) {
                // Handle error
                console.error('Error:', error);
                Swal.fire('Error', 'Failed to communicate with the server', 'error');
            }
        });
    }
</script>
  
</head>
<main>

    <body>
    <div class="content-container" id="content-container">
    <div class="container mt-5">
    <h2>Exercise List</h2>
    <a href="javascript:void(0);" class="btn btn-dark" onclick="loadPage('addexercise.php', 'content-container');"> Add exercise </a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Exercise Name</th>
                <th>Description</th>
                <th>Body Part</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['exercise_name'] . '</td>';
                echo '<td>' . $row['exercise_description'] . '</td>';
                echo '<td>' . $row['body_part_name'] . '</td>';
                echo '<td>
                        <a href="#" class="btn btn-primary">Edit</a>
                        <a href="#" class="btn btn-danger">Remove</a>
                      </td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>


<div class="container" id="container">



</div>
</div>







    </body>

</main>