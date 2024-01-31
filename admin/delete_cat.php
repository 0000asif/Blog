
<?php
$cat_id=$_GET["id"];
include "../connect.php";
$sql= "DELETE FROM catagores WHERE cat_id={$cat_id}";
$query = mysqli_query($con, $sql);
header("location: http://localhost:3000/admin/categories.php");
mysqli_close($con);
?>

