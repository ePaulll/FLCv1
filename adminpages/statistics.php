<?php
require('../db/adminfunctions.php');
include_once '../db/dbconn.php';
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
 
    <link href="../css/statistics.css" rel="stylesheet">
<!-- <link href="../css/sb-admin-2.min.css" rel="stylesheet"> -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="adminscripts.js"></script>
</head>

<script>
function acceptRequest(user_id, coach_id, request_id) {
    
    console.log('Accepting request for User ID: ' + user_id + ', Coach ID: ' + coach_id + ', Request ID: ' + request_id);
    $.ajax({
     type: "POST", //post pag mag su submit ng data
     url: "../db/adminfunctions.php", // dito kung saan nya ipapasa yung data
     data: {  user_id: user_id, coach_id: coach_id, request_id: request_id, action: 'accept' }, // eto yung pinapasa na data
     success: function (response) {
         Swal.fire({
                 title: "Success",
                 text: "Request accepted",
                 icon: "success",
             });
             $('#acceptReq' + request_id).closest('tr').remove();
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

function rejectRequest(user_id, coach_id, request_id) {
    
    console.log('Rejecting request for User ID: ' + user_id + ', Coach ID: ' + coach_id + ', Request ID: ' + request_id);
    
    $.ajax({
     type: "POST",
     url: "../db/adminfunctions.php",
     data: {  user_id: user_id, coach_id: coach_id, request_id: request_id, action: 'rejected'},
     success: function (response) {
        console.log(response);
         Swal.fire({
                 title: "Rejected",
                 text: "Request Rejected",
                 icon: "success",
             });
              $('#rejectReq' + request_id).closest('tr').remove();
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


  
  <main>

<body>
<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total members</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $userCount; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

    <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                 Number of Coaches</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $coachCount; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
</div> 

</div> 



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

           
        
                    $sql = "SELECT r.request_id, r.coach_id, r.user_id, u.user_name, u.user_gender, u.user_age, c.coach_name
                    FROM tbl_coaching_requests AS r
                    JOIN tbl_users AS u ON r.user_id = u.user_id
                    JOIN tbl_coach AS c ON r.coach_id = c.coach_id
                    WHERE r.r_status IS NULL OR r.r_status = 'pending'";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['user_name'] . '</td>';
                echo '<td>' . $row['user_gender'] . '</td>';
                echo '<td>' . $row['user_age'] . '</td>';
                echo '<td>' . $row['coach_name'] . '</td>';
                echo '<td><button class="btn btn-success" id="acceptReq' . $row['request_id'] . '" onclick="acceptRequest(' . $row['user_id'] . ', ' . $row['coach_id'] . ', ' . $row['request_id'] . ')">Accept</button> 
                <button class="btn btn-danger" id="rejectReq' . $row['request_id'] . '" onclick="rejectRequest(' . $row['user_id'] . ', ' . $row['coach_id'] . ' , ' . $row['request_id'] . ')">Reject</button></td>';

                echo '</tr>';
                }
                } else {
                echo '<tr><td colspan="5">No coaching requests found.</td></tr>';
                }

            
                $conn->close();
               ?>
           </tbody>
       </table>
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
</body>

</html>



















