<?php 
  if (file_exists('db/database.php')) { include_once('db/database.php'); }
  if (file_exists('../db/database.php')) { include_once('../db/database.php'); }


include_once 'dbconn.php';

session_start();
$coach_id = $_SESSION['coach_id'];
$_SESSION['coach_id'] = $coach_id;  



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exercise_id'])) {

    $exerciseId = (int)$_POST['exercise_id'];

    
    $stmt = $conn->prepare("UPDATE tbl_exercises SET archived = 0 WHERE exercise_id = ?");
    $stmt->bind_param("i", $exerciseId);

    if ($stmt->execute()) {
        $response = array('success' => true);
    } else {
        $response = array('success' => false, 'error' => 'Failed to archive exercise');
    }


    $stmt->close();
    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}





?>