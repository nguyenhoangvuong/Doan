<?php
    include('connect/connection.php');
	session_start();
	error_reporting(0);
	if(isset($_POST['login']))
  	{
    $masinhvien=$_POST['masinhvien'];
    $password=$_POST['password'];
    $query=mysqli_query($con,"select * from tbluser where masinhvien='$masinhvien' && matkhau='$password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      if($ret['quyen'] == 'sinhvien'){
        $_SESSION['masinhvien'] = $_POST['masinhvien'];
        $_SESSION['hoten']=$ret['hoten'];
        header('location:view/home.php');
      }else{
        $_SESSION['masinhvien'] = $_POST['masinhvien'];
        $_SESSION['hoten']=$ret['hoten'];
        header('location:view/admin/dashboard.php');
      }
    }
    else{
    	echo "<script>alert('Fail !');</script>";
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="img/wave.png">
	<div class="container">
		<div class="img">
			<img src="img/bg.svg">
		</div>
		<div class="login-content">
			<form method="post">
				<img src="img/avatar.svg">
				<h2 class="title"></h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Gmail</h5>
           		   		<input type="text" class="input" name="masinhvien">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input" name="password">
            	   </div>
            	</div>
            	<a href="#">Forgot Password?</a>
            	<input type="submit" class="btn" value="Login" name="login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
