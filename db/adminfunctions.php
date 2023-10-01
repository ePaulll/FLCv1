<?php
include_once 'dbconn.php';


if (isset($_POST['loginadmin'])) {
    $admin_email = $_POST['adminEmail'];
    $admin_password = $_POST['adminPassword1'];

    // Sanitize user input
    $admin_email = filter_var($admin_email, FILTER_SANITIZE_EMAIL);
    $admin_password = htmlspecialchars($admin_password);

    $response = array(); // Initialize a response array

    // Form validation
    if (empty($admin_email) || empty($admin_password)) {
        $response = array(
            'status' => 'error',
            'message' => 'Please enter both your email and password.'
        );
    } else if (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
        $response = array(
            'status' => 'error',
            'message' => 'Please enter a valid email address.'
        );
    } else {
        // Attempt to retrieve the admin by email
        $admin = getAdminByEmail($admin_email);

        if ($admin && password_verify($admin_password, $admin['admin_password'])) {
            // Successful login
            session_start();
            $_SESSION['admin_id'] = $admin['admin_id']; 
         

            $response = array(
                'status' => 'success',
                'message' => 'Login successful.'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Invalid email or password. Please try again.'
            );
        }
    }

    // Output JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
  }



  function getAdminByEmail($admin_email) {
    try {
        $db = new PDO('mysql:host=localhost;dbname=fitlife_db', 'root', '');

        
        $stmt = $db->prepare('SELECT * FROM tbl_admin WHERE admin_email = :email');
        $stmt->bindParam(':email', $admin_email);
        $stmt->execute();

        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        return $admin ? $admin : null;
    } catch (PDOException $e) {
     
        return null;
    }
}


if (isset($_POST['registeradmin'])) {
    $admin_name = $_POST['adminName'];
    $admin_email = $_POST['adminEmail'];
    $admin_password = $_POST['adminPassword'];

    // Validate the email
    if (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../pages/register.php?error=invalidemail");
        exit();
    }

    // Validate the password
    if (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $admin_password)) {
        header("Location: ../pages/register.php?error=invalidpassword");
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($admin_password, PASSWORD_DEFAULT);

    // Perform the database insert
    // Update this SQL query to match your database schema
    $sql = "INSERT INTO tbl_admin (admin_name, admin_email, admin_password) 
            VALUES ('$admin_name', '$admin_email', '$hashedPassword')";

    if (mysqli_query($conn, $sql)) {
        header("Location: adminlogin.php");
        exit();
    } else {
        header("Location: ../pages/adminregister.php?error=databaseerror");
        exit();
    }
}


// sa cards
$sql = "SELECT COUNT(*) AS user_count FROM tbl_users"; 
// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();

    // Get the count of users
    $userCount = $row['user_count'];
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}



// sa cards
$sql = "SELECT COUNT(*) AS coach_count FROM tbl_coach"; 

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();

    // Get the count of users
    $coachCount = $row['coach_count'];
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}



// if (isset($_POST['user_id']) && isset($_POST['action'])) {
//     $user_id = $_POST['user_id'];
//     $action = $_POST['action'];
    
//     if ($action === 'accept') {
//         $updateQuery = "UPDATE tbl_users SET coach_id = ? WHERE user_id = ?";
//         $stmt = $conn->prepare($updateQuery);
//         $coach_id = $_SESSION['coach_id']; 
//         $stmt->bind_param("ii", $coach_id, $user_id);
        
//       // Update yung status sa tbl_coaching_requests
//         $updateStatusQuery = "UPDATE tbl_coaching_requests SET status = 'accepted' WHERE user_id = ?";
//         $stmtUpdateStatus = $conn->prepare($updateStatusQuery);
//         $stmtUpdateStatus->bind_param("i", $user_id);
        
       
//         if ($stmt->execute() && $stmtUpdateStatus->execute()) {
//             header("Location: ../coachpages/coachdashboard.php");
//         } else {
           
//         }
//     } elseif ($action === 'reject') {
//       // Update yung status sa tbl_coaching_requests
//       $updateStatusQuery = "UPDATE tbl_coaching_requests SET status = 'rejected' WHERE user_id = ?";
//       $stmtUpdateStatus = $conn->prepare($updateStatusQuery);
//       $stmtUpdateStatus->bind_param("i", $user_id);
      
    
//       if ($stmtUpdateStatus->execute()) {
//           header("Location: ../coachpages/coachdashboard.php");
//       } else {
            
//         }
//     }
// }

// $conn->close();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id']) && isset($_POST['coach_id']) && isset($_POST['request_id']) && isset($_POST['action'])) {
    $user_id = $_POST['user_id'];
    $coach_id = $_POST['coach_id'];
    $request_id = $_POST['request_id'];
    $action = $_POST['action'];

    if ($action === 'accept') {
        // Update tbl_coaching_request to set r_status to 'accepted' for the specified request_id
        $sqlUpdateRequest = "UPDATE tbl_coaching_requests SET r_status = 'accepted' WHERE request_id = ?";
        $stmtUpdateRequest = $conn->prepare($sqlUpdateRequest);
        $stmtUpdateRequest->bind_param("i", $request_id);

        if ($stmtUpdateRequest->execute()) {
            // Update the tbl_coaching_requests record successfully
            // Now, update the tbl_users to set coach_id
            $sqlUpdateUser = "UPDATE tbl_users SET coach_id = ? WHERE user_id = ?";
            $stmtUpdateUser = $conn->prepare($sqlUpdateUser);
            $stmtUpdateUser->bind_param("ii", $coach_id, $user_id);

            if ($stmtUpdateUser->execute()) {
                echo "success"; // Success message
            } else {
                echo "error: " . $stmtUpdateUser->error; // Error message for tbl_users update
            }
        } else {
            echo "error: " . $stmtUpdateRequest->error; // Error message for tbl_coaching_requests update
        }

        $stmtUpdateRequest->close();
        $stmtUpdateUser->close();
    } else {
        echo "error: Invalid action"; // Handle other actions if needed
    }
} else {
    echo "error: Invalid request parameters"; // Handle invalid or missing parameters
}





if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id']) && isset($_POST['coach_id']) && isset($_POST['request_id']) && isset($_POST['action'])) {
    $user_id = $_POST['user_id'];
    $coach_id = $_POST['coach_id'];
    $request_id = $_POST['request_id'];
    $action = $_POST['action'];

    if ($action === 'rejected') {
        $sqlUpdateRequest = "UPDATE tbl_coaching_requests SET r_status = 'rejected' WHERE request_id = ?";
        $stmtUpdateRequest = $conn->prepare($sqlUpdateRequest);
        $stmtUpdateRequest->bind_param("i", $request_id);

        if ($stmtUpdateRequest->execute()) {
            echo "success"; // Success message for rejection
        } else {
            echo "error: " . $stmtUpdateRequest->error; 
        }

        $stmtUpdateRequest->close();
    }
}



?>