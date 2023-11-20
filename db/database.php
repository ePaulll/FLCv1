<?php


error_reporting(0);
// echo '<p style="color:black;">'.$_SERVER['REQUEST_URI'].'</p>';

$host = "localhost";
$user = "root";
$dbpass = "";
$dbname = "fitlife_db";
global $db_connection; 
$db_connection = mysqli_connect($host,$user,$dbpass) or die('Failed to connect to Database Server');
$db = mysqli_select_db($db_connection,$dbname);


function GetValue($sql_query) {error_reporting(0);
	global $db_connection;
	$result = mysqli_query($db_connection,$sql_query);
	$row = mysqli_fetch_array($result);
	return $row[0];
}


function RoutineName($id){
	return GetValue('SELECT routine_name FROM tbl_routines WHERE routine_id='.$id);
}

function ExerciseName($id){
	return GetValue('SELECT exercise_name FROM tbl_exercises WHERE exercise_id='.$id);
}


?>