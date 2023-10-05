<?php
require('../../db/coachfunctions.php');
require_once '../../db/dbconn.php';
session_start();


$exid;
$user_id = $_GET['user_id'];

$target_body_part_id = 1; // Change to bodypart_id na gusto mo ipakita
$result = fetch_exercises_by_body_part($conn, $target_body_part_id);


// if (isset($_GET['user_id']) && is_numeric($_GET['user_id'])) {
//     $user_id = (int)$_GET['user_id']; 
//     
// } else {
//   
//     echo "Invalid or missing user_id.";
//  
// }



 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>FitLife</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../css/cards.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css
" rel="stylesheet">
    <!-- <script src="scripts.js"></script> -->
<script>
  
    let globalExerciseId;
    function loadPageWID(url, elementId, userId) {
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById(elementId).innerHTML = "";
            document.getElementById(elementId).innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", url + '?user_id=' + userId, true);
    xmlhttp.send();
}





function addExtoRoutine() {
  
   var routineId = document.getElementById('routine-select').value;
   var sets = document.getElementById('sets-input').value;
   var reps = document.getElementById('reps-input').value;
   var weight = document.getElementById('weight-input').value;
    

    // Create an object with the data to send to the server
    var data = {
        routineId: routineId,
        //exerciseId: globalExerciseId,
        sets: sets,
        reps: reps,
        weight: weight
        
    };
    $.ajax({
        type: 'POST',
        url: '../../db/coachfunctphp', 
        data: data,
     success: function (response) {
        console.log('success');
         Swal.fire({
                 title: "Success",
                 text: "Successfully added to routine",
                 icon: "success",
             });
             $('#addToRoutineModal').modal('hide');
     },
     error: function (xhr, status, error) {
         console.log(xhr.responseText);
         Swal.fire({
             title: "Error",
             text: "An error occurred while processing your request.",
             icon: "error",
         });
     }
 });
}
   






//     $(document).ready(function(){
//     // Listen for the click event on the "Add to Routine" button
//     $(".card-btn").click(function(){
//         // Get the exercise_id and user_id from the clicked button's data attributes
//         var exerciseId = $(this).data("exercise-id");
//         var userId = $(this).data("user-id");

//         // Set the values in the modal's input field
//         $("#exercise-id").val(exerciseId);
//     });
// });

function passExerciseId(button) {
        var exerciseId = $(button).data('exercise-id'); // Retrieve the data-exercise-id attribute value
        $('#exercise-id').val(exerciseId); // Set the value of the exercise-id input field in the modal
    }


 // Add a click event listener to the "Add to Routine" button
document.addEventListener('click', function (e) {
    // Check if the clicked element has the "card-btn" id
    if (e.target && e.target.id === 'card-btn') {
        // Get the value of the data-exercise-id attribute from the clicked button
        const exerciseId = e.target.getAttribute('data-exercise-id');
        // Set the value of the exercise-id input field
        document.getElementById('exercise-id').value = exerciseId;
    }
});
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
function loadInputs(url, elementId, exerciseId) {
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById(elementId).innerHTML = "";
            document.getElementById(elementId).innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", url + '?exerciseId=' + exerciseId, true);
    xmlhttp.send();
}



</script>
</head>

<body>


    <div class="card-container">
        <?php while($row = $result->fetch_assoc()) { ?>
        <div class="card">
            
            <div class="card-body" id="c-body">
                <h5 class="card-title"><?php echo $row['exercise_name']; ?></h5>
                <p class="card-text"><?php echo $row['exercise_description']; ?></p>
                <?php 
                
                echo'<a href="javascript:void();" class="btn btn-primary card-btn" id="card-btn"  
                onclick="loadPage(\'../coachpages/cards/inputfields.php?exercise_id='.$row['exercise_id'].'\', \'c-body\')"> Add to Routine</a>';

              

               ?>
            </div>
        </div>
        <?php } ?>
    </div>


</body>


<div class="modal fade" id="addToRoutineModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="false">
<div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Choose Routine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-to-routine-form">
                
                    <div class="mb-3">
                        <label for="routine-select" class="form-label">Select Routine:</label>
                        <select class="form-select" id="routine-select" name="routine-select">
                            <?php 
                            //pampalitaw lang ng choices to sa select
                               $routines = fetchUserRoutines($user_id, $coach_id, $conn);

                               foreach ($routines as $routine) {
                        
                                   echo "<option value='" . $routine['routine_id'] . "'>" . $routine['routine_name'] . "</option>";
                               }
                            ?>
                        </select>
                    </div>
                    <input type="text" id="exercise-id" value="" name="exercise-id">


                    <div class="mb-3">
                        <label for="sets-input" class="form-label">Sets:</label>
                        <input type="number" class="form-control" id="sets-input" name="sets-input" placeholder="Enter how many sets">
                    </div>
                    <div class="mb-3">
                        <label for="reps-input" class="form-label">Reps:</label>
                        <input type="number" class="form-control" id="reps-input" name="reps-input" placeholder="Enter how many reps for this exercise">
                    </div>
                    <div class="mb-3">
                        <label for="weight-input" class="form-label">Weight:</label>
                        <input type="number" class="form-control" id="weight-input" name="weight-input" placeholder="Enter weight in kg">
                    </div>
                
            </div>
           
            <div class="modal-footer">
            </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                
                <button type="submit" class="btn btn-success" id="add-to-routine-btn" onclick="addExtoRoutine()">Confirm</button>
               
            </div>
        </div>
    </div>
</div>



<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>


</html>