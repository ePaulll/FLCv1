<?php
require_once '../db/functions.php';
session_start();

if (isset($_SESSION['coach_id'])) {
 
    $coach_id = $_SESSION['coach_id'];
  
   
    $action = 'Logout';
    insertAuditLog($coach_id, $action);
}


session_destroy();


header('Location: coachlogin.php');
exit;
?>
