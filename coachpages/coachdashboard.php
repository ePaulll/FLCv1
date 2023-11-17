<?php
require('../db/coachfunctions.php');
include_once '../db/dbconn.php';


session_start();

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css
" rel="stylesheet">
<script src="coachscripts.js"></script>
<script>

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
       url: '../db/coachfunctions.php', 
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
  




function setExerciseId(exerciseId) {
    
}

function object(id) { return document.getElementById(id); }

function savechange(routine_id,exercise_id){
        var ex_sets = object('ex_sets'+exercise_id).value
        var ex_reps = object('ex_reps'+exercise_id).value;

  if (ex_sets != 0) {
            Swal.fire({
                title: "User",
                text: "Do you want to save changes?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                dangerMode: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('success');
                    loadPage('editroutine.php?routine_id='+routine_id+
                        '&ex_sets='+ex_sets+'&ex_reps='+ex_reps
                        +'&xxx='+exercise_id,'right-con');
                }
            });
        } else {
            Swal.fire('Error on Routine', 'Please Input Routine', 'error');
        }

}
function editroutine(user_id,routine) {
        //var routine = document.getElementById('routine').value;
loadPage('editroutine.php?user_id='+user_id+'&routine_name='+routine,'right-con');
                
           
     }


     function addExerciseToList() {
 
 var exerciseName = $('#exerciseName').val();
 var exerciseDescription = $('#exerciseDescription').val();
 var bodyPart = $('#bodyPartSelect').val();

 
 if (!exerciseName || !exerciseDescription || bodyPart === 'Select Body Part') {
     Swal.fire('Error', 'Please fill in all the fields', 'error');
     return;
 }


 var data = {
     exerciseName: exerciseName,
     exerciseDescription: exerciseDescription,
     bodyPart: bodyPart
 };


 $.ajax({
     type: 'POST',
     url: '../db/coachfunctions.php',
     data: data,
     dataType: 'json',
     success: function(response) {
             if (response && response.success) {
                 Swal.fire({
                     icon: 'success',
                     title: 'Exercise added to list successfully',
                     showConfirmButton: true,
                     timer: 2000
                 }).then(function() {
                    loadPage('exercisecrud.php', 'content-container');
                 });
         } else {
             Swal.fire('Error', 'Failed to add exercise', 'error');
            
         }
     },
     error: function(jqXHR, textStatus, errorThrown) {
         console.error('HTTP status:', jqXHR.status);
         console.error('textStatus:', textStatus);
         console.error('errorThrown:', errorThrown);
         console.error('Response:', jqXHR.responseText);
         Swal.fire('Error', 'Failed to communicate with the server', 'error');
     }
 });
}



function saveExEdit() {

var exerciseId = parseInt($('#exercise_id').val());
var exerciseName = $('#exerciseName').val();
var exerciseDescription = $('#exerciseDescription').val();

if (exerciseName.trim() === '' || exerciseDescription.trim() === '') {
    alert('Please fill in all fields.');
    return; // Prevent further execution of the function
}

console.log('Exercise ID:', exerciseId);
console.log('Exercise Name:', exerciseName);
console.log('Exercise Description:', exerciseDescription);

$.ajax({
    type: 'POST',
    url: '../db/coachfunctions.php',
    data: {
        exercise_id: exerciseId,
        exerciseName: exerciseName,
        exerciseDescription: exerciseDescription
    },
    success: function(response) {
        console.log(response);
        if (response.success) {
            Swal.fire({
                icon: 'success',
                title: 'Exercise details updated successfully',
                showConfirmButton: true,
                timer: 2000
            }).then(function() {
               loadPage('exercisecrud.php', 'content-container');
            });
        } else {
            Swal.fire('Error', 'Failed to update exercise details', 'error');
        }
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.error('HTTP status:', jqXHR.status);
        console.error('textStatus:', textStatus);
        console.error('errorThrown:', errorThrown);
        console.error('Response:', jqXHR.responseText);
        Swal.fire('Error', 'Failed to communicate with the server', 'error');
    }
});
}



// function UnarchiveExercise(exerciseId, action) {
//     $.ajax({
//         type: 'POST',
//         url: '../db/coachfunctions.php',
//         data: {
//             exercise_id: exerciseId,
//             archive_action: action
//         },
//         dataType: 'json',
//         success: function(response) {
//             console.log(response);
//             console.log(exerciseId + action);
//             if (response.success) {
//                 Swal.fire({
//                     icon: 'success',
//                     title: 'Exercise unarchived successfully',
//                     showConfirmButton: true,
//                     timer: 5000
//                 }).then(function() {
//                     loadPage('exercisecrud.php', 'content-container');
//                 });
//             } else {
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Failed to unarchive exercise',
//                     text: 'Please try again'
//                 });
//             }
//         },
//         error: function(jqXHR, textStatus, errorThrown) {
//             console.error('HTTP status:', jqXHR.status);
//             console.error('textStatus:', textStatus);
//             console.error('errorThrown:', errorThrown);
//             console.error('Response:', jqXHR.responseText);
//             Swal.fire({
//                 icon: 'error',
//                 title: 'Failed to communicate with the server',
//                 text: 'Please try again'
//             });
//         }
//     });
// }


function UnarchiveExercise(exerciseId) {

$.ajax({
    type: 'POST',
    url: '../db/unarchive.php',
    data: {
        exercise_id: exerciseId
    },
    dataType: 'json',
    success: function(response) {
        if (response.success) {
            Swal.fire({
                icon: 'success',
                title: 'Exercise unarchived successfully',
                showConfirmButton: true,
                timer: 1500
            }).then(function() {
               loadPage('exercisecrud.php', 'content-container');
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Failed to archive exercise',
                text: 'Please try again'
            });
        }
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.error('HTTP status:', jqXHR.status);
        console.error('textStatus:', textStatus);
        console.error('errorThrown:', errorThrown);
        console.error('Response:', jqXHR.responseText);
        Swal.fire({
            icon: 'error',
            title: 'Failed to communicate with the server',
            text: 'Please try again'
        });
    }
});
}

</script>
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
                <a class="nav-link" href=""><i class="bi bi-person-fill"></i></a>
              </li>
            
              <li class="nav-item">
                <a class="nav-link" href="clientlist.php" ><i class="bi bi-card-checklist"></i>Client List</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="exercisecrud.php"><i class="bi bi-list-ol"></i>Exercise List</a>
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



<!-- 
table.blueTable {
  border: 2px solid #1C6EA4;
  background-color: #EEEEEE;
  width: 100%;
  text-align: left;
  border-collapse: collapse;
}
table.blueTable td, table.blueTable th {
  border: 2px solid #AAAAAA;
  padding: 3px 2px;
}
table.blueTable tbody td {
  font-size: 13px;
}
table.blueTable tr:nth-child(even) {
  background: #D0E4F5;
}
table.blueTable thead {
  background: #1C6EA4;
  background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  border-bottom: 2px solid #444444;
}
table.blueTable thead th {
  font-size: 15px;
  font-weight: bold;
  color: #FFFFFF;
  text-align: center;
}
table.blueTable tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #FFFFFF;
  background: #D0E4F5;
  background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  border-top: 1px solid #444444;
}
table.blueTable tfoot td {
  font-size: 14px;
} --> 