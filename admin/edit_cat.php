<?php include "header.php";
include "../connect.php";
$cat_id = $_GET["id"];
$sql= "SELECT * FROM catagores WHERE cat_id={$cat_id}";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc( $query );

?>

<div class="container">
    <div class="row">
        <div class="col-xl-6 col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold text-primary mt-2">Edit Catagories</h6>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <input type="text" name="cat_name" value="<?= $row ['cat_name']?>" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="update_cat" value="update" class="btn btn-primary mt-6">
                            <a href="categories.php" class="btn btn-secondary">Back</a>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php";
if(isset($_POST["update_cat"])) {
    $cat_name=mysqli_real_escape_string($con,$_POST["cat_name"]);
    $sql2 = "UPDATE catagores SET cat_name='{$cat_name}' WHERE cat_id= '{$cat_id}'";
    $query2 = mysqli_query($con, $sql2);
    if($query2){
        $msg=['categories has been Updated successfully','alert-success'];
        $_SESSION["msg"] = $msg;
        header("location:categories.php");
    }else{
        $msg=['invalid, please try again','alert-warning'];
        $_SESSION["msg"] = $msg;
        header("location:categories.php");
    }
}

?>