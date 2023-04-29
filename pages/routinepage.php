<?php
require('../db/functions.php');
include_once '../db/dbconn.php';
$_SESSION['user_id'] = $user_id;
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
    <link rel="stylesheet" href="../css/routinepage.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
</head>
<main>

    <body>
      
      <h1 class="rtn-h1">Your routines</h1>
        <div class="card-container">
          
        <?php
// Retrieve user's routines from the database
$routines_query = "SELECT * FROM tbl_routines WHERE user_id = $user_id";
$routines_result = mysqli_query($conn, $routines_query);

// Check if the query was executed successfully
if ($routines_result && mysqli_num_rows($routines_result) > 0) {
    while ($routine_row = mysqli_fetch_assoc($routines_result)) {
        $routine_id = $routine_row['routine_id'];
        $routine_name = $routine_row['routine_name'];
        ?>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $routine_name; ?></h5>
                <ul class="list-group">
                    <?php
                    // Retrieve exercises for the current routine
                    $exercises_query = "SELECT re.*, e.exercise_name 
                                        FROM tbl_routine_exercises re
                                        INNER JOIN tbl_exercises e ON re.exercise_id = e.exercise_id
                                        WHERE re.routine_id = $routine_id";
                    $exercises_result = mysqli_query($conn, $exercises_query);


                    if ($exercises_result && mysqli_num_rows($exercises_result) > 0) {
                        while ($exercise_row = mysqli_fetch_assoc($exercises_result)) {
                            $exercise_name = $exercise_row['exercise_name'];
                            $exercise_sets = $exercise_row['exercise_sets'];
                            $exercise_reps = $exercise_row['exercise_reps'];
                            $exercise_weight = $exercise_row['exercise_weight'];
                            ?>

                            <li class="list-group-item">
                                <h6 class="mb-1"><?php echo $exercise_name; ?></h6>
                                <p class="mb-0">Sets: <?php echo $exercise_sets; ?></p>
                                <p class="mb-0">Reps: <?php echo $exercise_reps; ?></p>
                                <p class="mb-0">Weight: <?php echo $exercise_weight; ?></p>
                                <button class="btn btn-primary btn-edit" data-toggle="modal" data-target="#editModal-<?php echo $exercise_row['exercise_id']; ?>">Edit</button>
                                <button class="btn btn-primary">Remove</button>
                            </li>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal-<?php echo $exercise_row['exercise_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?php echo $exercise_row['exercise_id']; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel-<?php echo $exercise_row['exercise_id']; ?>">Edit Exercise</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="form-group">
                                                    <label for="sets-<?php echo $exercise_row['exercise_id']; ?>">Sets</label>
                                                    <input type="text" class="form-control" id="sets-<?php echo $exercise_row['exercise_id']; ?>" value="<?php echo $exercise_sets; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="weight-<?php echo $exercise_row['exercise_id']; ?>">Weight</label>
                                                    <input type="text" class="form-control" id="weight-<?php echo $exercise_row['exercise_id']; ?>" value="<?php echo $exercise_weight; ?>">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                    } else {
                        echo "<li class='list-group-item'>No exercises found for this routine</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>

        <?php
    }
} else {
    echo "<p>No routines found for this user</p>";
}
?>




        </div>
       

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
<script src="scripts.js"></script>
</body>

</html>