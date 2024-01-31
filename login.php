<?php 
include 'header.php';
include 'connect.php';
session_start();
if(isset($_SESSION["user_data"])) {
    header("location:http://localhost:3000/admin/index.php");
}
?>

<div class="container">
    <div class="row">
        <form action="" method="POST">
            <div class="col-xl-5 col-md-4 m-auto p-5 mt-5 mb-5 bg-info">
                <p class="text-center">blog! Login your account</p>
                <div class="mb-3">
                    <input type="email" name="email" placeholder="Email" class="form-control" required>
                </div>
                <div class="mb-3">
                <input type="password" name="password" placeholder="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="submit" name="login_btn" class="btn btn-primary" value="Log in">
                </div>
                <?php
                if(isset($_SESSION['error'])){
                    $error= $_SESSION['error'];
                    echo '<div class="bg-danger p-2 text-white rounded">'.$error.'</div>';
                    unset( $_SESSION['error'] );
                }
                ?>
                

            </div>            
        </form>

    </div>
</div>
<?php
if(isset($_POST['login_btn'])){
$email = mysqli_real_escape_string($con, $_POST['email']);
$password = mysqli_real_escape_string($con,sha1($_POST['password']));

$sql = "SELECT * FROM user WHERE email = '{$email}' AND password = '{$password}'";
$querry = mysqli_query($con, $sql);
$data = mysqli_num_rows($querry);
if($data){
    $result = mysqli_fetch_assoc($querry);
    $user_data = array($result['user_id'],$result['username'],$result['role'],);
    $_SESSION['user_data']=$user_data;
    header("location:admin/index.php");
}
else{
    
    $_SESSION['error'] = "Invalid email/password";
    header("location:login.php");
}
}
?>


<?php include 'footer.php';?>