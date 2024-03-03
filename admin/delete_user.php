
<?php
$user_id=$_GET["id"];
include "../connect.php";
$sql= "DELETE FROM user WHERE user_id={$user_id}";
$query = mysqli_query($con, $sql);
header("location:users.php");
mysqli_close($con);
?>