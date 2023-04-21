<?php

session_start();
include_once 'dbconn.php';

//register ng user
// if (isset($_POST['registerusr'])) {
//   $userEmail = $_POST['usrEmail'];
//   $userName = $_POST['usrName'];
//   $userPassword1 = $_POST['usrPassword1'];
//   $userPassword2 = $_POST['usrPassword2'];

//   if ($userPassword1 !== $userPassword2) {
//     echo "Passwords do not match.";
//   } else {
//     $sql = "INSERT INTO tblregister (userEmail, userName, userPassword) VALUES ('$userEmail', '$userName', '$userPassword1')";
//     if (mysqli_query($conn, $sql)) {
//       echo "Registration successful. Redirecting to login page...";
//       header("Location: ../login.php"); 
//       exit();
//     } else {
//       echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//     }
//   }

//   mysqli_close($conn);
// }



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
      $_SESSION['user_id'] = $user['id']; // Store the user ID in the session
      header('Location: ../pages/dashboard.php');
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





?>
