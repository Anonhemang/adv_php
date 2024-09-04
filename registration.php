<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        .all {
            width: 100%;
        }

        .box {
            width: 30%;
            padding: 3%;
            display: grid;
            margin: 5% auto;
            border: 2px solid lightgrey;
        }

        .inp {
            font-size: large;
            padding: 2% 1%;
            margin: 3% auto;
            width: 100%;
        }
    </style>
</head>

<body>
    <?php
    include('header.php')
        ?>
    <div class="all">

        <div class="box">
            <form method="post">
                <center>
                    <h3 class="fw-normal">Register</h3>
                </center>
                <input type="text" name="uname" class="inp" placeholder="Username" required>
                <input type="password" name="pass" class="inp" placeholder="Password" required>
                <center><input type="submit" value="Create Account" name="sub" class="btn btn-success mt-2" style="width:40%">
                </center>
            </form>

            <!-- <a href="forgetpass.php" class="text-decoration-none text-primary mt-3">Forget Password?</a> -->
            <a href="login.php" class="text-decoration-none text-dark mt-2">Already Have an Account?</a>
        </div>



    </div>
</body>

</html>

<?php 
include('conn.php');
require_once 'func.php';
$function = new func($conn);
if(isset($_POST['sub'])){
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $pas = md5($pass);
    $function->registernewuser($uname, $pas);
   
}
?>