<?php 
  if (file_exists('db/database.php')) { include_once('db/database.php'); }
  if (file_exists('../db/database.php')) { include_once('../db/database.php'); }


include_once 'dbconn.php';

session_start();
$coach_id = $_SESSION['coach_id'];
$_SESSION['coach_id'] = $coach_id;  
// echo $coach_id; naneto 4hrs debuggin dahil sau

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





function fetch_exercises_by_body_part($conn, $target_body_part_id) {
    $sql = "SELECT * FROM tbl_exercises WHERE body_part_id = $target_body_part_id";
    $result = $conn->query($sql);
  
    return $result;
  }
  


  function fetchUserRoutines($user_id, $coach_id, $db_connection) {
    // Sanitize inputs to prevent SQL injection
    $user_id = mysqli_real_escape_string($db_connection, $user_id);
    $coach_id = mysqli_real_escape_string($db_connection, $coach_id);

    // Query to fetch user routines
    $query = "SELECT * FROM tbl_routines WHERE user_id = $user_id AND coach_id = $coach_id";

    // Perform the query
    $result = mysqli_query($db_connection, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($db_connection));
    }

    // Initialize an empty array to store routines
    $routines = array();

    // Fetch routines and add them to the array
    while ($row = mysqli_fetch_assoc($result)) {
        $routines[] = $row;
    }

    // Free the result set
    mysqli_free_result($result);

    // Return the array of routines
    return $routines;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exerciseName'], $_POST['exerciseDescription'], $_POST['bodyPart'])) {
    ob_start();
    $exerciseName = $_POST['exerciseName'];
    $exerciseDescription = $_POST['exerciseDescription'];
    $bodyPart = $_POST['bodyPart'];
  

    $insert_query = "INSERT INTO tbl_exercises (exercise_name, exercise_description, body_part_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_query);

        $stmt->bind_param("ssi", $exerciseName, $exerciseDescription, $bodyPart);

        if ($stmt->execute()) {
            $response = array('success' => true);
        } else {
            $response = array('success' => false, 'error' => 'Database insert error');
        }

    $stmt->close();
    $conn->close();
    header('Content-Type: application/json');
    ob_end_clean();
    echo json_encode($response);
    exit;
    
}


