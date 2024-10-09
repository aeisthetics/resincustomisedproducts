<?php 
$email=$_POST['email'];
$password=$_POST['password'];


//database connection
$conn= new mysqli('localhost','root','','test');
if($conn->connect_error)
{
    die('Connection failed:'.$conn->connect_error);
}
else{
    $stmt=$conn->prepare("insert into registration(email,password) values(?,?)");
    $stmt->bind_param("ss",$email,$password);
    $stmt->execute();
    header("Location: ../index.html");
    $stmt->close();
    $conn->close();
}
?>  



