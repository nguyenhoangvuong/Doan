<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
    $oid = $_GET['oid'];
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
    <title>SPA || Danh sách khách hàng</title>
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
    <link href="css/modal.css" rel="stylesheet">

</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('includes/sidebar.php');?>
        <?php include_once('includes/header.php');?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                    <div class="table-responsive bs-example widget-shadow">
                        <h4>Chi tiết đơn hàng:</h4>
                        <form action="" method="post">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Hình ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>SL</th>
                                        <th>Giá mỗi đơn vị</th>
                                        <th>Phí</th>
                                        <th>Tổng cộng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
								$ret=mysqli_query($con,"select tblsanpham.Hinhanh1 as pimg1,tblsanpham.Tensanpham as pname,tblsanpham.Id as proid,tblctod.SanphamId as opid,tblctod.Soluong as qty,tblsanpham.Giasanpham as pprice,tblsanpham.Phivanchuyen as shippingcharge,tblorders.Id as orderid from tblctod join tblsanpham on tblctod.SanphamId=tblsanpham.Id join tblorders on tblctod.OrderId = tblorders.Id where tblorders.Id = '$oid'");
								$cnt=1;
								while ($row=mysqli_fetch_array($ret)) {
							?>
                                    <tr>
                                        <th scope="row"><?php echo $cnt;?></th>
                                        <td><img src="../admin/productimages/<?php echo $row['proid'];?>/<?php echo $row['pimg1'];?>"
                                                        alt="" width="84" height="146"></td>
                                        <td><?php  echo $row['pname'];?></td>
                                        <td><?php echo $qty=$row['qty']; ?></td>
                                        <td><?php echo currency_format($price=$row['pprice']);?></td>
                                        <td><?php  echo currency_format($shippcharge=$row['shippingcharge']);?></td>
                                        <td><?php echo currency_format(($qty*$price)+$shippcharge);?></td>
                                    </tr>


                    </div>
                    <?php 
						$cnt=$cnt+1;
                    }
                       ?>

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
    <script language="javascript">
    document.getElementById("hide").onclick = function() {
        document.getElementById("noidung").style.display = 'none';
        document.getElementById("hide").style.display = 'none';
    };

    document.getElementById("myBtn").onclick = function() {
        document.getElementById("noidung").style.display = 'block';
        document.getElementById("hide").style.display = 'block';
    };
    </script>
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