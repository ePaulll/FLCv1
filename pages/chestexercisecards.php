
<?php
require('../db/functions.php');
include_once '../db/dbconn.php';


$target_body_part_id = 5; // Change this to the ID of the desired body part
$result = fetch_exercises_by_body_part($conn, $target_body_part_id);


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
    <link rel="stylesheet" href="../css/cards.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="scripts.js"></script>
</head>
<main>
<body>


<div class="card-container">
  <?php while($row = $result->fetch_assoc()) { ?>
    <div class="card">
      <img src="<?php echo $row['exercise_image']; ?>" class="card-img-top" alt="Exercise Image">
      <div class="card-body">
        <h5 class="card-title"><?php echo $row['exercise_name']; ?></h5>
        <p class="card-text"><?php echo $row['exercise_description']; ?></p>
        <a href="#" class="btn btn-primary">Add to Routine</a>
      </div>
    </div>
  <?php } ?>
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


</html>