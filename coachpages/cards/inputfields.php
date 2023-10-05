<?php
error_reporting(0);
require('../../db/coachfunctions.php');
require_once '../../db/dbconn.php';

$exercise_id = $_GET['exercise_id'];


if (isset($_GET['x'])){
    mysqli_query($conn,'INSERT INTO tbl_routine_exercises (exercise_id,routine_id,exercise_sets)
                VALUES (\''.$_GET['x'].'\',\''.$_GET['routine_id'].'\',
                        \''.$_GET['set_number'].'\')');
}

?>



    <?php
    echo '<select id="routine_id">';
    echo'<option value="0" selected>SELECT ROUTINE</option>';
    $rs = mysqli_query($conn,'SELECT routine_id, routine_name FROM tbl_routines');
        while ($rw = mysqli_fetch_array($rs)) { $sel = '';

            echo'<option value="'.$rw['routine_id'].'">'.$rw['routine_name'].'</option>';
        }
        echo '</select>';
    ?>
    


<input type="text" id="set_number"/>
<input type="text" id="set_number"/>
<input type="text" id="set_number"/>
<button onclick="add_exercise(<?=$exercise_id?>)">ADD</button>