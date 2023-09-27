<?php 
//   if (file_exists('db/database.php')) { include_once('db/database.php'); }
//   if (file_exists('../db/database.php')) { include_once('../db/database.php'); }


include_once 'dbconn.php';
session_start();
$coach_id = $_SESSION['coach_id'];
$_SESSION['coach_id'] = $coach_id;  
echo $coach_id;

//register ng coach
if (isset($_POST['registercoach'])) {
  $coach_name = $_POST['coachName'];
  $coach_email = $_POST['coachEmail'];
  $coach_password = $_POST['coachPassword'];


  if (!filter_var($coach_email, FILTER_VALIDATE_EMAIL)) {
      header("Location: ../pages/coachregister.php?error=invalidemail");
      exit();
  }

 
  if (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $coach_password)) {
      header("Location: ../pages/coachregister.php?error=invalidpassword");
      exit();
  }

  $hashedPassword = password_hash($coach_password, PASSWORD_DEFAULT);

  
  $conn = new mysqli('localhost', 'root', '', 'fitlife_db');
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql = "INSERT INTO tbl_coach (coach_name, coach_email, coach_password) 
          VALUES ('$coach_name', '$coach_email', '$hashedPassword')";

  if ($conn->query($sql) === TRUE) {
      header("Location: ../pages/coachlogin.php");
      exit();
  } else {
      header("Location: ../pages/coachregister.php?error=databaseerror");
      exit();
  }

  $conn->close();
}






// sa create routine

// if (isset($_POST['routineName']) && isset($_POST['userId']) && isset($_POST['coach_id'])) {
//     $routineName = $_POST['routineName'];
//     $userId = $_POST['userId'];
//     $coachId = $_POST['coach_id'];

   
//     $routineName = filter_var($routineName, FILTER_SANITIZE_STRING);
//     $userId = filter_var($userId, FILTER_VALIDATE_INT);
//     $coachId = filter_var($coachId, FILTER_VALIDATE_INT);

//     if ($routineName === false || $userId === false || $coachId === false) {
//         $response = array('status' => 'error', 'message' => 'Invalid input data.');
//     } else {
       
//         $conn = new mysqli('localhost', 'root', '', 'fitlife_db');
//         if ($conn->connect_error) {
//             die("Connection failed: " . $conn->connect_error);
//         }

        
//         $stmt = $conn->prepare("INSERT INTO tbl_routines (user_id, coach_id, routine_name) VALUES (?, ?, ?)");
//         $stmt->bind_param("iis", $userId, $coachId, $routineName);

//         if ($stmt->execute()) {
//             $response = array('status' => 'success', 'message' => 'Routine created successfully.');
//         } else {
//             $response = array('status' => 'error', 'message' => 'Failed to create routine.');
//         }

//         $stmt->close();
//         $conn->close();
//     }
// } else {
//     $response = array('status' => 'error', 'message' => 'Invalid request.');
// }

// // Send the JSON response
// header('Content-Type: application/json');
// echo json_encode($response);
















// gumagana log in may sw8alert
if (isset($_POST['logincoach'])) {
  $coach_email = $_POST['coachEmail'];
  $coach_password = $_POST['coachPassword1'];

  $coach_email = filter_var($coach_email, FILTER_SANITIZE_EMAIL);
  $coach_password = htmlspecialchars($coach_password);

  $response = array();

  if (empty($coach_email) || empty($coach_password)) {
      $response = array(
          'status' => 'error',
          'message' => 'Please enter both your email and password.'
      );
  } elseif (!filter_var($coach_email, FILTER_VALIDATE_EMAIL)) {
      $response = array(
          'status' => 'error',
          'message' => 'Please enter a valid email address.'
      );
  } else {
      $coach = getCoachByEmail($coach_email);
      if (!$coach || !password_verify($coach_password, $coach['coach_password'])) {
          $response = array(
              'status' => 'error',
              'message' => 'Invalid email or password. Please try again.'
          );
      } else {
          $_SESSION['coach_id'] = $coach['coach_id'];
          insertAuditLog($coach['coach_id'], 'login');
          $response = array(
              'status' => 'success',
              'message' => 'Login successful.'
          );
      }
  }

  
  header('Content-Type: application/json');
  echo json_encode($response);
}



function getCoachByEmail($email) {
    
    $conn = new mysqli('localhost', 'root', '', 'fitlife_db');
  
    
    $stmt = $conn->prepare("SELECT * FROM tbl_coach WHERE coach_email = ?");

  
    $stmt->bind_param("s", $email);
 
    $stmt->execute();
  
   
    $result = $stmt->get_result();
  
 
    $coach = $result->fetch_assoc();
  
    $stmt->close();
    $conn->close();
 
    return $coach;
  }
  
 
  function insertAuditLog($coach_id, $action) {
    $conn = new mysqli('localhost', 'root', '', 'fitlife_db');
  
    $stmt = $conn->prepare("INSERT INTO tbl_audit (coach_id, audit_action, audit_timestamp) VALUES (?, ?, NOW())");
  
    $stmt->bind_param("is", $coach_id, $action);
  
    $stmt->execute();
  
    $stmt->close();
    $conn->close();
  }

 
  // gumagana
  // if (isset($_POST['user_id']) && isset($_POST['action'])) {
  //     $user_id = $_POST['user_id'];
  //     $action = $_POST['action'];
      
  //     if ($action === 'accept') {
  //         $updateQuery = "UPDATE tbl_users SET coach_id = ? WHERE user_id = ?";
  //         $stmt = $conn->prepare($updateQuery);
  //         $coach_id = $_SESSION['coach_id']; 
  //         $stmt->bind_param("ii", $coach_id, $user_id);
          
  //         if ($stmt->execute()) { 
  //           header("Location: ../coachpages/coachdashboard.php");
  //         } else {
  //             console.log('error');
  //         }
  //     } elseif ($action === 'reject') {
        
  //         $deleteQuery = "DELETE FROM tbl_coaching_requests WHERE user_id = ?";
  //         $stmt = $conn->prepare($deleteQuery);
  //         $stmt->bind_param("i", $user_id);
          
  //         if ($stmt->execute()) {
  //           header("Location: ../coachpages/coachdashboard.php");
  //         } else {
             
  //         }
  //     }
  // }
  
  // $conn->close();




  if (isset($_POST['user_id']) && isset($_POST['action'])) {
    $user_id = $_POST['user_id'];
    $action = $_POST['action'];
    
    if ($action === 'accept') {
        $updateQuery = "UPDATE tbl_users SET coach_id = ? WHERE user_id = ?";
        $stmt = $conn->prepare($updateQuery);
        $coach_id = $_SESSION['coach_id']; 
        $stmt->bind_param("ii", $coach_id, $user_id);
        
      // Update yung status sa tbl_coaching_requests
        $updateStatusQuery = "UPDATE tbl_coaching_requests SET status = 'accepted' WHERE user_id = ?";
        $stmtUpdateStatus = $conn->prepare($updateStatusQuery);
        $stmtUpdateStatus->bind_param("i", $user_id);
        
       
        if ($stmt->execute() && $stmtUpdateStatus->execute()) {
            header("Location: ../coachpages/coachdashboard.php");
        } else {
           
        }
    } elseif ($action === 'reject') {
      // Update yung status sa tbl_coaching_requests
      $updateStatusQuery = "UPDATE tbl_coaching_requests SET status = 'rejected' WHERE user_id = ?";
      $stmtUpdateStatus = $conn->prepare($updateStatusQuery);
      $stmtUpdateStatus->bind_param("i", $user_id);
      
    
      if ($stmtUpdateStatus->execute()) {
          header("Location: ../coachpages/coachdashboard.php");
      } else {
            
        }
    }
}

$conn->close();



?>






 