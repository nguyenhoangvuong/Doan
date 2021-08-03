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
    <title>SPA || Danh sách hóa đơn</title>
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
                <div class="tables" id="exampl">
                    <?php
						$invid=intval($_GET['invoiceid']);
						$ret=mysqli_query($con,"select DISTINCT  tblhoadon.NgayDang,tblkhachhang.Ten,tblkhachhang.Email,tblkhachhang.Sodienthoai,tblkhachhang.Gioitinh
						from  tblhoadon 
						join tblkhachhang on tblkhachhang.ID=tblhoadon.Userid 
						where tblhoadon.BillId='$invid'");
						$cnt=1;
						while ($row=mysqli_fetch_array($ret)) {
					?>
                    <div class="table-responsive bs-example widget-shadow">
                        <div><h4 style="float:left">Invoice #<?php echo $invid;?></h4><H4 style="color:red;position:absolute;right:30px">HỆ THỐNG SPA</H4></div>
                        <table class="table table-bordered" width="100%" border="1">
                            <tr>
                                <th colspan="6">Chi tiết khách hàng</th>
                            </tr>
                            <tr>
                                <th>Tên</th>
                                <td><?php echo $row['Ten']?></td>
                                <th>Số liên lạc.</th>
                                <td><?php echo $row['Sodienthoai']?></td>
                                <th>Email </th>
                                <td><?php echo $row['Email']?></td>
                            </tr>
                            <tr>
                                <th>Giới tính</th>
                                <td><?php echo $row['Gioitinh']?></td>
                                <th>Ngày hóa đơn</th>
                                <td colspan="3"><?php echo $row['NgayDang']?></td>
                            </tr>
                            <?php }?>
                        </table>
                        <?php
                        $ret11=mysqli_query($con,"select tbldichvu.Tendichvu,tbldichvu.Chiphi  
                        from  tblhoadon 
                        join tbldichvu on tbldichvu.ID=tblhoadon.DichvuId 
                        where tblhoadon.BillId='$invid'");
                        $num11 = mysqli_num_rows($ret11);
                        if($num11 > 0){
                        ?>
                        <table class="table table-bordered" width="100%" border="1">
                            <tr>
                                <th colspan="3">Chi tiết dịch vụ</th>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th>Dịch vụ</th>
                                <th>Chi phí</th>
                            </tr>
                            <?php
							$ret=mysqli_query($con,"select tbldichvu.Tendichvu,tbldichvu.Chiphi  
								from  tblhoadon 
								join tbldichvu on tbldichvu.ID=tblhoadon.DichvuId 
								where tblhoadon.BillId='$invid'");
							$cnt=1;
							while ($row=mysqli_fetch_array($ret)) {
								?>

                            <tr>
                                <th><?php echo $cnt;?></th>
                                <td><?php echo $row['Tendichvu']?></td>
                                <td><?php echo currency_format($subtotal=$row['Chiphi'])?></td>
                            </tr>
                            <?php 
								$cnt=$cnt+1;
								$gtotal+=$subtotal;
							} ?>
                            <tr>
                                <th colspan="2" style="text-align:center">Tổng cộng</th>
                                <th><?php echo currency_format($gtotal)?></th>

                            </tr>
                        </table>
                        <?php
                        }
                        ?>
                        <?php
                        $ret11=mysqli_query($con,"select tblsanpham.Tensanpham,tblsanpham.Giasanpham  
                        from  tblhoadon 
                        join tblsanpham on tblsanpham.ID=tblhoadon.SanphamId 
                        where tblhoadon.BillId='$invid'");
                        $num11 = mysqli_num_rows($ret11);
                        if($num11 > 0){
                        ?>
                        <table class="table table-bordered" width="100%" border="1">
                            <tr>
                                <th colspan="3">Chi tiết sản phẩm</th>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th>Sản phẩm</th>
                                <th>Giá sản phẩm</th>
                            </tr>
                            <?php
							$ret=mysqli_query($con,"select tblsanpham.Tensanpham,tblsanpham.Giasanpham  
								from  tblhoadon 
								join tblsanpham on tblsanpham.ID=tblhoadon.SanphamId 
								where tblhoadon.BillId='$invid'");
							$cnt=1;
							while ($row=mysqli_fetch_array($ret)) {
								?>

                            <tr>
                                <th><?php echo $cnt;?></th>
                                <td><?php echo $row['Tensanpham']?></td>
                                <td><?php echo currency_format($subtotal=$row['Giasanpham'])?></td>
                            </tr>
                            <?php 
								$cnt=$cnt+1;
								$gtotal+=$subtotal;
							} ?>
                            <tr>
                                <th colspan="2" style="text-align:center">Tổng cộng</th>
                                <th><?php echo currency_format($gtotal)?></th>

                            </tr>
                        </table>
                        <?php
                        }
                        ?>
                        
                        <p style="margin-top:1%" align="center">
                            <i class="fa fa-print fa-2x" style="cursor: pointer;" OnClick="CallPrint(this.value)"></i>
                        </p>
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
    <script>
    function CallPrint(strid) {
        var prtContent = document.getElementById("exampl");
        var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.focus();
        WinPrint.print();
        WinPrint.document.close();
    }
    </script>
</body>

</html>
<?php }  ?>