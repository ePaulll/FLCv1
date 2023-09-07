<?php
$servername = "localhost"; 
$username = "root";
$password = ""; 
$dbname = "fitlife_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);
global $conn ;
global $db;
$conn  = mysqli_connect($host,$user,$password,$dbname) or die('Failed to connect to database server');
$db = mysqli_select_db($conn,$dbname);



// QUERY MAKER

function GetValue($sql_query) {
    global $conn ;
    $result = mysqli_query($conn,$sql_query);
    $row = mysqli_fetch_array($result);
    return $row[0];
}

// IF Database Exist, Execute

function isDBTableExist($dbname,$table) {
    return GetValue("SELECT COUNT(*)
    FROM information_schema.tables
    WHERE table_schema = '".$dbname."'
            AND table_name = '".$table."'
        LIMIT 1;") + 0;
}


if (!isDBTableExist($dbname, 'tbl_users')) {
        $createTableQuery = "CREATE TABLE tbl_users (
            user_id INT PRIMARY KEY AUTO_INCREMENT,
            user_name VARCHAR(255) NOT NULL,
            user_email VARCHAR(255) NOT NULL,
            user_password VARCHAR(255) NOT NULL,
            user_bodyweight FLOAT NOT NULL,
            user_height FLOAT NOT NULL,
            user_age INT NOT NULL,
            user_gender VARCHAR(10) NOT NULL,
            coach_id INT,
            FOREIGN KEY (coach_id) REFERENCES tbl_coach(coach_id)
          )";
          
    
    mysqli_query($conn , $createTableQuery);
}



if (!isDBTableExist($dbname, 'tbl_routines')) {
    $createTableQuery = "CREATE TABLE tbl_routines (
        routine_id INT PRIMARY KEY AUTO_INCREMENT,
        user_id INT,
        coach_id INT,
        routine_name VARCHAR(255) NOT NULL,
        FOREIGN KEY (user_id) REFERENCES tbl_users(user_id),
        FOREIGN KEY (coach_id) REFERENCES tbl_coach(coach_id)
      )";
      
      

mysqli_query($conn, $createTableQuery);
}



if (!isDBTableExist($dbname, 'tbl_routine_exercises')) {
    $createTableQuery = "CREATE TABLE tbl_routine_exercises (
        routine_id INT,
        exercise_id INT,
        exercise_sets INT NOT NULL,
        exercise_reps INT NOT NULL,
        exercise_weight FLOAT NOT NULL,
        FOREIGN KEY (routine_id) REFERENCES tbl_routines(routine_id),
        FOREIGN KEY (exercise_id) REFERENCES tbl_exercises(exercise_id)
      )";
      

mysqli_query($conn , $createTableQuery);
}



if (!isDBTableExist($dbname, 'tbl_exercises')) {
    $createTableQuery = "CREATE TABLE tbl_exercises (
        exercise_id INT PRIMARY KEY AUTO_INCREMENT,
        exercise_name VARCHAR(255) NOT NULL,
        exercise_description TEXT NOT NULL,
        body_part_id INT NOT NULL,
        FOREIGN KEY (body_part_id) REFERENCES tbl_bodyparts(body_part_id)
      )";
      
      

mysqli_query($conn , $createTableQuery);
}


if (!isDBTableExist($dbname, 'tbl_bodyparts')) {
    $createTableQuery = "CREATE TABLE tbl_bodyparts (
        body_part_id INT PRIMARY KEY AUTO_INCREMENT,
        body_part_name VARCHAR(255) NOT NULL
      )";
      
      

mysqli_query($conn , $createTableQuery);
}


if (!isDBTableExist($dbname, 'tbl_progress')) {
    $createTableQuery = "CREATE TABLE tbl_progress (
        progress_id INT PRIMARY KEY AUTO_INCREMENT,
        user_id INT,
        routine_id INT,
        exercise_id INT,
        cur_date DATE NOT NULL,
        cur_exercise_weight FLOAT NOT NULL,
        coach_id INT,
        FOREIGN KEY (user_id) REFERENCES tbl_users(user_id),
        FOREIGN KEY (routine_id) REFERENCES tbl_routines(routine_id),
        FOREIGN KEY (exercise_id) REFERENCES tbl_exercises(exercise_id),
        FOREIGN KEY (coach_id) REFERENCES tbl_coach(coach_id)
      )";
    
      

mysqli_query($conn , $createTableQuery);
}



if (!isDBTableExist($dbname, 'tbl_bodyparts')) {
    $createTableQuery = "CREATE TABLE tbl_bodyparts (
        body_part_id INT PRIMARY KEY AUTO_INCREMENT,
        body_part_name VARCHAR(255) NOT NULL
      )";
      
      

mysqli_query($conn , $createTableQuery);
}


if (!isDBTableExist($dbname, 'tbl_coach')) {
    $createTableQuery = "CREATE TABLE tbl_coach (
        coach_id INT PRIMARY KEY AUTO_INCREMENT,
        coach_name VARCHAR(255) NOT NULL,
        coach_email VARCHAR(255) NOT NULL,
        coach_password VARCHAR(255) NOT NULL
      )";
     
      
      

mysqli_query($conn , $createTableQuery);
}



if (!isDBTableExist($dbname, 'tbl_coaching_requests')) {
    $createTableQuery = "CREATE TABLE tbl_coaching_requests 
    ( request_id INT AUTO_INCREMENT PRIMARY KEY, user_id INT, coach_id INT, status ENUM
    ('pending', 'accepted', 'rejected') DEFAULT 'pending', created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES tbl_users(user_id), FOREIGN KEY (coach_id) REFERENCES tbl_coach(coach_id) )";
     
      
      

mysqli_query($conn , $createTableQuery);
}





?>