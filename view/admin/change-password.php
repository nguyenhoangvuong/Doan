<?php
	session_start();
	include('includes/dbconnection.php');
	error_reporting(0);
	if (strlen($_SESSION['bpmsaid']==0)) {
	header('location:logout.php');
	} 
	else{
		if(isset($_POST['submit']))
		{
			$adminid=$_SESSION['bpmsaid'];
			$cpassword=md5($_POST['currentpassword']);
			$newpassword=md5($_POST['newpassword']);
			$query=mysqli_query($con,"select ID from tbladmin where ID='$adminid' and Matkhau='$cpassword'");
			$row=mysqli_fetch_array($query);
			if($row>0){
				$ret=mysqli_query($con,"update tbladmin set Matkhau='$newpassword' where ID='$adminid'");
				$msg= "Thay đổi mật khẩu thành công !"; 
			}
		else {
			$msg="Mật khẩu hiện tại không chính xác.";
		}
	} 
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>SPA | Đổi mật khẩu</title>
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/font-awesome.css" rel="stylesheet">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/modernizr.custom.js"></script>
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic'
        rel='stylesheet' type='text/css'>
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <script>
    new WOW().init();
    </script>
    <script src="js/metisMenu.min.js"></script>
    <script src="js/custom.js"></script>
    <link href="css/custom.css" rel="stylesheet">
    <script type="text/javascript">
    function checkpass() {
        if (document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
            alert('Mật khẩu mới và xác nhận mật khẩu không đúng');
            document.changepassword.confirmpassword.focus();
            return false;
        }
        return true;
    }
    </script>
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
                            <h4>Làm mới mật khẩu :</h4>
                        </div>
                        <div class="form-body">
                            <form method="post" name="changepassword" onsubmit="return checkpass();" action="">
                                <p style="font-size:16px; color:red" align="center">
                                    <?php if($msg){
										echo $msg;
									}?>
                                </p>
                                <?php
									$adminid=$_SESSION['bpmsaid'];
									$ret=mysqli_query($con,"select * from tbladmin where ID='$adminid'");
									$cnt=1;
									while ($row=mysqli_fetch_array($ret)) {
								?>
                                <div class="form-group"> <label for="exampleInputEmail1">Mật khẩu hiện tại</label>
                                    <input type="password" name="currentpassword" class="form-control" required="true"
                                        value=""> </div>
                                <div class="form-group"> <label for="exampleInputPassword1">Mật khẩu mới</label> <input
                                        type="password" name="newpassword" class="form-control" value=""
                                        required="true"> </div>
                                <div class="form-group"> <label for="exampleInputPassword1">Xác nhận mật khẩu</label>
                                    <input type="password" name="confirmpassword" class="form-control" value=""
                                        required="true"> </div>
                                <button type="submit" name="submit" class="btn btn-default">Thay đổi</button>
                            </form>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('includes/footer.php');?>
        <script src="js/classie.js"></script>
        <script>
        var menuLeft = document.getElementById('cbp-spmenu-s1'),
            showLeftPush = document.getElementById('showLeftPush'),
            body = document.body;

        showLeftPush.onclick = function() {
            classie.toggle(this, 'active');
            classie.toggle(body, 'cbp-spmenu-push-toright');
            classie.toggle(menuLeft, 'cbp-spmenu-open');
            disableOther('showLeftPush');
        };

        function disableOther(button) {
            if (button !== 'showLeftPush') {
                classie.toggle(showLeftPush, 'disabled');
            }
        }
        </script>
        <script src="js/jquery.nicescroll.js"></script>
        <script src="js/scripts.js"></script>
        <script src="js/bootstrap.js"> </script>
</body>

</html>
<?php } ?>