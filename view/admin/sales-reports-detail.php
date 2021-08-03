<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
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
    <title>SPA || Chi tiết báo cáo bán hàng</title>
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
                        <?php
						$fdate=$_POST['fromdate'];
						$tdate=$_POST['todate'];
						$rtype=$_POST['requesttype'];
					?>
                        <?php if($rtype=='mtwise'){
						$month1=strtotime($fdate);
						$month2=strtotime($tdate);
						$m1=date("F",$month1);
						$m2=date("F",$month2);
						$y1=date("Y",$month1);
						$y2=date("Y",$month2);
					?>
                        <h4 class="header-title m-t-0 m-b-30">Báo cáo doanh thu offline theo tháng</h4>
                        <h4 align="center" style="color:blue">Báo cáo doanh thu từ ngày <?php echo $m1."-".$y1;?> đến
                            <?php echo $m2."-".$y2;?></h4>
                        <hr />
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Tháng / Năm </th>
                                    <th>Bán hàng</th>
                                </tr>
                            </thead>
                            
                            <?php
                            $ret=mysqli_query($con,"select month(tblorders.Ngayorder) as lmonth,year(tblorders.Ngayorder) as lyear,sum(Giasanpham) as totalprice from tblctod join tblsanpham on tblsanpham.ID= tblctod.SanphamId join tblorders on tblorders.Id = tblctod.OrderId where date(tblorders.Ngayorder) between '$f' and '$to' group by lmonth,lyear");
							$cnt=1;
							while ($row=mysqli_fetch_array($ret)) {
						?>
                            <tr>
                                <td><?php echo $cnt;?></td>
                                <td><?php  echo $row['lmonth']."/".$row['lyear'];?></td>
                                <td><?php echo currency_format($total=$row['totalprice']+$row['totalprice1']);?>
                                </td>
                            </tr>
                            <?php
                            $ftotal+=$total;
                            $cnt++;
                            }?>

                            <tr>
                                <td colspan="2" align="center">Tổng cộng </td>
                                <td><?php  echo currency_format($ftotal);?></td>
                            </tr>
                        </table>
                        <?php } else {
					$year1=strtotime($fdate);
					$year2=strtotime($tdate);
					$y1=date("Y",$year1);
					$y2=date("Y",$year2);
				?>
                        <h4 class="header-title m-t-0 m-b-30">Báo cáo  doanh thu offline theo năm</h4>
                        <h4 align="center" style="color:blue">Báo cáo bán hàng từ <?php echo $y1;?> to <?php echo $y2;?>
                        </h4>
                        <hr />
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Năm </th>
                                    <th>Bán hàng</th>
                                </tr>
                            </thead>
                            <?php
						$ret=mysqli_query($con,"select year(tblhoadon.NgayDang) as lyear,(sum(Chiphi)+tblsanpham.Giasanpham) as totalprice from  tblhoadon join tbldichvu on tbldichvu.ID= tblhoadon.DichvuId join tblsanpham on tblsanpham.Id = tblhoadon.SanphamId where date(tblhoadon.NgayDang) between '$fdate' and '$tdate' group by lyear");
						$cnt=1;
						while ($row=mysqli_fetch_array($ret)) {
					?>
                            <tr>
                                <td><?php echo $cnt;?></td>
                                <td><?php  echo $row['lyear'];?></td>
                                <td><?php  echo $total=$row['totalprice'];?></td>
                            </tr>
                            <?php
						$ftotal+=$total;
						$cnt++;
					}?>
                            <tr>
                                <td colspan="2" align="center">Tổng cộng </td>
                                <td><?php  echo $ftotal;?></td>
                            </tr>
                        </table>
                        <?php } ?>
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
<?php }  ?>