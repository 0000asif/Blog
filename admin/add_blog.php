
<?php include "header.php";
if(isset($_SESSION["user_data"])) {
    $author_id= $_SESSION["user_data"][2];
}

$sql="SELECT * FROM catagores";
$querry= mysqli_query($con,$sql);

?>
<?php include "../connect.php"; ?>
<div class="container">
    <div class="row">
        <div class="col-xl-7 col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold text-primary mt-2">Published blog</h6>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="text" name="blog_title" placeholder="title_Name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="">body/discription</label>
                            <textarea name="blog_body" class="form-control" id="body" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="file" name="blog_image" class="form-control" required >
                        </div>
                         <div class="mb-3">
                            <select name="catagory" required class="form-control">
                                <option value="">Select Catagories</option>
                                <?php while ($cats=mysqli_fetch_assoc($querry)) { ?>
                                <option value="<?= $cats['cat_id'] ?>"><?= $cats['cat_name'] ?></option>
                                <?php }?>
                                
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="add_blog" value="Add" class="btn btn-primary mt-6">
                            <a href="index.php" class="btn btn-secondary">Back</a>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; 
if (isset($_POST["add_blog"])) {
    $title= mysqli_real_escape_string($con,$_POST["blog_title"]);

    $body= mysqli_real_escape_string($con,$_POST["blog_body"]);

    $catagory= mysqli_real_escape_string($con,$_POST["catagory"]);

    $filename= $_FILES['blog_image']['name'];

    $tmp_name= $_FILES['blog_image']['tmp_name'];

    $size= $_FILES['blog_image']['size'];

    $image_ext= pathinfo($filename,PATHINFO_EXTENSION);

    $allow_type= ['jpg','png','jpeg'];

    $location= "images/";

    if(in_array($image_ext,$allow_type)){

        if($size<=2000000){

            move_uploaded_file($tmp_name,$location.$filename);
            $sql2 = "INSERT INTO blog(blog_title, blog_body, blog_image,category, author_id) VALUES ('$title','$body','$filename','$catagory','$author_id')";            
            $querry2= mysqli_query($con,$sql2);

            if($querry2){

                $msg=['post published succesfully','alert-success'];
                $_SESSION["msg"] = $msg;
                header("location:index.php");

            }else{

                $msg=['failed, please try again','alert-danger']; 
                $_SESSION["msg"] = $msg;
                header("location:index.php");
            }
        }else{
            echo"image size must be less than 2MB";
        }
    }else{
        echo"file type not allow, [ only 'jpg','png','jpeg']";
    }
    
}

?>
