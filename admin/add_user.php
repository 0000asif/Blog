
<?php include "header.php";?>
<?php include "../connect.php"; 

if (isset($_POST["add_user"])) {
    $username=mysqli_real_escape_string($con,$_POST["user_name"]);
    $email=mysqli_real_escape_string($con,$_POST["user_email"]);
    $pass=mysqli_real_escape_string($con,sha1($_POST["password"]));
    $c_pass=mysqli_real_escape_string($con,sha1($_POST["c_password"]));
    $role=mysqli_real_escape_string($con,$_POST["role"]);
    if (strlen($username)<4 || strlen($username)>100) {
        $error= "username must be 4 to 100 charecter";
    }
    elseif (strlen($pass)<4|| strlen($c_pass)<4) {
        $error= "password must be 4 char or long";
    }
    elseif ($pass!=$c_pass) {
        $error= "Password dosenot matched";
    }
    else {
        $sql= "SELECT * FROM user WHERE email='$email'";
        $query= mysqli_query($con,$sql);
        $row=mysqli_num_rows($query);

        if ($row >=1) {
        $error= "Email already exit";
        }
        else {
            $sql2= "INSERT INTO user (username,email,password,role) VALUES ('$username','$email','$pass','$role')";
            $query2 = mysqli_query($con,$sql2);
            if ($query2) {
                $msg=['User added succesfully','alert-success'];
                $_SESSION["msg"] = $msg;
                header("location:users.php");
            }
            else{
                $error = "failed, try again later";
            }

        //$error= "user added successfuly";
        }
    }

}
?>
<div class="container">
    <div class="row">
        <div class="col-md-5 m-auto bg-info p-4">
            <?php 
            if (!empty($error)) {
                echo "<p class='bg-danger text-white p-2'>".$error."</p>";
            }
            ?>
               
                    <h6 class="text-center mb-3">Create new user </h6>
                
                    <form action="" method="POST">
                        <div class="mb-3">
                            <input type="text" name="user_name" placeholder="User Name" class="form-control" required value="<?= (!empty($error))? $username:''; ?>">
                        </div>
                        <div class="mb-3">
                            <input type="email" name="user_email" placeholder="Email" class="form-control" required  value="<?= (!empty($error))? $email:''; ?>">
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" placeholder="Password" class="form-control" required>
                        </div><div class="mb-3">
                            <input type="password" name="c_password" placeholder="Confirm Password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <select class="form-control" name="role" id="">
                                <option value="">select role</option>
                                <option value="1">Admin</option>
                                <option value="0">Co-Admin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="add_user" value="Add" class="btn btn-primary mt-6">
                            <a href="users.php" class="btn btn-secondary">Back</a>
                        </div>
                        
                    </form>
           
        </div>
    </div>
</div>

<?php include "footer.php";?>
