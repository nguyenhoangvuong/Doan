<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } 
else{
    if(isset($_POST['submit']))
    {
		$adminid=$_SESSION['bpmsaid'];
		$aname=$_POST['adminname'];
		$mobno=$_POST['contactnumber'];
     	$query=mysqli_query($con, "update tbladmin set Tenadmin ='$aname', Sodienthoai='$mobno' where ID='$adminid'");
    	if ($query) {
    		$msg="Hồ sơ Admin đã được cập nhật !";
  		}
  	else
    {
      $msg="Có gì đó sai. Vui lòng thử lại !";
    }
  }
  ?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>SPA | Admin Profile</title>
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
                            <h4>Cập nhật hồ sơ :</h4>
                        </div>
                        <div class="form-body">
                            <form method="post">
                                <p style="font-size:16px; color:red" align="center">
                                    <?php 
										if($msg){
											echo $msg;
										}  
									?>
                                </p>
                                <?php
								$adminid=$_SESSION['bpmsaid'];
								$ret=mysqli_query($con,"select * from tbladmin where ID='$adminid'");
								$cnt=1;
								while ($row=mysqli_fetch_array($ret)) {
							?>
                                <div class="form-group"> <label for="exampleInputEmail1">Tên Admin</label> <input
                                        type="text" class="form-control" id="adminname" name="adminname"
                                        placeholder="Tên Admin" value="<?php  echo $row['Tenadmin'];?>"> </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tài khoản</label> <input type="text"
                                        id="username" name="username" class="form-control"
                                        value="<?php  echo $row['Taikhoan'];?>" readonly="true">
                                </div>
                                <div class="form-group"> <label for="exampleInputPassword1">Số liên lạc</label> <input
                                        type="text" id="contactnumber" name="contactnumber" class="form-control"
                                        value="<?php  echo $row['Sodienthoai'];?>"> </div>
                                <div class="form-group"> <label for="exampleInputPassword1">Địa chỉ Email</label> <input
                                        type="email" id="email" name="email" class="form-control"
                                        value="<?php  echo $row['Email'];?>" readonly='true'> </div>
                                <button type="submit" name="submit" class="btn btn-default">Cập nhật</button>
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