<?php
session_start();
error_reporting(0);
include('../includes/dbconnection.php');

if(isset($_POST['submit']))
  {
    $emailordienthoai=$_POST['emailordienthoai'];
    $query=mysqli_query($con,"select Id from tbladmin where  Email='$emailordienthoai' or Sodienthoai='$emailordienthoai'");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['contactno']=$contactno;
      $_SESSION['email']=$email;
      header('location:reset-password.php');
    }
    else{
      $msg="Không chính xác. Vui lòng nhập lại !";
    }
  }
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Spa - khôi phục mật khẩu</title>
	<!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="description" content="codedthemes">
	<meta name="keywords"
		  content=", Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
	<meta name="author" content="codedthemes">

	<!-- Favicon icon -->
	<link rel="shortcut icon" href="assets1/images/favicon.png" type="image/x-icon">
	<link rel="icon" href="assets1/images/favicon.ico" type="image/x-icon">

	<!-- Google font-->
   <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700" rel="stylesheet">

	<!-- iconfont -->
	<link rel="stylesheet" type="text/css" href="assets1/icon/icofont/css/icofont.css">

    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="assets1/plugins/bootstrap/css/bootstrap.min.css">

	<!-- waves css -->
	<link rel="stylesheet" type="text/css" href="assets1/plugins/Waves/waves.min.css">

	<!-- Style.css -->
	<link rel="stylesheet" type="text/css" href="assets1/css/main.css">

	<!-- Responsive.css-->
	<link rel="stylesheet" type="text/css" href="assets1/css/responsive.css">
	<!--color css-->
	<link rel="stylesheet" type="text/css" href="assets1/css/color/color-1.min.css" id="color"/>

</head>
<body>

	<section class="login p-fixed d-flex text-center bg-primary common-img-bg">
		<div class="container-fluid">
			<div class="row">
				   <div class="col-xs-12">
						<div class="login-card card-block">
							<form class="md-float-material" method="post" action="">
								<div class="text-center">
									<img src="assets1/images/favicon.png" alt="logo">
								</div>
								<h3 class="text-primary text-center m-b-25">KHÔI PHỤC MẬT KHẨU</h3>
								<p style="font-size:12px; color:red;margin-bottom:10px;margin-top:-10px" align="center">
									<?php 
										if($msg){
											echo $msg;
										}  
									?>
								</p>
								<div class="md-group">
									<div class="md-input-wrapper">
										<input type="text" class="md-form-control" name="emailordienthoai" />
										<label>Email hoặc số điện thoại</label>
									</div>
								</div>
						<div class="btn-forgot">
							<button type="submit" name="submit" class="btn btn-primary btn-md waves-effect waves-light text-center">GỬI YÊU CẦU
							</button>
						</div>
								<div class="row">
									<div class="col-xs-12 text-center m-t-25">

										<a href="index.php" class="f-w-600 p-l-5"> Dăng nhập tại đây</a>

									</div>
								</div>
					</form>
					<!-- end of form -->
				</div>
				<!-- end of login-card -->
			</div>
			<!-- end of col-sm-12 -->
		</div>
		<!-- end of row -->
	</div>
	<!-- end of container-fluid -->
</section>
<!-- Warning Section Starts -->
<!-- Older IE warning message -->
<!--[if lt IE 9]>
<div class="ie-warning">
	<h1>Warning!!</h1>
	<p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
	<div class="iew-container">
		<ul class="iew-download">
			<li>
				<a href="http://www.google.com/chrome/">
					<img src="assets1/images/browser/chrome.png" alt="Chrome">
					<div>Chrome</div>
				</a>
			</li>
			<li>
				<a href="https://www.mozilla.org/en-US/firefox/new/">
					<img src="assets1/images/browser/firefox.png" alt="Firefox">
					<div>Firefox</div>
				</a>
			</li>
			<li>
				<a href="http://www.opera.com">
					<img src="assets1/images/browser/opera.png" alt="Opera">
					<div>Opera</div>
				</a>
			</li>
			<li>
				<a href="https://www.apple.com/safari/">
					<img src="assets1/images/browser/safari.png" alt="Safari">
					<div>Safari</div>
				</a>
			</li>
			<li>
				<a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
					<img src="assets1/images/browser/ie.png" alt="">
					<div>IE (9 & above)</div>
				</a>
			</li>
		</ul>
	</div>
	<p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<!-- Warning Section Ends -->

<script src="assets1/plugins/jquery/dist/jquery.min.js"></script>
<script src="assets1/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="assets1/plugins/tether/dist/js/tether.min.js"></script>

<!-- Required Fremwork -->
<script src="assets1/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- waves effects.js -->
<script src="assets1/plugins/Waves/waves.min.js"></script>

<!-- Custom js -->
<script type="text/javascript" src="assets1/pages/elements.js"></script>

</body>
</html>