<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME','chestionare');
 
$DB_SERVER='localhost';
$DB_USERNAME='root';
$DB_PASSWORD='';
$DB_NAME='chestionare';

/* Attempt to connect to MySQL database */
$db = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
 
// Check connection
if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}else echo ('Connected successfully');
?>