<?php
session_start();
if (file_exists('db/database.php')) { include_once('db/database.php'); }
if (file_exists('../db/database.php')) { include_once('../db/database.php'); }

$user_id = $_GET['user_id'];


error_reporting(E_ALL);
ini_set('display_errors', 1);
// var_dump($_GET);

//routine_id, user_id, coach_id, routine_name
if (isset($_GET['user_id']) && isset($_GET['routineName'])){
    mysqli_query($db_connection,"INSERT INTO tbl_routines (user_id, coach_id, routine_name) 
                                VALUES ('".$_GET['user_id']."', '".$_SESSION['coach_id']."', '".$_GET['routineName']."')");
    echo'<span style="color:green;">Successfully Inserted</span>';
}






// if (isset($_GET['user_id']) && isset($_GET['routineName'])) {
//     // Make sure to validate and sanitize user inputs (e.g., use mysqli_real_escape_string)
//     $user_id = mysqli_real_escape_string($db_connection, $_GET['user_id']);
//     $routineName = mysqli_real_escape_string($db_connection, $_GET['routineName']);

//     $coach_id = $_SESSION['coach_id'];

//     $sql = "INSERT INTO tbl_routines (user_id, coach_id, routine_name) VALUES (?, ?, ?)";
//     $stmt = mysqli_prepare($db_connection, $sql);

//     if ($stmt) {
//         mysqli_stmt_bind_param($stmt, "iis", $user_id, $coach_id, $routineName);

//         if (mysqli_stmt_execute($stmt)) {
//             echo '<span style="color:green;">Successfully Inserted</span>';
//         } else {
//             echo '<span style="color:red;">Error Inserting Data</span>';
//         }

//         mysqli_stmt_close($stmt);
//     } else {
//         echo '<span style="color:red;">Error Preparing Statement</span>';
//     }
// } else {
//     echo '<span style="color:red;">Invalid Parameters</span>';
// }

?>

<!doctype html>
<html lang="en">

<head>
    <title>FitLife</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css
" rel="stylesheet">
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

function loadPage(url, elementId) {
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
        xmlhttp.open("GET", url, true);
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




//     function add_routine(user_id) {
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
    
        <div class="col-md-12">

            <nav class="navbar fixed-top navbar-expand-lg bg-light justify-content-center">
            <a href="javascript:void(0);" class="btn btn-primary" onclick="loadPage('clientlist.php', 'main-content')"> <i class="bi bi-arrow-left-square"></i> Back</a>

                <ul class="navbar-nav nav-underline">
                    <li class="nav-item active">
                        <a class="nav-link" href="#" id="legs-link"><?=$user_id?></a>
                    </li>
                    <li class="nav-item active">
                        <!-- <a class="nav-link" href="#" id="legs-link">Legs</a> -->
                        <a class="nav-link" href="javascript:void(0);" id="legs-link" onclick="loadPage('../coachpages/cards/legexercisecards.php', 'card-container')">Legs</a>
                    </li>
                    <li class="nav-item active">
                        <!-- <a class="nav-link" href="#" id="core-link">Core</a> -->
                        <a class="nav-link" href="javascript:void(0);" id="core-link" onclick="loadPage('../coachpages/cards/coreexercisecards.php', 'card-container')">Core</a>
                    </li>
                    <li class="nav-item active">
                        <!-- <a class="nav-link" href="#" id="arms-link">Arms</a> -->
                        <a class="nav-link" href="javascript:void(0);" id="arms-link" onclick="loadPage('../coachpages/cards/armsexercisecards.php', 'card-container')">Arms</a>
                    </li>
                    <li class="nav-item active">
                        <!-- <a class="nav-link" href="#" id="shoulders-link">Shoulders</a> -->
                        <a class="nav-link" href="javascript:void(0);" id="shoulders-link" onclick="loadPage('../coachpages/cards/shouldersexercisecards.php', 'card-container')">Shoulders</a>
                    </li>
                    <li class="nav-item active">
                        <!-- <a class="nav-link" href="#" id="chest-link">Chest -->
                        <a class="nav-link" href="javascript:void(0);" id="chest-link" onclick="loadPage('../coachpages/cards/chestexercisecards.php', 'card-container')">Chest</a>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <!-- <a class="nav-link" href="#" id="back-link">Back</a> -->
                        <a class="nav-link" href="javascript:void(0);" id="back-link" onclick="loadPage('../coachpages/cards/backexercisecards.php', 'card-container')">Back</a>
                    </li>

                </ul>
                <form class="form-inline sm-2">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="routineName" placeholder="">
                        <label for="routineName">Routine Name</label>
                    </div>

                </form>
                <button onclick="add_routine(<?=$user_id?>);" class="btn btn-primary"> Create Routine </button>
            </nav>
        </div>
        <div class="card-container" id="card-container"></div>
        
<div id="content"> </div>
    </body>
</main>



<footer>

</footer>


</body>

</html>