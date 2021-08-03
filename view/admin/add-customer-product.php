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
		$sid=$_POST['sids1'];
		for($i=0;$i<count($sid);$i++){
			$svid=$sid[$i];
			$ret=mysqli_query($con,"insert into tblhoadon(Userid,BillId,SanphamId) values('$uid','$invoiceid','$svid');");
			echo '<script>alert("Hóa đơn được cập nhật thành công.")</script>';
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
    <title>SPA || Mua sản phẩm</title>
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
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"></script>
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('includes/sidebar.php');?>
        <?php include_once('includes/header.php');?>
        <div id="page-wrapper" style="margin-top:-50px">
            <div class="main-page">
                <div class="tables">
                    <div class="table-responsive bs-example widget-shadow">
                        <h3 class="title1"></h3>
                        <form method="post">
                            <table class="table table-bordered" id="example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th style="width:40px;text-align:center">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret=mysqli_query($con,"select *from tblsanpham");
                                    $cnt=1;
                                    while ($row=mysqli_fetch_array($ret)) {
                                        ?>
                                    <tr>
                                        <th scope="row"><?php echo $cnt;?></th>
                                        <td><?php  echo $row['Tensanpham'];?></td>
                                        <td><?php  echo currency_format($row['Giasanpham']);?></td>
                                        <td><img src="../admin/productimages/<?php echo $row['Id'];?>/<?php echo $row['Hinhanh1'];?>" alt="" width="100" height="80"></td>
                                        <td><input type="checkbox" name="sids1[]" value="<?php  echo $row['Id'];?>"></td>
                                    </tr>
                                    <?php 
										$cnt=$cnt+1;
									}?>
                                    
                                </tbody>
                                <tr>
                                        <td colspan="4" align="center">
                                            <button type="submit" name="submit" class="btn btn-primary">Xác
                                                nhận</button>
                                        </td>
                                    </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('includes/footer.php');?>
    <script src="js/classie.js"></script>
    <script>
        $(document).ready(function() {
        $('#example').dataTable({
            "language": {
                "sProcessing": "Đang xử lý...",
                "sLengthMenu": "Xem _MENU_ mục",
                "sZeroRecords": "Không tìm thấy dòng nào phù hợp",
                "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
                "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                "sInfoPostFix": "",
                "sSearch": "Tìm:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "Đầu",
                    "sPrevious": "Trước",
                    "sNext": "Tiếp",
                    "sLast": "Cuối"
                }
            }
        });

        });
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