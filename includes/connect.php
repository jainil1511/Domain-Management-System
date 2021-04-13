<?php
$servername  = "localhost";
$username = "justchec_dmanage2020";
$password = "jainil@123";
$database = "justchec_dmanage";

$con = mysqli_connect($servername,$username,$password,$database);

if(!$con){
	die("Connection Failed:".mysqli_connect_error());
}
?>