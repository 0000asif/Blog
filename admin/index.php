<?php include 'header.php';

if(isset($_SESSION["user_data"])) {
   $userID= $_SESSION["user_data"][0];
} 
?>
               <!-- Begin Page Content -->
               <div class="container-fluid">
                  <!-- Page Heading -->
                  <h5 class="mb-2 text-gray-800">Blog Posts</h5>
                  <!-- DataTales Example -->
                  <div class="card shadow">
                     <div class="card-header py-3 d-flex justify-content-between">
                        <div>
                           <a href="add_blog.php">
                              <h6 class="font-weight-bold text-primary mt-2">Add New</h6>
                           </a>
                        </div>
                        <div>
                           <form class="navbar-search">
                              <div class="input-group">
                                 <input type="text" class="form-control bg-white border-0 small" placeholder="Search for...">
                                 <div class="input-group-append">
                                    <button class="btn btn-primary" type="button"> <i class="fa fa-search fa-sm"></i> </button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="card-body">
                        <div class="table-responsive">
                           <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                              <thead>
                                 <tr>
                                    <th>Sr.No</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Author</th>
                                    <th>Date</th>
                                    <th colspan="2">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 
                                 $sql=" SELECT * FROM blog LEFT JOIN catagores ON blog.category=catagores.cat_id LEFT JOIN user ON blog.author_id= user.user_id WHERE user_id='$userID' ORDER  BY blog.publish_date DESC";

                                 $querry= mysqli_query($con, $sql);
                                 $rows= mysqli_num_rows($querry);
                                 $count=0;
                                 if ($rows) {
                                    while ($row = mysqli_fetch_assoc($querry)) { ?>
                                    <tr> 
                                       <th><?= ++$count?></th>
                                       <th><?= $row ['blog_title']?></th>
                                       <th><?= $row ['cat_name']?></th>
                                       <th><?= $row ['username']?></th>
                                       <th><?= date('d.m.Y',strtotime($row['publish_date']))?></th>
                                       <th>
                                             <a href="edit_blog.php?id=<?= $row ['blog_id']?>" class="btn btn-danger btn-sm">Edit</a>
                                             <a href="delete_blog.php?id=<?= $row ['blog_id']?>" class="btn btn-primary btn-sm">Delete</a>
                                          </th>
                                       
                                    </tr>
                                    
                                    <?php }
                                 }
                                 ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- /.container-fluid -->
            </div>
<?php include 'footer.php';?>
