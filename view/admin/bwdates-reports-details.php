<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
  ?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>SPA || Kết quả thống kê giữa các ngày</title>
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
                        <h4>Thống kê giữa các ngày:</h4>
                        <?php
								$fdate=$_POST['fromdate'];
								$tdate=$_POST['todate'];
							?>
                        <h5 align="center" style="color:blue">Báo cáo từ ngày <?php echo $fdate?> to <?php echo $tdate?>
                        </h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Id hóa đơn</th>
                                    <th>Tên khách hàng</th>
                                    <th>Ngày hóa đơn</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								$ret=mysqli_query($con,"select distinct tblkhachhang.Ten,tblhoadon.BillId,tblhoadon.NgayDang from  tblkhachhang   
									join tblhoadon on tblkhachhang.ID=tblhoadon.Userid  where date(tblhoadon.NgayDang) between '$fdate' and '$tdate'");
								$cnt=1;
								while ($row=mysqli_fetch_array($ret)) {
							?>
                                <tr>
                                    <th scope="row"><?php echo $cnt;?></th>
                                    <td><?php  echo $row['BillId'];?></td>
                                    <td><?php  echo $row['Ten'];?></td>
                                    <td><?php  echo $row['NgayDang'];?></td>
                                    <td><a href="view-invoice.php?invoiceid=<?php  echo $row['BillId'];?>">Xem chi
                                            tiết</a></td>
                                </tr> <?php 
							$cnt=$cnt+1;
							}?>
                            </tbody>
                        </table>
                        
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