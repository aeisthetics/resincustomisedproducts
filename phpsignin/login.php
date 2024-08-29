<?php
include("connection.php");
if(isset($_POST['submit'])){
$username = $_POST['user'];
$password = $_POST['pass']; 
$sql = "select * from login where email='$email' and password='$password'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$count=mysqli_num_rows($result);
if($count==1)
{
    header("Location:index.php");
}
else{
    echo '<script>
    window.location.href="signin.php";
    alert("Login failed. Invalid username or password")
    </script>';
}
}
?>