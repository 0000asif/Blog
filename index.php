<?php
include 'header.php';
include 'connect.php';

// pagination
if (!isset($_GET['page'])) {
	$page=1;
}
else
{
	$page=$_GET['page'];
}
$limit=5;
$offset=($page-1)*$limit;
// -------------------

$sql= "SELECT * FROM blog LEFT JOIN catagores ON blog.category = catagores.cat_id LEFT JOIN user ON  blog.author_id= user.user_id ORDER BY blog.publish_date DESC limit $offset,$limit";

$querry= mysqli_query($con,$sql);
$row=mysqli_num_rows($querry);
?>

<div class="container mt-2">
	<div class="row">
		<div class="col-lg-8">
            <?php 
            if ($row) {
                while ($result=mysqli_fetch_assoc($querry)) {
                    
            ?>

			<div class="card shadow">
				<div class="card-body d-flex blog_flex">

					<div class="flex-part1">
						<a href="single_post.php?id=<?=$result['blog_id']?>"> 
                        <?php $img= $result['blog_image']?>    
                        <img src="admin/images/<?= $img ?>"> </a>
					</div>

					<div class="flex-grow-1 flex-part2">
						  <a href="single_post.php?id=<?=$result['blog_id']?>" id="title">
                            <?= ucfirst($result['blog_title'])?>
                        </a>
						<p>
						  <a href="single_post.php?id=<?=$result['blog_id']?>" id="body">
                          <?= substr($result['blog_body'], 0,10) ." ..."?>
						  </a> <span><br>
						  
                          <a href="single_post.php?id=<?=$result['blog_id']?>" class="btn btn-sm btn-outline-primary">Continue Reading
                          </a></span>
                        </p>
						<ul>
							<li class="me-2">
								<a href=""> 
									<span>
                                		<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									</span>
									
									<?= $result ['username'] ?>
								</a>
							</li>
							<li class="me-2">
								<a href=""> <span><i class="fa fa-calendar-o" aria-hidden="true"></i></span> <?php $date= $result['publish_date']?>
                                <?= date('d-M-Y',strtotime($date))?>
                                 </a>
							</li>
							<li>
								<a href="" class="text-primary"> <span><i class="fa fa-tag" aria-hidden="true"></i></span> <?= $result['cat_name']?> </a>
						    </li>
							
						</ul>
						
					</div>
				</div>
			</div>
			<?php } } ?>
<!-- Pagination begin -->
<?php 
		 $pagination="SELECT * FROM blog";
		 $run_q=mysqli_query($con,$pagination);
		 $total_post=mysqli_num_rows($run_q);
		 $pages=ceil($total_post/$limit);
		 if($total_post > $limit){
		?>
		<ul class="pagination pt-2 pb-5">
			<?php for ($i=1; $i <=$pages ; $i++) { ?>
			<li class="page-item <?=($i==$page) ? $active="active":"";?>">
				<a href="index.php?page=<?= $i ?>" class="page-link">
					<?= $i ?>
				</a>
			</li>
		<?php } ?>
		</ul>
	<?php } ?>
		<!-- ------------------------- -->
		</div>
        <?php include 'sidebar.php'; ?>
	</div>
</div>
<?php include 'footer.php';?>
