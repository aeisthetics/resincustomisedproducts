<?php
$servername="localhost";
$email="teamadb";
$password="teamadb";
$db_name="database1";
$conn = new mysqli("$servername", "$email", "$password", "$db_name", 3306);
if($conn->connect_error){
    die("connection failed".$conn->connect_error);
}
echo " ";
?>
