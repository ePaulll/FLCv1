<?php

if (file_exists('db/database.php')) { include_once('db/database.php'); }
if (file_exists('../db/database.php')) { include_once('../db/database.php'); }

//routine_id, user_id, coach_id, routine_name

if(isset($_GET['archive_id'])){
	mysqli_query($db_connection,'INSERT INTO tbl_routine_archive (routine_id,user_id,coach_id,routine_name)
			SELECT routine_id, user_id, coach_id, routine_name FROM tbl_routines 
			WHERE routine_id='.$_GET['archive_id']);

	mysqli_query($db_connection,'UPDATE tbl_routines SET is_archive=1 WHERE routine_id='.$_GET['archive_id']); 
	echo '<span style="color:green;">Archived</span>';
}

?>
