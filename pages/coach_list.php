<?php
session_start();
require('../db/functions.php');
include_once '../db/dbconn.php';

if (isset($_SESSION['user_id'])) {
    echo "User ID: " . $_SESSION['user_id'];
} else {
    echo "User ID not set in the session.";
}




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
  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/coachcard.css">
    <script src="scripts.js"></script>

   
    <script>


function generateRequest(user_id, coach_id) {
 
 console.log('coach id: ' + coach_id + ', user id: ' + user_id);
 $.ajax({
     type: "POST",
     url: "../db/functions.php",
     data: {  userId: user_id, coachId: coach_id },
     success: function (response) {
         Swal.fire({
                 title: "Success",
                 text: "Hiring request sent successfully.",
                 icon: "success",
             });
     },
     error: function () {
         console.log(response);
         Swal.fire({
             title: "Error",
             text: "An error occurred while processing your request.",
             icon: "error",
         });
     }
 });
}


 



</script>
</head>
<main>

    <body>
    <div class="container">
    <div class="row">
        <?php

        $conn = new mysqli('localhost', 'root', '', 'fitlife_db');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        
        $sql = "SELECT coach_id, coach_name FROM tbl_coach"; 
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
             
                $coach_id = $row['coach_id'];
                $coach_name = $row['coach_name'];
             
        ?>
        <div class="col-md-4 mb-3">
            <div class="card">
              
                <div class="card-body">
                    <h5 class="card-title"><?php echo $coach_name; ?></h5>
                    <?php echo $_SESSION['user_id'] ?>
                    <?php echo $coach_id ?>

                  
                    <a href="#" class="btn btn-primary hire-coach" id="<?php echo "sendRequestBtn".$coach_id; ?>" 
                    onclick="generateRequest(<?php echo $_SESSION['user_id'] ?>, <?php echo $coach_id ?> )">Send request</a>

                   


                </div>
            </div>
        </div>
        <?php
            }
        } else {
            echo "No coaches available.";
        }

        $conn->close();
        ?>
    </div>
</div>

 
    </body>
</main>
<footer>

</footer>


</body>

</html>