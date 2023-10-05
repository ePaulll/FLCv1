<?php

error_reporting(0);
require('../../db/coachfunctions.php');
require_once '../../db/dbconn.php';

//na conflit sa exercise_id kaya ginawa kong e_id
$exercise_id = $_GET['exercise_id'];
$user_id = $_GET['user_id'];
//dahil kasi dito sa exercise_id sa taas
//routine_id, exercise_id, exercise_sets, exercise_reps, exercise_weight
if (isset($_GET['e_id'])){
    mysqli_query($conn,'INSERT INTO tbl_routine_exercises SET exercise_id=\''.
                                        $_GET['e_id'].'\',routine_id=\''.
                                        $_GET['routine_id'].'\',exercise_sets=\''.
                                        $_GET['exercise_sets'].'\',exercise_reps=\''.
                                        $_GET['exercise_reps'].'\',exercise_weight=\''.
                                        $_GET['exercise_weight'].'\' ');
    echo '';
}

?>



    <?php
//subukan mo
    //EJ number lang ba ang pwedeng iinput ng user sa mga text field nayan? oo
//tawag sa ginagawa natin, debug
    $q = 'SELECT routine_id, routine_name FROM tbl_routines WHERE user_id='.$user_id;
    //echo $q;
    echo '<select id="routine_id">';
    echo'<option value="0" selected>SELECT ROUTINE</option>';
    $rs = mysqli_query($conn,$q);
        while ($rw = mysqli_fetch_array($rs)) { $sel = '';

            echo'<option value="'.$rw['routine_id'].'">'.$rw['routine_name'].'</option>';
        }
        echo '</select>';
    ?>
    


<input type="number" id="exercise_sets"/>
<input type="number" id="exercise_reps"/>
<input type="number" id="exercise_weight"/>
<button onclick="add_exercise(<?=$exercise_id?>)">ADD</button>