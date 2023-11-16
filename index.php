<?php
$error="";
$success="";
$date=date('y-m-d');
date_default_timezone_set('Africa/Nairobi');
 session_start();
 chdir('./files');
 $file="index";
 $url="?ref=dashboard&new=rooms";
if(isset($_GET['ref'])) $file=$_GET['ref'];
$file="dashboard";
if(!count($_GET)) {
    header("location: $url");
 }
require './assets/connection.php';
require './assets/header.php';
require "./$file.php";
require './assets/footer.php';

?>