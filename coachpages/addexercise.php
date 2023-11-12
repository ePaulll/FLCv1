<?php

if (file_exists('db/database.php')) { include_once('db/database.php'); }
if (file_exists('../db/database.php')) { include_once('../db/database.php'); }


require('../db/coachfunctions.php');
include_once '../db/dbconn.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exerciseName'], $_POST['exerciseDescription'], $_POST['bodyPart'])) {
    $exerciseName = $_POST['exerciseName'];
    $exerciseDescription = $_POST['exerciseDescription'];
    $bodyPart = $_POST['bodyPart'];

    if ($conn->connect_error) {
        $response = array('success' => false, 'error' => 'Database connection error');
        echo json_encode($response);
        exit;
    }

    // Perform any necessary validation and sanitation of input data here

    $insert_query = "INSERT INTO tbl_exercises (exercise_name, exercise_description, body_part_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_query);

    if ($stmt) {
        $stmt->bind_param("ssi", $exerciseName, $exerciseDescription, $bodyPart);

        if ($stmt->execute()) {
            $response = array('success' => true);
        } else {
            $response = array('success' => false, 'error' => 'Database insert error');
        }

        $stmt->close();
    } else {
        $response = array('success' => false, 'error' => 'Database statement error');
    }

    $conn->close();

    // Send a JSON response
    echo json_encode($response);
    exit;
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
    <div class="container col-6">
    <a href="javascript:void(0);" class="btn btn-primary" onclick="loadPage('exercisecrud.php', 'content-container')"> 
    <i class="bi bi-arrow-left-square"></i> Back</a>


    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="exerciseName" placeholder="">
        <label for="exerciseName">Exercise Name</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="exerciseDescription" placeholder="">
        <label for="exerciseDescription">Exercise Description</label>
    </div>

    <select class="form-select" id="bodyPartSelect" aria-label="Default select example">
        <option selected>Select Body Part</option>
        <option value="1">Legs</option>
        <option value="2">Core</option>
        <option value="3">Arms</option>
        <option value="4">Shoulders</option>
        <option value="5">Chest</option>
        <option value="6">Back</option>
    </select>

    <button type="submit" class="btn btn-success" onclick="addExerciseToList()">Add</button>



    </body>

</main>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>