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
    <link rel="stylesheet" href="../css/coachcard.css">
    <script src="coachscripts.js"></script>

  
</head>
<main>

<body>
    <div class="container">
        <h2>Coach Hiring Requests</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Actions</th> <!-- Column for accept and reject buttons -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Assuming you have a valid database connection
                $conn = new mysqli('localhost', 'root', '', 'fitlife_db');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

               
               // $sql = "SELECT u.user_id, u.user_name, u.user_gender, u.user_age
                       // FROM tbl_coaching_requests AS r
                        //JOIN tbl_users AS u ON r.user_id = u.user_id";
                
                        $sql = "SELECT u.user_id, u.user_name, u.user_gender, u.user_age
                        FROM tbl_coaching_requests AS r
                        JOIN tbl_users AS u ON r.user_id = u.user_id
                        WHERE r.status IS NULL";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $user_id = $row['user_id'];
                        $user_name = $row['user_name'];
                        $user_gender = $row['user_gender'];
                        $user_age = $row['user_age'];
                        ?>
                        <tr>
                            <td><?php echo $user_name; ?></td>
                            <td><?php echo $user_gender; ?></td>
                            <td><?php echo $user_age; ?></td>
                            <td>
                            <form action="../db/coachfunctions.php" method="post">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <button type="submit" name="action" value="accept" class="btn btn-success">Accept</button>
                        <button type="submit" name="action" value="reject" class="btn btn-danger">Reject</button>
                    </form>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='4'>No hiring requests available.</td></tr>";
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




</html>