<?php include 'connect.php';
$select= "SELECT * FROM catagores";
$querry= mysqli_query($con,$select);


$select2= "SELECT * FROM blog ORDER BY publish_date limit 5";
$querry2= mysqli_query($con,$select2);

?>
<div class="col-lg-4">
			<div class="card">
				<div class="card-body d-flex right-section">
					<div id="categories">
						<h6>Categories</h6>
						<ul>
						<?php while ($cats=mysqli_fetch_assoc($querry)) {
						?>
							<li>
								<a href="" class="text-success fw-bold"><?= $cats['cat_name'] ?></a>
							</li>
							
						<?php } ?>
						</ul>

					</div>
				    <div id="posts">
						<h6>Recent Posts</h6>
						<ul>
						<?php while ($cats=mysqli_fetch_assoc($querry2)) {
						?>
							<li>
								<a href="single_post.php?id=<?= $cats ['blog_id']?>" class="text-success fw-bold"><?= $cats['blog_title'] ?></a>
							</li>
							
						<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>