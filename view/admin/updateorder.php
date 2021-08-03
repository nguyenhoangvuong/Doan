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
    
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('includes/sidebar.php');?>
        <?php include_once('includes/header.php');?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                    <h3 class="title1">Đặt hàng trong ngày</h3>
                    <div class="table-responsive bs-example widget-shadow">
                        <h4>Danh sách đơn:</h4>
                        <form action="" method="post">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên</th>
                                        <th>Email / SĐT</th>
                                        <th>Địa chỉ giao hàng</th>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Tổng tiền</th>
                                        <th>Ngày đặt</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                $f1 = "00:00:00";
                                $from = date('Y-m-d')." ".$f1;
                                $t1 ="23:59:59";
                                $to = date('Y-m-d')." ".$t1; 
								$ret=mysqli_query($con,"select tblusers.Ten as username,tblusers.Email as useremail,tblusers.Lienhe as usercontact,tblusers.Diachigiaohang as shippingaddress,tblusers.Thanhphovanchuyen as shippingcity,tblusers.Trangthaivanchuyen as shippingstate,tblusers.Mapinvanchuyen as shippingpincode,tblsanpham.Tensanpham as productname,tblsanpham.Phivanchuyen as shippingcharge,tblorders.Soluong as quantity,tblorders.Ngayorder as orderdate,tblsanpham.Giasanpham as productprice,tblorders.Id as id from tblorders join tblusers on tblorders.UserId = tblusers.Id join tblsanpham on tblsanpham.Id = tblorders.SanphamId where tblorders.Ngayorder between '$from' and '$to'");
								$cnt=1;
								while ($row=mysqli_fetch_array($ret)) {
							    ?>
                                    <tr>
                                        <th scope="row"><?php echo $cnt;?></th>
                                        <td><?php  echo $row['username'];?></td>
                                        <td><?php  echo $row['useremail']." | ".$row['usercontact'];?></td>
                                        <td><?php  echo $row['shippingaddress'].", ".$row['shippingcity'].", ".$row['shippingstate'].", ".$row['shippingpincode'];?></td>
                                        <td><?php  echo $row['productname'];?></td>
                                        <td><?php  echo $row['quantity'];?></td>
                                        <td><?php  echo $row['productprice']*$row['quantity']+$row['shippingcharge'];?></td>
                                        <td><?php  echo $row['orderdate'];?></td>
                                        <?php $a =$row['id'];?>
                                        <td><button name="submit" class="btn btn-primary"><a data-toggle="modal" data-target=".bs-example-modal-lg" href="updateorder.php?getid='<?php echo $a?>">Xem</a></button></td>
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
    </div>
    <?php include_once('includes/footer.php');?>
    <script src="js/classie.js"></script>
    <script>
    // var modal = document.getElementById("myModal");
    // var btn = document.getElementById("myBtn");
    // var span = document.getElementsByClassName("close")[0];
    // btn.onclick = function() {
    //     modal.style.display = "block";
    // }
    // span.onclick = function() {
    //     modal.style.display = "none";
    // }
    // window.onclick = function(event) {
    //     if (event.target == modal) {
    //         modal.style.display = "none";
    //     }
    }

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
    <script src="js/jquery-3.6.0.js"> </script>
</body>

</html>
<?php }  ?>