<?php
require('../db/functions.php');
include_once '../db/dbconn.php';
session_start();
$_SESSION['user_id'] = $user_id;
print_r($_SESSION);


if (isset($_POST['routineName'])) {
    $routinenamefield = $_POST['routinenamefield'];
    $user_id = $_SESSION['user_id'];
    $sql = "INSERT INTO tbl_routines (user_id, routine_name) 
            VALUES ($user_id, '$routinenamefield')";
    $result = mysqli_query($conn, $sql);
  
    if(mysqli_affected_rows($conn) > 0) {
      echo "Success!";
    } else {
      echo "Error: data not inserted";
    }
  } 
  

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>FitLife</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/exerciselist.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="scripts.js"></script>
</head>




<body>
    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <ul class="navbar-nav">
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
                            <a class="nav-link" href="#" id="chest-link">Chest</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#" id="back-link">Back</a>
                        </li>

                    </ul>
                    <form class="form-inline my-2 my-lg-0" action="/search" method="GET">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search Exercise"
                            aria-label="Search" name="q">
                        <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
                    </form>
                    <button type="button" id="modalButton" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#viewModal">
                        Create Routine
                    </button>
                </nav>
            </div>
            <div class="card-container" id="card-container"></div>
        </div>
    </div>

    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create a Routine</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../db/functions.php" method="post" id="routineform">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Enter routine name" id="routinenamefield" name="routinenamefield">
                        <label for="floatingInput">Enter Routine Name</label>
                    </div>
                  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="createRoutineBtn" name="createRoutineBtn" data-bs-dismiss="modal">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>








    
</body>
<footer>

</footer>

<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>

<script>


</script>

</body>

</html>