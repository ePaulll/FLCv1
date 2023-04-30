<?php

error_reporting(E_ALL);
include_once 'dbconn.php';
session_start();
$user_id = $_SESSION['user_id'];// retrieve the user_id from the session variable
$_SESSION['user_id'] = $user_id;  // store the user_id in the session variable
 
var_dump($_POST);

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


// creating routine
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




// sa pag add ng exercise sa routine


if (isset($_POST['routine-select'], $_POST['exercise-id'],$_POST['sets-input'], $_POST['reps-input'], $_POST['weight-input'])) {
  // Get the submitted form data
  $routineId = $_POST['routine-select'];
  $exerciseId = $_POST['exercise-id'];
  $sets = $_POST['sets-input'];
  $reps = $_POST['reps-input'];
  $weight = $_POST['weight-input'];
 
  

  $sql = "INSERT INTO tbl_routine_exercises (routine_id, exercise_id, exercise_sets, exercise_reps, exercise_weight)
          VALUES ('$routineId', '$exerciseId', '$sets', '$reps', '$weight')";

  if ($conn->query($sql) === TRUE) {
      echo "Data inserted successfully";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}




//updating exercise sa routinepage

// Check if the update form was submitted
if (isset($_POST['updateExerciseBtn'])) {
  // Get the updated exercise details from the form
  $exerciseId = mysqli_real_escape_string($conn, $_POST['exerciseId']);
  $updatedSets = $_POST['setsUpdate'];
  $updatedReps = $_POST['repsUpdate'];
  $updatedWeight = $_POST['weightUpdate'];

  // Update the exercise details in the database
  $updateQuery = "UPDATE tbl_routine_exercises SET exercise_sets = '$updatedSets', 
  exercise_reps = '$updatedReps', exercise_weight = '$updatedWeight' WHERE exercise_id = $exerciseId";
  $result = mysqli_query($conn, $updateQuery);

  // Check if the query was executed successfully
  if ($result) {
      // Exercise details updated successfully
      echo "Exercise details updated successfully!";
  } else {
      // Error updating exercise details
      echo  "Error updating exercise" ;
    }
}


// if (isset($_POST['exerciseId'], $_POST['exerciseSets'], $_POST['exerciseReps'], $_POST['exerciseWeight'])) {
//   // Get the exercise details from the AJAX request
//   $exerciseId = $_POST['exerciseId'];
//   $exerciseSets = $_POST['exerciseSets'];
//   $exerciseReps = $_POST['exerciseReps'];
//   $exerciseWeight = $_POST['exerciseWeight'];

//   $updateQuery = "UPDATE tbl_routine_exercises SET exercise_sets = '$exerciseSets', exercise_reps = '$exerciseReps', exercise_weight = '$exerciseWeight' WHERE exercise_id = $exerciseId";
//    $result = mysqli_query($conn, $updateQuery);

//   $response = array('success' => true); // or false
//   echo json_encode($response);
//   exit;
// }


    // Check if the update exercise form is submitted
    if (isset($_POST['updateExerciseForm'])) {
        // Get the exercise details from the form submission
        $routineId= $_POST['routineId'];
        $exerciseId = $_POST['exerciseId'];
        $setsUpdate = $_POST['setsUpdate'];
        $repsUpdate = $_POST['repsUpdate'];
        $weightUpdate = $_POST['weightUpdate'];
        
        
        $routineIdQuery = "SELECT routine_id FROM tbl_routine_exercises WHERE exercise_id = $exerciseId";
        $routineIdResult = mysqli_query($conn, $routineIdQuery);
        
        if ($routineIdResult && mysqli_num_rows($routineIdResult) > 0) {
            $routineIdRow = mysqli_fetch_assoc($routineIdResult);
            $routineId = $routineIdRow['routine_id'];
            
          
            $updateQuery = "UPDATE tbl_routine_exercises SET exercise_sets = $setsUpdate, exercise_reps = $repsUpdate, exercise_weight = $weightUpdate WHERE routine_id = $routineId AND exercise_id = $exerciseId";
            $result = mysqli_query($conn, $updateQuery);
            
            if ($result) {
               
                echo "Exercise data updated successfully";
            } else {
               
                echo "Error updating exercise data: " . mysqli_error($conn);
            }
        } else {
            
            echo "Error: Routine ID not found for the exercise";
        }
    }


?>


