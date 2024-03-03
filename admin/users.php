<?php include 'header.php';

if ($admin!=1) {
   header("location:index.php");
}
?>
               <!-- Begin Page Content -->
               <div class="container-fluid">

               
                  <!-- Page Heading -->
                  <h5 class="mb-2 text-gray-800">Blog Users</h5>
                  <!-- DataTales Example -->
                  <div class="card shadow">
                     <div class="card-header py-3 d-flex justify-content-between">
                        <div>
                           <a href="add_user.php">
                              <h6 class="font-weight-bold text-primary mt-2">Create User</h6>
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
                                    <th>Sl.No</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>role</th>
                                    <th colspan="2">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql= "SELECT *FROM user";
                                 $query = mysqli_query($con, $sql);
                                 $rows = mysqli_num_rows($query);
                                 $count = 0;
                                 if($rows){
                                    while($row = mysqli_fetch_assoc($query)){
                                       ?>
                                       <tr>
                                          <th><?= ++$count?></th>
                                          <th><?= $row ['username']?></th>
                                          <th><?= $row ['email']?></th>
                                          <th><?php 
                                          $role= $row ['role'];
                                          if ($role==1) {
                                             echo "Admin";
                                          }
                                          else {
                                             echo "Co-Admin";
                                          }
                                          ?>
                                          </th>
                                          <th>
                                             <a href="edit_user.php?id=<?= $row ['user_id']?>" class="btn btn-danger btn-sm">Edit</a>
                                             <a href="delete_user.php?id=<?= $row ['user_id']?>" class="btn btn-primary btn-sm">Delete</a>
                                          </th>
                                       </tr>
                                    <?php
                                    }
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
