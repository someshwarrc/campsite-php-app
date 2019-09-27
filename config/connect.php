<?php

$db_password = 'NhW5XECAjbmV1GOG';
$db_name = 'campfind';
$db_username = 'dev-rc';
$db_address =   'localhost';

//connecting to the database with mysqli
$connection = mysqli_connect($db_address, $db_username, $db_password, $db_name);

//check connection
if(!$connection){
    echo 'connection error' . mysqli_connect_error();
}
 
?>