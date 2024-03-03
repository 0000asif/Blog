
<?php
$blog_id=$_GET["id"];

include "../connect.php";

$sql2= "SELECT * FROM blog WHERE blog_id={$blog_id}";
$result=mysqli_query($con,$sql2);
$row = mysqli_fetch_assoc($result);

unlink("images/".$row ['blog_image']);

$sql= "DELETE FROM blog WHERE blog_id={$blog_id}";
$query = mysqli_query($con, $sql);

header("location: http://localhost:3000/admin/index.php");

mysqli_close($con);
?>

