<?php


include_once 'dbconn.php';
// session_start();
// $user_id = $_SESSION['user_id'];
// $_SESSION['user_id'] = $user_id;  
 


if (isset($_POST['registerusr'])) {
  $user_email = $_POST['usrEmail'];
  $user_name = $_POST['usrName'];
  $userPassword1 = $_POST['usrPassword1'];
  $userPassword2 = $_POST['usrPassword2'];
  $user_gender = $_POST['usrGender'];
  $user_age = $_POST['usrAge'];
  $user_bodyweight = $_POST['usrBodyweight'];
  $user_height = $_POST['usrHeight'];

  // Validate ng email
  if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../pages/register.php?error=invalidemail");
    exit();
  }

  // Validate ng password
  if (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $userPassword1)) {
    header("Location: ../pages/register.php?error=invalidpassword");
    exit();
  }

  if ($userPassword1 !== $userPassword2) {
    header("Location: ../pages/register.php?error=passwordmismatch");
    exit();
  } else {
    $hashedPassword = password_hash($userPassword1, PASSWORD_DEFAULT);
    $sql = "INSERT INTO tbl_users (user_email, user_name, user_password,  user_bodyweight, user_height, user_age, user_gender) 
        VALUES ('$user_email', '$user_name', '$hashedPassword', '$user_bodyweight', '$user_height', '$user_age', '$user_gender')";

    if (mysqli_query($conn, $sql)) {
      header("Location: ../pages/login.php");
      exit();
    } else {
      header("Location: ../pages/register.php?error=databaseerror");
      exit();
      mysqli_close($conn); 
    }
  }


}






if(isset($_POST['loginusr'])) {
  $user_email = $_POST['usrEmail'];
  $userPassword1 = $_POST['usrPassword1'];

  $user_email = filter_var($user_email, FILTER_SANITIZE_EMAIL);
  $userPassword1 = htmlspecialchars($userPassword1);

  // form validation
  if(empty($user_email) || empty($userPassword1)) {
      $response = array(
          'status' => 'error',
          'message' => 'Please enter both your email and password.'
      );
  } else if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
      $response = array(
          'status' => 'error',
          'message' => 'Please enter a valid email address.'
      );
  } else {
      // Verify the email and password in the database
      $user = getUserByEmail($user_email); // Retrieve the user from the database
      if(!$user || !password_verify($userPassword1, $user['user_password'])) {
        echo 'User not found or password mismatch.';
        echo 'User provided: ' . $userPassword1;
        echo 'Hashed password in DB: ' . $user['user_password'];
        $response = array(
            'status' => 'error',
            'message' => 'Invalid email or password. Please try again.'
        );
    } else {
          // Successful login
          $_SESSION['user_id'] = $user['user_id'];
          insertAuditLog($user['user_id'], 'login');
          $response = array(
              'status' => 'success',
              'message' => 'Login successful.'
          );
      }
  }

  // Output JSON response
  header('Content-Type: application/json');
  echo json_encode($response);
}



//login ng user
// if(isset($_POST['loginusr'])) {
//   $user_email = $_POST['usrEmail'];
//   $userPassword1 = $_POST['usrPassword1'];

  
//   $user_email = filter_var($user_email, FILTER_SANITIZE_EMAIL);
//   $userPassword1 = htmlspecialchars($userPassword1);

//   // form validation
//   if(empty($user_email) || empty($userPassword1)) {
//       $error = "Please enter both your email and password.";
//   }

  
//   if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
//       $error = "Please enter a valid email address.";
//   }

//   // Verify the email and password sa db
//   $user = getUserByEmail($user_email); // Retrieve the user from the database
//   if(!$user || !password_verify($userPassword1, $user['user_password'])) {
//       $error = "Invalid email or password. Please try again.";
//   }

//   // str8 to dashboard if satisfied ang needs above
//   if(!isset($error)) {
//       $_SESSION['user_id'] = $user['user_id']; 
//       insertAuditLog($user['user_id'], 'login');
//       echo "User ID set in session: " . $_SESSION['user_id'];
//       header('Location: ../pages/dashboard.php');
//       echo 'success';
//       exit;
//   }

  
//   echo $error;
// }

// 
function insertAuditLog($user_id, $action) {
  $conn = new mysqli('localhost', 'root', '', 'fitlife_db');
 
  $stmt = $conn->prepare("INSERT INTO tbl_audit (user_id, audit_action, audit_timestamp) VALUES (?, ?, NOW())");


  $stmt->bind_param("is", $user_id, $action);


  $stmt->execute();

  $stmt->close();
  $conn->close();
}




function getUserByEmail($user_email) {

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


if (isset($_POST['updateExerciseForm'])) {
  // Get the exercise details from the form submission
  $routineId = $_POST['routineId'];
  $exerciseId = $_POST['exerciseId'];
  $setsUpdate = $_POST['setsUpdate'];
  $repsUpdate = $_POST['repsUpdate'];
  $weightUpdate = $_POST['weightUpdate'];

  // Escape the values to prevent SQL injection
  $routineId = mysqli_real_escape_string($conn, $routineId);
  $exerciseId = mysqli_real_escape_string($conn, $exerciseId);
  $setsUpdate = mysqli_real_escape_string($conn, $setsUpdate);
  $repsUpdate = mysqli_real_escape_string($conn, $repsUpdate);
  $weightUpdate = mysqli_real_escape_string($conn, $weightUpdate);

  $routineIdQuery = "SELECT routine_id FROM tbl_routine_exercises WHERE exercise_id = $exerciseId";
  $routineIdResult = mysqli_query($conn, $routineIdQuery);

  if ($routineIdResult && mysqli_num_rows($routineIdResult) > 0) {
      $routineIdRow = mysqli_fetch_assoc($routineIdResult);
      $routineId = $routineIdRow['routine_id'];

      $updateQuery = "UPDATE tbl_routine_exercises SET exercise_sets = '$setsUpdate', exercise_reps = '$repsUpdate', exercise_weight = '$weightUpdate'
      WHERE routine_id = $routineId AND exercise_id = $exerciseId";

      $result = mysqli_query($conn, $updateQuery);

      if ($result) {
          $response = array("success" => true, "updatedSets" => $setsUpdate, "updatedReps" => $repsUpdate, "updatedWeight" => $weightUpdate);
          echo json_encode($response); // Send the JSON response
      } else {
          $response = array("success" => false, "error" => mysqli_error($conn));
          echo json_encode($response); // Send the JSON response
      }
  }
}




if (isset($_POST['exerciseId']) && isset($_POST['routineId'])) {
  $exerciseId = $_POST['exerciseId'];
  $routineId = $_POST['routineId'];

  // Remove exercise from routine
  $remove_exercise_query = "DELETE FROM tbl_routine_exercises WHERE exercise_id = $exerciseId AND routine_id = $routineId";
  $remove_exercise_result = mysqli_query($conn, $remove_exercise_query);

  if ($remove_exercise_result) {
      // Exercise removed successfully
      $response['success'] = true;
      $response['message'] = 'Exercise removed successfully';
  } else {
      // Error removing exercise
      $response['success'] = false;
      $response['message'] = 'Error removing exercise';
  }
} else {
  // Invalid exerciseId or routineId
  $response['success'] = false;
  $response['message'] = 'Invalid exerciseId or routineId';
}

// Return the JSON response
// echo json_encode($response);



// sa pag send ng request ni user kay coach
if (isset($_SESSION['user_id']) && isset($_POST['coachId'])) {
    $user_id = $_POST['user_id']; // Use the provided user_id
    $coach_id = $_POST['coachId'];

    

    $sql = "INSERT INTO tbl_coaching_requests (user_id, coach_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $coach_id);

    if ($stmt->execute()) {
        echo "Hiring request sent successfully.";
    } else {
        echo "Error sending hiring request.";
    }

    $stmt->close();
    $conn->close();
}
?>










