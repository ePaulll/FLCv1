<?php
require_once '../db/functions.php';
session_start();

if (isset($_SESSION['user_id'])) {
 
    $user_id = $_SESSION['user_id'];
  
   
    $action = 'Logout';
    insertAuditLog($user_id, $action);
}


session_destroy();


header('Location: index.php');
exit;
?>
