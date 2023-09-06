<?php
// $host = 'localhost';
// $user = 'root';
// $password = '';
// $dbname = 'finalcapstone';
// global $db_connection;
// global $db;
// $db_connection = mysqli_connect($host,$user,$password,$dbname) or die('Failed to connect to database server');
// $db = mysqli_select_db($db_connection,$dbname);

// if($db_connection) {

// }else {
//     die(mysqli_error($db_connection));
// }

// // QUERY MAKER

// function GetValue($sql_query) {
//     global $db_connection;
//     $result = mysqli_query($db_connection,$sql_query);
//     $row = mysqli_fetch_array($result);
//     return $row[0];
// }

// // IF Database Exist, Execute

// function isDBTableExist($dbname,$table) {
//     return GetValue("SELECT COUNT(*)
//     FROM information_schema.tables
//     WHERE table_schema = '".$dbname."'
//             AND table_name = '".$table."'
//         LIMIT 1;") + 0;
// }

// // YearLevels 1 EXAMPLE 
// if (!isDBTableExist($dbname, 'tbl_yearlevels')) {
//     $createTableQuery = "CREATE TABLE tbl_yearlevels (
//         year_level_id INT(11) AUTO_INCREMENT PRIMARY KEY,
//         year_level_name VARCHAR(255) NOT NULL)";
    
//     mysqli_query($db_connection, $createTableQuery);
// }

?>