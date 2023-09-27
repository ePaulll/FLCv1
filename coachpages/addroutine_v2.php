<?php
// session_start();
if (file_exists('db/database.php')) { include_once('db/database.php'); }
if (file_exists('../db/database.php')) { include_once('../db/database.php'); }

$user_id = $_GET['user_id'];

//routine_id, user_id, coach_id, routine_name
if (isset($_GET['user_id']) && isset($_GET['routineName'])){
    mysqli_query($db_connection,"INSERT INTO tbl_routines (user_id, coach_id, routine_name) 
                                VALUES ('".$_GET['user_id']."', '".$_SESSION['coach_id']."', '".$_GET['routineName']."')");
    echo'<span style="color:green;">Successfully Inserted</span>';
}

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
                    loadPage('addroutine_v2.php?user_id=' + user_id +
                        '&routineName=' + routineName, 'content');
                }
            });
        } else {
            Swal.fire('Error on Routine', 'Please Input Routine', 'error');
        }
    }
    </script>


</head>
<main>

    <body>
        <!-- Right Container -->
        <div class="col-md-12">

            <nav class="navbar fixed-top navbar-expand-lg bg-light justify-content-center">
                <ul class="navbar-nav nav-underline">
                    <li class="nav-item active">
                        <a class="nav-link" href="#" id="legs-link"><?=$user_id?></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#" id="legs-link">Legs</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#" id="core-link">Core</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#" id="arms-link">Arms</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#" id="shoulders-link">Shoulders</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#" id="chest-link">Chest

                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#" id="back-link">Back</a>
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
        <!-- <div class="card-container" id="card-container"></div> -->
        </div>

    </body>
</main>



<footer>

</footer>


</body>

</html>