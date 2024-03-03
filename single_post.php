<?php 
include 'header.php';

$id=$_GET['id'];
if (empty($id)) {
    header("location:index.php");
}

$sql = "SELECT * FROM blog WHERE blog_id='$id'";
$querry=mysqli_query($con,$sql);

$result=mysqli_fetch_assoc($querry);

?>

<div class="container mt-2">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <div id="single_img">
                        
                    <?php $img= $result['blog_image']?>                    
                        <a href="admin/images/<?= $img ?>"> 
                            
                        <img alt="" src="admin/images/<?= $img ?>"> </a>
                    </div>
                    <div>
                        <h5><?= ucfirst($result['blog_title'])?></h5>
                        <p><?= ucfirst($result['blog_body'])?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'sidebar.php';?>
    </div>
</div>


<?php include 'footer.php'?>