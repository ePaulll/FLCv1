<?php
require('../db/coachfunctions.php');
include_once '../db/dbconn.php';


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
    <link rel="stylesheet" href="../css/coachingrequest.css">
    <script src="coachscripts.js"></script>

  
</head>
<main>

<body>
    <div class="container">
       
        <h2 class="h2c">Coaching Requests</h2>
    
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Requesting for coach:</th>
                    <th>Actions</th> <!-- Column for accept and reject buttons -->
                </tr>
            </thead>
            <tbody>
                <?php
                
                $conn = new mysqli('localhost', 'root', '', 'fitlife_db');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

               
               // $sql = "SELECT u.user_id, u.user_name, u.user_gender, u.user_age
                       // FROM tbl_coaching_requests AS r
                        //JOIN tbl_users AS u ON r.user_id = u.user_id";
                
                   // SQL query to fetch coaching requests along with user and coach details
                    $sql = "SELECT u.user_name, u.user_gender, u.user_age, c.coach_name
                    FROM tbl_coaching_requests AS r
                    JOIN tbl_users AS u ON r.user_id = u.user_id
                    JOIN tbl_coach AS c ON r.coach_id = c.coach_id
                    WHERE r.r_status IS NULL";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                     
                    echo '<tr>';
                    echo '<td>' . $row['user_name'] . '</td>';
                    echo '<td>' . $row['user_gender'] . '</td>';
                    echo '<td>' . $row['user_age'] . '</td>';
                    echo '<td>' . $row['coach_name'] . '</td>';
                    echo '<td><button class="btn btn-success" id="<?php echo "acceptReq".$request_id; ?>">Accept</button> <button class="btn btn-danger" id="<?php echo "rejectReq".$request_id; ?>">Reject</button></td>';
                    echo '</tr>';
                    }
                    } else {
                    echo '<tr><td colspan="5">No coaching requests found.</td></tr>';
                    }

                    // Close the database connection
                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>

 
</body>
</main>

<footer>

</footer>




</html>