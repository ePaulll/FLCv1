<?php
require('../../db/functions.php');
require_once '../../db/dbconn.php';
session_start();

$user_id = $_GET['user_id'];

$target_body_part_id = 1; // Change to bodypart_id na gusto mo ipakita
$result = fetch_exercises_by_body_part($conn, $target_body_part_id);


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
    <script src="scripts.js"></script>

</head>


<body>


    <div class="card-container">
        <?php while($row = $result->fetch_assoc()) { ?>
        <div class="card">
            
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['exercise_name']; ?></h5>
                <p class="card-text"><?php echo $row['exercise_description']; ?></p>
                <a href="#" class="btn btn-primary card-btn" id="card-btn" data-bs-toggle="modal"
                data-bs-target="#addToRoutineModal" data-exercise-id="<?php echo $row['exercise_id']; ?>"> Add to Routine</a>
            </div>
        </div>
        <?php } ?>
    </div>


</body>


<div class="modal fade" id="addToRoutineModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Choose Routine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-to-routine-form" action="../db/functions.php" method="POST">
                    <div class="mb-3">
                        <label for="routine-select" class="form-label">Select Routine:</label>
                        <select class="form-select" id="routine-select" name="routine-select">
                            <?php 
                             $user_id = $_GET['user_id'];

                             // Create a SQL query to retrieve user routines based on user_id
                             $sql = "SELECT * FROM tbl_routines WHERE user_id = ?";
                             
                             // Use prepared statements to avoid SQL injection
                             $stmt = mysqli_prepare($conn, $sql);
                             
                             if ($stmt) {
                                 // Bind the user_id parameter
                                 mysqli_stmt_bind_param($stmt, "i", $user_id);
                             
                                 // Execute the query
                                 if (mysqli_stmt_execute($stmt)) {
                                     $result = mysqli_stmt_get_result($stmt);
                             
                                     // Process and display user routines
                                     while ($row = mysqli_fetch_assoc($result)) {
                                         // Display routine information here
                                         echo '<h2>Routine Name: ' . $row['routine_name'] . '</h2>';
                                         // Add more code to display other routine details if needed
                                     }
                             
                                     mysqli_stmt_close($stmt);
                                 } else {
                                     echo '<span style="color:red;">Error executing query</span>';
                                 }
                             } else {
                                 echo '<span style="color:red;">Error preparing statement</span>';
                             }
                             
                             mysqli_close($conn);
                            ?>
                        </select>
                    </div>
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
            <input type="hidden" id="exercise-id" name="exercise-id">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" id="add-to-routine-btn">Confirm</button>
                </form>
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