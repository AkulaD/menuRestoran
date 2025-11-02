<?php 
$host = "localhost";
$username = "root";
$password = "";
$dbname = "menurestoran";

$con = mysqli_connect($host, $username, $password, $dbname);

if(!$con){
    die("Connection Failed:" . mysqli_connect_error());
}

$version_info = "beta"
?>