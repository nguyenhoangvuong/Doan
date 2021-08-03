<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit']))
  {
    $sername=$_POST['sername'];
    $cost=$_POST['cost'];
 	$eid=$_GET['editid'];
    $query=mysqli_query($con, "update  tbldichvu set Tendichvu='$sername',Chiphi='$cost' where ID='$eid' ");
    if ($query) {
    	$msg="Dịch vụ đã được cập nhật !";
  	}
 	 else
    {
      $msg="Đã xảy ra lỗi. Vui lòng thử lại !";
    }
}
  ?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>SPA | Cập nhật dịch vụ</title>

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
                            <h4>Cập nhật dịch vụ phòng</h4>
                        </div>
                        <div class="form-body">
                            <form method="post">
                                <p style="font-size:16px; color:red" align="center"> <?php if($msg){
								echo $msg;
							}  ?> </p>
                                <?php
								$cid=$_GET['editid'];
								$ret=mysqli_query($con,"select * from  tbldichvu where ID='$cid'");
								$cnt=1;
								while ($row=mysqli_fetch_array($ret)) {
							?>
                                <div class="form-group"> <label for="exampleInputEmail1">Tên dịch vụ</label> <input
                                        type="text" class="form-control" id="sername" name="sername"
                                        placeholder="Tên dịch vụ" value="<?php  echo $row['Tendichvu'];?>"
                                        required="true"> </div>
                                <div class="form-group"> <label for="exampleInputPassword1">Chi phí</label> <input
                                        type="text" id="cost" name="cost" class="form-control" placeholder="Chi phí"
                                        value="<?php  echo $row['Chiphi'];?>" required="true"> </div>
                                <?php } ?>
                                <button type="submit" name="submit" class="btn btn-default">Cập nhật</button>
                                <a href="manage-services.php" type="submit" name="submit" class="btn btn-default">Trở về</a>
                            </form>
                        </div>
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