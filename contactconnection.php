<?php 
$name=$_POST['name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$address=$_POST['address'];

//database connection
$conn= new mysqli('localhost','root','','aeisthetics');
if($conn->connect_error)
{
    die('Connection failed:'.$conn->connect_error);
}
else{
    $stmt=$conn->prepare("insert into contact(name,email,phone,address) values(?,?,?,?)");
    $stmt->bind_param("ssss",$name,$email,$phone,$address);
    $stmt->execute();
    header("Location: payment.php");
    $stmt->close();
    $conn->close();
}
?>