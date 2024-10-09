<?php
include('C:\Users\ancyj\Desktop\resincustomisedproducts\includes\connection.php');

echo"<pre>";

print_r($_POST['img']);

echo"</pre>";

if(isset($_POST['add']))
{
$image_name = $_FILES['img']['name'];
$image_tmp_name = $_FILES['img']['tmp_name'];
$folder = 'productimages/'.$image_name;

$query = mysqli_query($con,"insert into imageupload (images) values ($image_name)");
if(move_uploaded_file($image_tmp_name,$folder)){
    echo"<h2>file uploaded</h2>";
}
else{
    echo"<h2>file not uploaded</h2>";
}
}
?>


<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>upload</title>
</head>
<body>
    <h1>upload image</h1>
    <form action="upload.php" method="POST"  entype="multipart/form-data" >
    <input class=" form-control" type="file" name="img">
    <input type="submit" class="submit check_out p-1 my-3" name="add" value="Add item">
</form>

<div>
    <?php
    $res=mysqli_query($con,"select * from productimages");
    while($row =mysqli_fetch_assoc($res)){
    
    ?>
    <img src="productimages/ <?php echo $row['images']?> "/>
    <?php
}?>
</div>
</body>
</html>