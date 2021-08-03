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
    <title>SPA || Tìm kiếm hóa đơn</title>
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
                        <h4>Tìm kiếm hóa đơn:</h4>
                        <div class="form-body">
                            <form method="post" name="search" action="">
                                <p style="font-size:16px; color:red" align="center"> <?php if($msg){
									echo $msg;
								}  ?> </p>
                                <div class="form-group"> <label for="exampleInputEmail1">Tìm kiếm bởi số điện thoại hoặc
                                        số hóa đơn hoặc tên khách</label> <input id="searchdata" type="text"
                                        name="searchdata" required="true" class="form-control">
                                    <br>
                                    <button type="submit" name="search" class="btn btn-primary btn-sm">Tìm kiếm</button>
                            </form>
                        </div>
                        <?php
							if(isset($_POST['search']))
							{ 
							$sdata=$_POST['searchdata'];
						?>
                        <h4 align="center">Không có kết quả liên quan: "<?php echo $sdata;?>"</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID hóa đơn</th>
                                    <th>Tên khách hàng</th>
                                    <th>Ngày lập hóa đơn</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
							$ret=mysqli_query($con,"select distinct  tblkhachhang.Ten,tblkhachhang.Sodienthoai,tblhoadon.BillId,tblhoadon.NgayDang from  tblkhachhang   
								join tblhoadon on tblkhachhang.ID=tblhoadon.Userid  where tblhoadon.BillId like '%$sdata%' || tblkhachhang.Sodienthoai like '%$sdata%' || tblkhachhang.Ten like '%$sdata%'");
							$num=mysqli_num_rows($ret);
							if($num>0){
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
						} } else { ?>
                                <tr>
                                    <td colspan="8"> Không có kết quả tìm kiếm nào</td>
                                </tr>
                                <?php } }?>
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