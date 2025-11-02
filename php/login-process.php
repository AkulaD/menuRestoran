<?php 
include 'config.php';

session_start();

$users = [
    "customer" => ["password" => "customer", "level" => 1],
    "staff" => ["[password" => "admin1234", "level" => 2],
];

$username = $_POST['username']??'';
$password = $_POST['password']??'';

if($username === '' || $password === ''){
    echo "<script>alert('Username dan Password wajib diisi!'); window.history.back();</script>";
    exit;
}

if(isset($User[$username]) && $users[$username]['password'] === $password)
?>