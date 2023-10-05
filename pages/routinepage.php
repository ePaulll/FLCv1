<?php
require('../db/functions.php');
include_once '../db/dbconn.php';
session_start();
$user_id = $_SESSION['user_id'];

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
    <script src="scripts.js"></script>

</head>
<main>

    <body>
<div class="container-fluid">
    

        <h1 class="rtn-h1">Your routines</h1>
       
            <?php
//         // Retrieve user's routines from the database
// $routines_query = "SELECT * FROM tbl_routines WHERE user_id=".$user_id;
// echo $routines_query;
// echo'<table>';
// $rs = mysqli_query($conn, $routines_query);
// while($rw = mysqli_fetch_array($rs)) {
//    echo' <tr>
//         <td>'.$rw['routine_name'].'</td></tr>';
// }
// echo'</table>';



 // Replace with the ID of the logged-in user

// SQL query to retrieve routines and related exercises for the logged-in user
$sql = "SELECT r.routine_name, e.exercise_name, re.exercise_sets, re.exercise_reps, re.exercise_weight
        FROM tbl_routines r
        INNER JOIN tbl_routine_exercises re ON r.routine_id = re.routine_id
        INNER JOIN tbl_exercises e ON re.exercise_id = e.exercise_id
        WHERE r.user_id = $user_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $routineName = $row['routine_name'];

        // Start a list group for each routine
        echo '<h3> Routine Name: ' . $routineName . '</h3>';
        echo '<ul class="list-group">';
        
        // Display exercise details inside the list group
        echo '<li class="list-group-item">';
        echo '<strong>Exercise Name:</strong> ' . $row['exercise_name'] . '<br>';
        echo '<strong>Sets:</strong> ' . $row['exercise_sets'] . '<br>';
        echo '<strong>Reps:</strong> ' . $row['exercise_reps'] . '<br>';
        echo '<strong>Weight:</strong> ' . $row['exercise_weight'] . '<br>';
        echo '</li>';

        // Close the list group for each routine
        echo '</ul>';
    }
} else {
    echo 'No routines and exercises found for the logged-in user.';
}

?>

</div>



