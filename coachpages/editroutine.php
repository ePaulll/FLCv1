<?php
require('../db/coachfunctions.php');
include_once '../db/dbconn.php';


// $user_id = $_GET['user_id'];
// $routine_name = $_GET['routine_name'];
// $routine_id = $_GET['routine_id'];



// $userId = $_GET['user_id'];
// $routineName = $_GET['routine_name'];
// $routineId = $_GET['routine_id'];




if (isset($_GET['routine_id'])) {
    $routineId = $_GET['routine_id'];
    // Use $routineId as needed on this page
}

if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];
    // Use $userId as needed on this page
}




$routineId = $_GET['routine_id'];
if (isset($_GET['routine_id'])) {
    mysqli_query($conn,'UPDATE tbl_routine_exercises SET exercise_sets=\''.
                                        $_GET['ex_sets'].'\',
                                        exercise_reps=\''. $_GET['ex_reps'].'\' 
                                        exercise_weight=\''. $_GET['ex_weights'].'\'
                                        WHERE routine_id='.$routineId.' 
                                        AND exercise_id=\''.$_GET['xxx']);
}

?>
<table>
<tr>
    <th>Exercise Name</th>
    <th>Exercise Sets</th>
    <th>Exercise Reps</th>
    <th>Exercise Weight</th>
    <th>Action</th>
</tr>
<?php

// $q = 'SELECT routine_id, exercise_id, exercise_sets, exercise_reps, exercise_weight FROM
// tbl_routine_exercises WHERE routine_id='.$user_id;
// //echo $q;
// $rs = mysqli_query($conn,$q);
// while ($rw = mysqli_fetch_array($rs)){

//     echo'<tr>
//         <td><input type="number" id="ex_sets'.$rw['exercise_id'].'" value="'.$rw['exercise_sets'].'" /></td>
//         <td><input type="number" id="ex_reps'.$rw['exercise_id'].'" value="'.$rw['exercise_reps'].'" /></td>
//         <td><a href="javascript:void();" onclick="savechange('.$rw['routine_id'].','.$rw['exercise_id'].')" >MODIFY</a></td>
//     </tr>';
// }

// di nagana



$q = 'SELECT re.routine_id, re.exercise_id, re.exercise_sets, re.exercise_reps, re.exercise_weight, ex.exercise_name
      FROM tbl_routine_exercises AS re
      JOIN tbl_exercises AS ex ON re.exercise_id = ex.exercise_id
      WHERE re.routine_id = ' . $userId;
$rs = mysqli_query($conn,$q);
while ($rw = mysqli_fetch_array($rs)){

    echo '<tr>
        <td>'.$rw['exercise_name'].'</td>
        <td> <input type="number" id="ex_sets'.$rw['exercise_id'].'" value="'.$rw['exercise_sets'].'" /></td>
        <td> <input type="number" id="ex_reps'.$rw['exercise_id'].'" value="'.$rw['exercise_reps'].'" /></td>
        <td><input type="number" id="ex_weights'.$rw['exercise_id'].'" value="'.$rw['exercise_weight'].'" /></td>
        <td><a href="#" onclick="saveChange('.$rw['routine_id'].','.$rw['exercise_id'].')" >Save</a></td>
    </tr>';
    
}

?>
</table>


<input type="text" value="<?php echo $userId; ?>"/>


<!-- <input type="text" value="<?php echo $routine_name; ?>"/> -->
<input type="text" value="<?php echo $routineId; ?>"/>

<button onclick="update(<?php echo $userId;?>);">UPDATE</button>

