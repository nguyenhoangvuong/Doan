<?php
	session_start();
	error_reporting(0);
	include('includes/dbconnection.php');
	if (strlen($_SESSION['bpmsaid']==0)) {
		header('location:logout.php');
	} 
	else{
		if(isset($_POST['submit'])){
		$uid=intval($_GET['addid']);
		$invoiceid=mt_rand(100000000, 999999999);
		$sid=$_POST['sids'];
		for($i=0;$i<count($sid);$i++){
			$svid=$sid[$i];
			$ret=mysqli_query($con,"insert into tblhoadon(Userid,DichvuId,BillId) values('$uid','$svid','$invoiceid');");
			echo '<script>alert("Hóa đơn được tạo thành công. Số hóa đơn là "+"'.$invoiceid.'")</script>';
			echo "<script>window.location.href ='invoices.php'</script>";
		}
	}
    if (!function_exists('currency_format')) {
        function currency_format($number, $suffix = 'đ') {
            if (!empty($number)) {
                return number_format($number, 0, ',', '.') . "{$suffix}";
            }
        }
    }
  ?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>SPA || Chỉ định dịch vụ</title>
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
                <div class="tables">
                    <div class="table-responsive bs-example widget-shadow">
                        <h4>Dịch vụ:</h4>
                        <form method="post">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên dịch vụ</th>
                                        <th>Giá dich vụ</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
								$ret=mysqli_query($con,"select *from  tbldichvu");
								$cnt=1;
								while ($row=mysqli_fetch_array($ret)) {
									?>
                                    <tr>
                                        <th scope="row"><?php echo $cnt;?></th>
                                        <td><?php  echo $row['Tendichvu'];?></td>
                                        <td><?php  echo currency_format($row['Chiphi']);?></td>
                                        <td><input type="checkbox" name="sids[]" value="<?php  echo $row['ID'];?>"></td>
                                    </tr>
                                    <?php 
										$cnt=$cnt+1;
									}?>
                                    <tr>
                                        <td colspan="4" align="center">
                                            <button type="submit" name="submit" class="btn btn-primary">Xác
                                                nhận</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('includes/footer.php');?>
    </div>
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
<?php }  ?>