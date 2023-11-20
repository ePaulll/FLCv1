<?php
require('../db/coachfunctions.php');
include_once '../db/dbconn.php';
include_once('../db/database.php');

$routineId = $_GET['routineId'];

if(isset($_GET['idnum'])){
	mysqli_query($db_connection,'UPDATE tbl_routine_exercises SET exercise_sets=\''.
								$_GET['exercise_sets'].'\',exercise_reps=\''.
								$_GET['exercise_reps'].'\',exercise_weight=\''.
								$_GET['exercise_weight'].'\' WHERE idnum='.$_GET['idnum']);
								
	echo '<div class="alert alert-success" role="alert">
			  Updated Successfully.
			</div>';
}

if(isset($_GET['delete_me'])){
	mysqli_query($db_connection,'DELETE FROM tbl_routine_exercises WHERE idnum='.$_GET['delete_me']);
	echo'<div class="alert alert-primary" role="alert">
			  Archiving Successfully.
			</div>';
}

?>

<h5><?=RoutineName($routineId)?></h5>
<table width="100%" border="1">	
	<tr>
		<th>Primary Key</th>
		<th>Exercise Name</th>
		<th>Exercise Sets</th>
		<th>Exercise Reps</th>
		<th>Exercise Weight</th>
		<th>Action</th>
		<th>&nbsp;</th>
	</tr>
	
	<?php
	$q = 'SELECT idnum,routine_id, exercise_id,
			exercise_sets, exercise_reps, exercise_weight 
			FROM tbl_routine_exercises WHERE routine_id='.$routineId;
	//echo $q;
	$rs = mysqli_query($db_connection,$q);
	while ($rw = mysqli_fetch_array($rs)){
		echo'<tr>
			<td>'.$rw['idnum'].'</td>
			<td>'.ExerciseName($rw['exercise_id']).'</td>
			<td><input type="text" id="exercise_sets'.$rw['idnum'].'" value="'.$rw['exercise_sets'].'"/></td>
			<td><input type="text" id="exercise_reps'.$rw['idnum'].'" value="'.$rw['exercise_reps'].'"/></td>
			<td><input type="text" id="exercise_weight'.$rw['idnum'].'" value="'.$rw['exercise_weight'].'"/></td>
			<td><a href="javascript:void();" onclick="edit_routine('.$rw['idnum'].')">EDIT</a></td>
			<td><a style="color:red;" href="javascript:void();" onclick="del_routine('.$rw['idnum'].')">DEL</a></td>
		</tr>';
	}
	?>
</table><br>

