
<?php include "header.php";
if(isset($_SESSION["user_data"])) {
    $author_id= $_SESSION["user_data"][0];
}

//GET BLOG ID
$blogID= $_GET['id'];
if (empty($blogID)) {
    header("location:index.php");
}
//fetch category
$sql="SELECT * FROM catagores";
$querry= mysqli_query($con,$sql);

$sql2=" SELECT * FROM blog LEFT JOIN catagores ON blog.category=catagores.cat_id LEFT JOIN user ON blog.author_id= user.user_id WHERE blog_id='$blogID' ";
$querry2= mysqli_query($con, $sql2);
$row= mysqli_fetch_assoc($querry2);

?>
<?php include "../connect.php"; 


?>
<div class="container">
    <div class="row">
        <div class="col-xl-7 col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold text-primary mt-2">Edit blog</h6>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="text" name="blog_title" placeholder="title_Name" class="form-control" required value="<?= $row['blog_title'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">body/discription</label>
                            <textarea name="blog_body" class="form-control" id="body" rows="2"> <?= $row ['blog_body'] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="file" name="blog_image" class="form-control">
                            <img src="images/<?=$row['blog_image']?>" width="100px" class="border">
                        </div>
                         <div class="mb-3">
                            <select name="catagory" required class="form-control">
                            
                            <?php 
                            while ($cats=mysqli_fetch_assoc($querry)) { 
                                ?>
                            <option value="<?= $cats['cat_id'] ?>" <?php if($row['category']==$cats['cat_id']){?>
                                selected="selected"; <?php }?>>
                            
                            
                            <?= $cats['cat_name'] ?>
                        
                        </option>
                            
                            <?php } ?>
                            
                        </select>
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="edit_blog" value="update" class="btn btn-primary mt-6">
                            <a href="index.php" class="btn btn-secondary">Back</a>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php";
if (isset($_POST["edit_blog"])) {
    $title= mysqli_real_escape_string($con,$_POST["blog_title"]);

    $body= mysqli_real_escape_string($con,$_POST["blog_body"]);

    $category= mysqli_real_escape_string($con,$_POST["catagory"]);

    $filename= $_FILES['blog_image']['name'];

    $tmp_name= $_FILES['blog_image']['tmp_name'];

    $size= $_FILES['blog_image']['size'];

    $image_ext= pathinfo($filename,PATHINFO_EXTENSION);

    $allow_type= ['jpg','png','jpeg'];

    $location= "images/".$filename;

    if(!empty($filename)){
        if(in_array($image_ext,$allow_type)){

            if($size<=2000000){
                $unlink= "images/".$row['blog_image'];
                unlink($unlink);
                move_uploaded_file($tmp_name,$location);

                // $sql3= "UPDATE blog SET blog_title='{$title}', blog_body='{$body}',blog_image='{$filename}', category='{$catagory}',author_id='{$author_id}' WHERE bolg_id='{$blogID}'"; 
                
                // $querry3= mysqli_query($con,$sql3);


                $sql3="UPDATE blog SET blog_title='$title',blog_body='$body',blog_image='$filename',category='$category',author_id='$author_id' WHERE blog_id='$blogID'";
			$querry3=mysqli_query($con,$sql3);
                if($querry3){
    
                    $msg=['post edited succesfully','alert-success'];
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
    
    else{
        //$sql3 = "UPDATE  blog SET blog_title='{$title}', blog_body='{$body}', category='{$catagory}', author_id='{$author_id}' WHERE bolg_id='{$blogID}'";            

        $sql3="UPDATE blog SET blog_title='$title',blog_body='$body',category='$category',author_id='$author_id' WHERE blog_id='$blogID'";
        $querry3= mysqli_query($con,$sql3);
        
        if($querry3){

            $msg=['post edited succesfully','alert-success'];
            $_SESSION["msg"] = $msg;
            header("location:index.php");

        }else{

            $msg=['failed, please try again later','alert-danger']; 
            $_SESSION["msg"] = $msg;
            header("location:index.php");
        }        
    }
    
}




?>