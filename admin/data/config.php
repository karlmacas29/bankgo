<?php
session_start();

$server="localhost";
$username="root";
$password="";
$db = "group19_amsbp";

$con = new mysqli($server, $username, $password, $db);

if($con->connect_error){
	echo "Connnection Error";
    die();
}

?>