<?php
session_start();
error_reporting(0);

include('includes/dbconnection.php');

if(isset($_POST['login']))
  {
    $adminuser=$_POST['username'];
    $password=md5($_POST['password']);
    $query=mysqli_query($con,"select ID from tbladmin where  Taikhoan='$adminuser' && Matkhau='$password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['bpmsaid']=$ret['ID'];
      header('location:dashboard.php');
    }
    else{
    	$msg="Không hợp lệ ! Vui lòng kiểm tra lại .";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Dăng nhập</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="description" content="codedthemes">
	<meta name="keywords"
		  content=", Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
	<meta name="author" content="codedthemes">
	<link rel="shortcut icon" href="assets1/images/favicon.png" type="image/x-icon">
	<link rel="icon" href="assets1/images/favicon.ico" type="image/x-icon">
   <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700" rel="stylesheet">
	<link href="assets1/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="assets1/icon/icofont/css/icofont.css">
    <link rel="stylesheet" type="text/css" href="assets1/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets1/plugins/Waves/waves.min.css">
	<link rel="stylesheet" type="text/css" href="assets1/css/main.css">
	<link rel="stylesheet" type="text/css" href="assets1/css/responsive.css">
	<link rel="stylesheet" type="text/css" href="assets1/css/color/color-1.min.css" id="color"/>
</head>
<body>
<section class="login p-fixed d-flex text-center bg-primary common-img-bg">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="login-card card-block">
					<form class="md-float-material" method="post">
						<div class="text-center">
							<img src="assets1/images/avatar-1.png" alt="logo">
						</div>
						<h3 class="text-center txt-primary">
							SIGN IN YOUR ACCOUNT
						</h3>
						<p style="font-size:16px; color:red" align="center">
                                <?php 
									if($msg){
										echo $msg;
									}  
								?>
                            </p>
						<div class="row">
							<div class="col-md-12">
								<div class="md-input-wrapper">
									<input type="text" class="md-form-control" name="username" required="required">
									<label>Username</label>
								</div>
							</div>
							<div class="col-md-12">
								<div class="md-input-wrapper">
									<input type="password" name="password" class="md-form-control" required="required">	
									<label>Password</label>
								</div>
							</div>
							<div class="col-sm-6 col-xs-12">
							<div>
							</div>
								</div>
							<div class="col-sm-6 col-xs-12 forgot-phone text-right"  style="margin-bottom:8px">
								<a href="forgot-password.php" class="text-right f-w-600"> Forget Password?</a>
								</div>
						</div>
						<div class="row">
							<div class="col-xs-10 offset-xs-1">
								<button name="login" type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">LOGIN</button>
							</div>
						</div>
					
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<script src="assets1/plugins/jquery/dist/jquery.min.js"></script>
<script src="assets1/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="assets1/plugins/tether/dist/js/tether.min.js"></script>
<script src="assets1/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="assets1/plugins/Waves/waves.min.js"></script>
<script type="text/javascript" src="assets1/pages/elements.js"></script>
</body>
</html>
