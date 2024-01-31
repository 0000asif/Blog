
<?php include "header.php";?>
<?php include "../connect.php"; ?>
<div class="container">
    <div class="row">
        <div class="col-xl-6 col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold text-primary mt-2">Add Catagories</h6>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <input type="text" name="cat_name" placeholder="Catagory Name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="add_cat" value="Add" class="btn btn-primary mt-6">
                            <a href="categories.php" class="btn btn-secondary">Back</a>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php";
if (isset($_POST["add_cat"])) {
    $cat_name=mysqli_real_escape_string($con,$_POST["cat_name"]);
    $sql ="SELECT * FROM catagores WHERE cat_name='{$cat_name}'";
    $querry = mysqli_query($con,$sql);
    $rows = mysqli_num_rows($querry);
    if ($rows){
        $msg=['categories name already exist','alert-danger']; 
        $_SESSION["msg"] = $msg;
        header("location:categories.php");
    }
    else {
        $sql2="INSERT INTO catagores (cat_name) VALUES ('$cat_name')";
        $querry2 = mysqli_query($con,$sql2);
        if($querry2){
            $msg=['categories has been added successfully','alert-success'];
            $_SESSION["msg"] = $msg;
            header("location:categories.php");
        }else{
            $msg=['invalid, please try again','alert-warning'];
            $_SESSION["msg"] = $msg;
            header("location:categories.php");
        }
    }
}
?>
