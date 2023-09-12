<?php
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
    <script src="coachscripts.js"></script>
    
  
</head>
<main>
<body>


<div class="row">
            <div class="col-md-6">
            <div class="container text-center">
<?php

 $conn = new mysqli('localhost', 'root', '', 'fitlife_db');
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
 $sql = "SELECT user_name, user_age, user_gender, user_bodyweight, user_height FROM tbl_users WHERE coach_id = $coach_id";

 
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {
 
     while ($row = $result->fetch_assoc()) {
         $user_name = $row["user_name"];
         $user_age = $row["user_age"];
         $user_gender = $row["user_gender"];
         $user_bodyweight = $row["user_bodyweight"];
         $user_height = $row["user_height"];
         
        
         
         echo '<div class="card" style="width: 18rem;">';
         echo '<div class="card-body">';
         echo '<h5 class="card-title">Name: ' . $user_name . '</h5>';
         echo '<ul class="list-group list-group-flush">';
         echo '<li class="list-group-item">Age: ' . $user_age . '</li>';
         echo '<li class="list-group-item">Gender: ' . $user_gender . '</li>';
         echo '<li class="list-group-item">Weight(kg): ' . $user_bodyweight . '</li>';
         echo '<li class="list-group-item">Height(cm): ' . $user_height . '</li>';
         echo '</ul>';
         echo '<a href="#" class="btn btn-primary view-routines-btn ms-2">View routines</a>';
         echo '<a href="#" class="btn btn-primary create-routine-btn ms-2 mt-2" id="create-routine-button">Create routine</a>';
        //  echo '<a href="#" class="btn btn-primary create-routine-btn ms-2 mt-2">Create routine</a>';
         echo '</div>';
         echo '</div>';
         
        
     }
 } else {
     echo "No users found for this coach.";
 }


 $conn->close();




?>
</div>
</div> 
<!-- div sa taas nito dinagdag q -->

<div class="col-md-6">
            
                <div class="container text-center">
                    <!-- <h2 class="h2r">Other Content</h2> -->
                    <div id="right-container-content">
                   <!-- Content will be loaded here -->
                   </div>
                </div>
            </div>

</div>
</body>
</main>

<script>
        $(document).ready(function () {
            // When the button is clicked
            $('#viewRoutinesBtn').click(function () {
                $.ajax({
                    url: '../db/coachfunctions.php', // Replace with the actual path to your PHP script
                    method: 'POST',
                    data: { userId: 123 }, // Replace with the user's ID you want to fetch routines for
                    dataType: 'json',
                    success: function (response) {
                        // Clear the routineContainer
                        $('#routineContainer').empty();

                        // Append the routines to the container
                        if (response.length > 0) {
                            $('#routineContainer').append('<h3>User\'s Routines:</h3>');
                            $.each(response, function (index, routineName) {
                                $('#routineContainer').append('<p>' + routineName + '</p>');
                            });
                        } else {
                            $('#routineContainer').append('<p>No routines found for this user.</p>');
                        }
                    },
                    error: function () {
                        alert('Failed to fetch routines. Please try again later.');
                    }
                });
            });
        });
    </script>


<footer>

</footer>




</html>