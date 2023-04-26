<?php
include_once 'dbconn.php';
session_start();
$user_id = $_SESSION['user_id'];// retrieve the user_id from the session variable
$_SESSION['user_id'] = $user_id;  // store the user_id in the session variable
 


//register ng user

if (isset($_POST['registerusr'])) {
  $user_email = $_POST['usrEmail'];
  $user_name = $_POST['usrName'];
  $userPassword1 = $_POST['usrPassword1'];
  $userPassword2 = $_POST['usrPassword2'];
  $user_gender = $_POST['usrGender'];
  $user_age = $_POST['usrAge'];
  $user_bodyweight = $_POST['usrBodyweight'];
  $user_height = $_POST['usrHeight'];

  if ($userPassword1 !== $userPassword2) {
    echo "Passwords do not match.";
  } else {
    $hashedPassword = password_hash($userPassword1, PASSWORD_DEFAULT);
    $sql = "INSERT INTO tbl_users (user_email, user_name, user_password,  user_bodyweight, user_height, user_age, user_gender) 
        VALUES ('$user_email', '$user_name', '$hashedPassword', '$user_bodyweight', '$user_height', '$user_age', '$user_gender')";


    if (mysqli_query($conn, $sql)) {
      echo "Registration successful. Redirecting to login page...";
      header("Location: ../pages/login.php"); 
      exit();
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }

  mysqli_close($conn);
}


//login ng user
if(isset($_POST['loginusr'])) {
  $user_email = $_POST['usrEmail'];
  $userPassword1 = $_POST['usrPassword1'];

  // filter ng input iwas vulne
  $user_email = filter_var($user_email, FILTER_SANITIZE_EMAIL);
  $userPassword1 = htmlspecialchars($userPassword1);

  // Check for required fields
  if(empty($user_email) || empty($userPassword1)) {
      $error = "Please enter both your email and password.";
  }

  // check kung tama email format
  if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
      $error = "Please enter a valid email address.";
  }

  // Verify the email and password sa db
  $user = getUserByEmail($user_email); // Retrieve the user from the database
  if(!$user || !password_verify($userPassword1, $user['user_password'])) {
      $error = "Invalid email or password. Please try again.";
  }

  // str8 to dashboard if satisfied ang needs above
  if(!isset($error)) {
      $_SESSION['user_id'] = $user['user_id']; // Store the user ID in the session
      echo "User ID set in session: " . $_SESSION['user_id'];
      header('Location: ../pages/dashboard.php');
      // Debugging code
      exit;
  }

  // display error
  echo $error;
}

function getUserByEmail($user_email) {
  // Connect to the database
  $db = new PDO('mysql:host=localhost;dbname=fitlife_db', 'root', '');

  // Prepare and execute the query to retrieve the user by email
  $stmt = $db->prepare('SELECT * FROM tbl_users WHERE user_email = :email');
  $stmt->bindParam(':email', $user_email);
  $stmt->execute();

  // Return the user data if found, otherwise return null
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  return $user ? $user : null;
}


//function para lumitaw yung mga exercise sa bootstrap card
function fetch_exercises_by_body_part($conn, $target_body_part_id) {
  $sql = "SELECT * FROM tbl_exercises WHERE body_part_id = $target_body_part_id";
  $result = $conn->query($sql);

  return $result;
}



if (isset($_POST['routinenamefield'])) {
  $routinename = $_POST['routinenamefield'];
  $user_id = $_SESSION['user_id'];
  $sql = "INSERT INTO tbl_routines (user_id, routine_name) 
          VALUES ('$user_id','$routinename')";
  $result = mysqli_query($conn, $sql);

  if(mysqli_affected_rows($conn) > 0) {
    echo "Success!";
  } else {
    echo "Error: data not inserted";
  }
}





?>


