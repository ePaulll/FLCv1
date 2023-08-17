<?php 


include_once 'dbconn.php';
session_start();
$coach_id = $_SESSION['coach_id'];
$_SESSION['coach_id'] = $coach_id;  
echo $coach_id;


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


// for logging in ng coach
if (isset($_POST['logincoach'])) {
  $coach_email = $_POST['coachEmail'];
  $coach_password = $_POST['coachPassword1'];

  $coach_email = filter_var($coach_email, FILTER_SANITIZE_EMAIL);
  $coach_password = htmlspecialchars($coach_password);


  if (empty($coach_email) || empty($coach_password)) {
    $error = "Please enter both your email and password.";
  }

  if (!filter_var($coach_email, FILTER_VALIDATE_EMAIL)) {
    $error = "Please enter a valid email address.";
  }

  $coach = getCoachByEmail($coach_email); 
  if (!$coach || !password_verify($coach_password, $coach['coach_password'])) {
    $error = "Invalid email or password. Please try again.";
  }


  if (!isset($error)) {
    $_SESSION['coach_id'] = $coach['coach_id']; 
    insertAuditLog($coach['coach_id'], 'login');
    echo "Coach ID set in session: " . $_SESSION['coach_id'];
    header('Location: ../pages/coachdashboard.php');
    exit; 
  }

  echo $error;
}


// retrieve coach by email from tbl_coaches
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
  
 
  function insertAuditLog($user_id, $action) {
    $conn = new mysqli('localhost', 'root', '', 'fitlife_db');
  
    $stmt = $conn->prepare("INSERT INTO tbl_audit (user_id, audit_action, audit_timestamp) VALUES (?, ?, NOW())");
  
    $stmt->bind_param("is", $user_id, $action);
  
    $stmt->execute();
  
    $stmt->close();
    $conn->close();
  }

 
  // gumagana
  if (isset($_POST['user_id']) && isset($_POST['action'])) {
      $user_id = $_POST['user_id'];
      $action = $_POST['action'];
      
      if ($action === 'accept') {
          $updateQuery = "UPDATE tbl_users SET coach_id = ? WHERE user_id = ?";
          $stmt = $conn->prepare($updateQuery);
          $coach_id = $_SESSION['coach_id']; // Assuming you have coach_id in the session
          $stmt->bind_param("ii", $coach_id, $user_id);
          
          if ($stmt->execute()) {
            header("Location: ../pages/coachingrequests.php");
          } else {
              console.log('error');
          }
      } elseif ($action === 'reject') {
          // Perform the logic to reject the coaching request
          // For example, delete the request from the tbl_coaching_requests table
          $deleteQuery = "DELETE FROM tbl_coaching_requests WHERE user_id = ?";
          $stmt = $conn->prepare($deleteQuery);
          $stmt->bind_param("i", $user_id);
          
          if ($stmt->execute()) {
            header("Location: ../pages/coachingrequests.php");
          } else {
              // Error message
          }
      }
  }
  
  $conn->close();


?>




 