<?php
require_once '../db/functions.php';
session_start();

if (isset($_SESSION['admin_id'])) {
 
    $coach_id = $_SESSION['admin_id'];
  
   
    $action = 'Logout';
    insertAuditLog($admin_id, $action);
}


session_destroy();


header('Location: adminlogin.php');
exit;
?>
