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

<div class="container">

<?php
 $conn = new mysqli('localhost', 'root', '', 'fitlife_db');
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
 $sql = "SELECT user_name, user_age, user_gender, user_bodyweight, user_height FROM tbl_users WHERE coach_id = $coach_id";

 // Execute the query
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {
     // Output data of each row
     while ($row = $result->fetch_assoc()) {
         $user_name = $row["user_name"];
         $user_age = $row["user_age"];
         $user_gender = $row["user_gender"];
         $user_bodyweight = $row["user_bodyweight"];
         $user_height = $row["user_height"];
         
         // Output the user data
         
         echo '<div class="card" style="width: 18rem;">';
         echo '<div class="card-body">';
         echo '<h5 class="card-title">Name: ' . $user_name . '</h5>';
         echo '<ul class="list-group list-group-flush">';
         echo '<li class="list-group-item">Age: ' . $user_age . '</li>';
         echo '<li class="list-group-item">Gender: ' . $user_gender . '</li>';
         echo '<li class="list-group-item">Weight(kg): ' . $user_bodyweight . '</li>';
         echo '<li class="list-group-item">Height(cm): ' . $user_height . '</li>';
         echo '</ul>';
         echo '<a href="#" class="btn btn-primary">View routines</a>';
         echo '</div>';
         echo '</div>';
        
     }
 } else {
     echo "No users found for this coach.";
 }

 // Close the database connection
 $conn->close();




?>

</body>
</main>

<div class="modal fade" id="viewRoutinesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User Routines</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Add content for your routines here -->
        <!-- Example: -->
        <p>Routine 1: ...</p>
        <p>Routine 2: ...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  // Add a click event handler to your "View routines" button
  $('.btn-primary').on('click', function() {
    // Show the Bootstrap modal
    $('#viewRoutinesModal').modal('show');
  });
});
</script>



<footer>

</footer>




</html>