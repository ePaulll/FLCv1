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
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?php echo $user_name; ?></h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Age: <?php echo $user_age; ?></li>
                    <li class="list-group-item">Gender: <?php echo $user_gender; ?></li>
                </ul>
                <a href="#" class="btn btn-primary">View routines</a>
            </div>
</div>
</div>
</body>
</main>
<footer>

</footer>




</html>