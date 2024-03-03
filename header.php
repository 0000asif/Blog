<?php $page = basename($_SERVER['PHP_SELF'], ".php"); 
include 'connect.php';
$select= "SELECT * FROM catagores";
$querry= mysqli_query($con,$select);

include 'connect.php';

$sql= "SELECT * FROM catagores";

$querry= mysqli_query($con,$sql);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
      .nav-link {
        text-transform: uppercase;
      }
    </style>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-light sticky-top navbar-light p-3 shadow-sm">
  <div class="container">
    <a class="navbar-brand h1 mb-0 text-uppercase" href="index.php">Blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor04" aria-controls="navbarColor04" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor04">


      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link mx-2 <?= ($page=="index")? 'active':'' ?>" href="index.php">Home
            <span class="visually-hidden">(current)</span>
          </a>
        </li>

        <?php while ($cats=mysqli_fetch_assoc($querry)) {
						?>
        <li class="nav-item">
          <a class="nav-link mx-2" href="category.php?id=<?= $cats ['cat_id'] ?>">
          <?= $cats ['cat_name'] ?>
        </a>
        </li>
        <?php } ?>
        <!-- <li class="nav-item">
          <a class="nav-link mx-2" href="#">java</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2" href="#">Wordpress</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2" href="#">c++</a>
        </li>
 -->


        
        <li class="nav-item">

        <a class="nav-link mx-2 <?= ($page=="login")? 'active':'' ?>" href="login.php">Log in</a>
        </li>
        
      </ul>

      <?php 
       if (isset($_GET['keyword'])) {
         $keyword=$_GET['keyword'];
       }
       else
       {
        $keyword="";
       }
      ?>
      <form class="d-flex" action="search.php" method="GET">
              <input class="form-control me-sm-2" type="text" placeholder="Search" name="keyword" required maxlength="70" autocomplete="off" value="<?= $keyword ?>">
              <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form>


      <!-- <form class="d-flex mx-2">
        <input class="form-control me-sm-2" type="search" placeholder="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form> -->
    </div>
    

  </div>


</nav>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>