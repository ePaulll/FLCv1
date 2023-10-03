<?php
session_start();
require('../db/coachfunctions.php');
include_once '../db/dbconn.php';



$conn = new mysqli('localhost', 'root', '', 'fitlife_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT u.user_name, u.user_age, u.user_gender
        FROM tbl_users AS u
        JOIN tbl_coach AS c ON u.coach_id = c.coach_id
        WHERE c.coach_id = '$coach_id'";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

$user_name = $row['user_name'];
$user_age = $row['user_age'];
$user_gender = $row['user_gender'];

$conn->close();
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
    <link rel="stylesheet" href="../css/clientlist.css">
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

function add_routine(user_id) {
        var routineName = document.getElementById('routineName').value;

        if (routineName !== '') {
            Swal.fire({
                title: "User",
                text: "Do you want to add this routine?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                dangerMode: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('here');
                    loadPage('addroutine_v2.php?user_id=' + user_id +
                        '&routineName=' + routineName, 'content');
                }
            });
        } else {
            Swal.fire('Error on Routine', 'Please Input Routine', 'error');
        }
    }

// function add_routine(user_id) {
//     var routineName = document.getElementById('routineName').value;

//     if (routineName !== '') {
//         Swal.fire({
//             title: "User",
//             text: "Do you want to add this routine?",
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonText: "Yes",
//             cancelButtonText: "No",
//             dangerMode: true,
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 // Prepare the data to send to the server
//                 var data = {
//                     user_id: user_id,
//                     routineName: routineName
//                 };

//                 // Send a POST request to the server
//                 $.ajax({
//                     type: "POST",
//                     url: "addroutine_v2.php", // Update the URL to your server endpoint
//                     data: data,
//                     success: function (response) {
//                         // Handle the server response here, e.g., display a success message
//                         Swal.fire({
//                             title: "Success",
//                             text: "Routine added successfully",
//                             icon: "success",
//                         });

//                         // You may also reload or refresh the page to reflect the changes
//                         // window.location.reload();
//                     },
//                     error: function () {
//                         Swal.fire({
//                             title: "Error",
//                             text: "An error occurred while adding the routine.",
//                             icon: "error",
//                         });
//                     }
//                 });
//             }
//         });
//     } else {
//         Swal.fire('Error on Routine', 'Please Input Routine', 'error');
//     }
// }

    </script>

</head>
<main>
<body>


<div class="row">
            <div class="col-md-12">
            <div class="container-fluid text-center" id="content-container">
                
            <div class="row">
<?php

 $conn = new mysqli('localhost', 'root', '', 'fitlife_db');
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
 $sql = "SELECT user_id, user_name, user_age, user_gender, user_bodyweight, user_height FROM tbl_users WHERE coach_id = $coach_id";

 
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {
 
     while ($row = $result->fetch_assoc()) {
        
         $user_name = $row["user_name"];
         $user_age = $row["user_age"];
         $user_gender = $row["user_gender"];
         $user_bodyweight = $row["user_bodyweight"];
         $user_height = $row["user_height"];
         $user_id = $row["user_id"];
        
         
         echo '<div class="col-md-3">'; // Create a column for each card
         echo '<div class="card mb-3">';
         echo '<div class="card-body">';

         echo '<h5 class="card-title">Name: ' . $user_name . '</h5>';
         echo '<ul class="list-group list-group-flush">';
         echo '<li class="list-group-item">Age: ' . $user_age . '</li>';
         echo '<li class="list-group-item">Gender: ' . $user_gender . '</li>';
         echo '<li class="list-group-item">Weight(kg): ' . $user_bodyweight . '</li>';
         echo '<li class="list-group-item">Height(cm): ' . $user_height . '</li>';
         echo '</ul>';
        //  echo '<input type="text" class="user-id" value="' . $user_id . '">';
         echo '<a href="javascript:void();" class="btn btn-primary view-routines-btn ms-2" onclick="loadPage(\'viewroutines.php?user_id='.$user_id.'\',\'content-container\');">View routines</a>';
         echo '<a href="javascript:void();" class="btn btn-primary manage-user-btn ms-2" onclick="loadPage(\'addroutine_v2.php?user_id='.$user_id.'\',\'content-container\');">Create Routine</a>';

        
         echo '</div>';
         echo '</div>';
         echo '</div>';
         
         
        
     }
 } else {
     echo "No Clients found for this coach.";
 }


 $conn->close();




?>
</div>
</div> 



</div>
<!-- div sa taas nito dinagdag q -->



</div>

</body>
</main>

    <script>
//         document.querySelectorAll('.manage-user-btn').forEach(function(button) {
//     button.addEventListener('click', function() {
//         // Get the user ID from the input field in the same card
//         var userId = this.parentElement.querySelector('.user-id').value;

//         // Use userId in your JavaScript logic
//         console.log('User ID: ' + userId);
//     });
// });


// document.querySelectorAll('.manage-user-btn').forEach(function(button) {
//     button.addEventListener('click', function() {
//         var userId = this.parentElement.querySelector('.user-id').value;
        
//         // Load the page into the right-container-content div
//         $('#right-container-content').load('addroutine.php?user_id=' + userId);
//     });
// });



    </script>


<footer>

</footer>




</html>



