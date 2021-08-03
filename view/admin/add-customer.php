<?php
	session_start();
	error_reporting(0);
	include('includes/dbconnection.php');
	if (strlen($_SESSION['bpmsaid']==0)) {
	header('location:logout.php');
	} else{
	if(isset($_POST['submit']))
	{
		$name=$_POST['name'];
		$email=$_POST['email'];
		$mobilenum=$_POST['mobilenum'];
		$gender=$_POST['gender'];
		$details=$_POST['details'];
		$query=mysqli_query($con, "insert into  tblkhachhang(Ten,Email,Sodienthoai,Gioitinh,Chitiet) value('$name','$email','$mobilenum','$gender','$details')");
		if ($query) {
			echo "<script>alert('Khách hàng đã được thêm.');</script>"; 
			echo "<script>window.location.href = 'add-customer.php'</script>"; 
		} else {
			echo "<script>alert('Đã xảy ra lỗi. Vui lòng thử lại');</script>";  	
		} 
	}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>SPA | Thêm khách hàng</title>
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/font-awesome.css" rel="stylesheet"> 
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/modernizr.custom.js"></script>
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
	<script src="js/wow.min.js"></script>
		<script>
			new WOW().init();
		</script>
	<script src="js/metisMenu.min.js"></script>
	<script src="js/custom.js"></script>
	<link href="css/custom.css" rel="stylesheet">
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
		 <?php include_once('includes/sidebar.php');?>
	 <?php include_once('includes/header.php');?>
		<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						<div class="form-title">
							<h4>Thêm Khách hàng:</h4>
						</div>
						<div class="form-body">
							<form method="post">
								<p style="font-size:16px; color:red" align="center"> 
								<?php if($msg){
									echo $msg;
								}  ?> </p>
							 <div class="form-group"> <label for="exampleInputEmail1">Tên</label> <input type="text" class="form-control" id="name" name="name" placeholder="Tên" value="" required="true"> </div> <div class="form-group"> 
							 <label for="exampleInputPassword1">Email</label> <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="" required="true"> </div>
							 <div class="form-group"> <label for="exampleInputEmail1">Số điện thoại</label> <input type="text" class="form-control" id="mobilenum" name="mobilenum" placeholder="Số điện thoại" value="" required="true" maxlength="10" pattern="[0-9]+"> </div>
							 <div class="radio">

                               <p style="padding-top: 20px; font-size: 15px"> <strong>Giới tính:</strong> <label>
                                    <input type="radio" name="gender" id="gender" value="Female" checked="true">
                                    Nữ
                                </label>
                                <label>
                                    <input type="radio" name="gender" id="gender" value="Male">
                                    Nam
                                </label>
                                <label>
                                    <input type="radio" name="gender" id="gender" value="Transgender">
                                   Chuyển giới
                                </label></p>
                            </div>
							 	<div class="form-group"> <label for="exampleInputEmail1">Chi tiết</label> <textarea type="text" class="form-control" id="details" name="details" placeholder="Chi tiết" required="true" rows="12" cols="4"></textarea> </div>
							  	<button type="submit" name="submit" class="btn btn-default">Thêm</button>  <a href="customer-list.php" class="btn btn-default">Trở lại</a> </form> 
								  
						</div>
					</div>
			</div>
		</div>
		 <?php include_once('includes/footer.php');?>
	</div>
		<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
   <script src="js/bootstrap.js"> </script>
</body>
</html>
<?php } ?>