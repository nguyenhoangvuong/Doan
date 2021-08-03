<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
    $oid = $_GET['oid'];
    if(isset($_POST['submit2'])){
        $status = $_POST['status'];
        $remark = $_POST['remark'];
        $query = mysqli_query($con,"insert into tbltheodoilichsu(OrderId,Trangthai,Nhanxet) values('$oid','$status','$remark')");
        $sql = mysqli_query($con,"update tblorders set Tinhtrangorder = '$status' where Id = '$oid'");
        echo "<script>alert('Đơn đã được cập nhật !');</script>";
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
    <title>SPA || Đơn hàng chờ duyệt</title>
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
                        <h4>Danh sách đơn:</h4>
                        <form action="" method="post">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên</th>
                                        <th>Email / SĐT</th>
                                        <th>Địa chỉ giao hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Ngày đặt</th>
                                        <th colspan="2" style="text-align:center">Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
								$ret=mysqli_query($con,"select tblusers.Ten as username,tblusers.Email as useremail,tblusers.Lienhe as usercontact,tblusers.Diachigiaohang as shippingaddress,tblusers.Thanhphovanchuyen as shippingcity,tblusers.Mapinvanchuyen as shippingpincode,tblorders.Ngayorder as orderdate,tblorders.Tongtien,tblorders.Id as id from tblorders join tblusers on tblorders.UserId = tblusers.Id where  tblorders.Tinhtrangorder ='In Process' or tblorders.Tinhtrangorder is null order by tblorders.Ngayorder desc");
								$cnt=1;
								while ($row=mysqli_fetch_array($ret)) {
							?>
                                    <tr>
                                        <th scope="row"><?php echo $cnt;?></th>
                                        <td><?php  echo $row['username'];?></td>
                                        <td><?php  echo $row['useremail']." | ".$row['usercontact'];?></td>
                                        <td><?php  echo $row['shippingaddress'].", ".$row['shippingcity'].",".$row['shippingpincode'];?>
                                        </td>
                                        <td><?php  echo currency_format($row['Tongtien']);?>
                                        <td><?php  echo $row['orderdate'];?></td>
                                        <td><a class="btn btn-primary" href='pendding-order.php?oid=<?php echo $row['id']; ?>' id="myBtn"
                                                class="user">Duyệt</a>
                                            <?php $a =$row['id']; ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger" href='today-order-details.php?oid=<?php echo $a ?>'>Xem</a>
                                        </td>
                                    </tr>


                    </div>
                    <?php 
						$cnt=$cnt+1;
                    }
                       ?>

                    </tbody>
                    </table>
                    </form>
                    <?php
                    if($oid){
                    ?>
                    <form method='post' class="form">
                        <div class="old"><a id='hide' style='color:white' href='pendding-order.php?oid='>X X</a></div>

                        <div id='noidung'>
                            <h3 class="tittle">Đơn hàng</h3>
                            <p style="font-weight: bold;text-align:center;margin-bottom:5px;font-size:1.2rem">ID : <span><?php echo $oid;?></span></p>
                            <?php
                            $re = mysqli_query($con,"select * from tbltheodoilichsu where OrderId = '$oid'");
                            while($rws = mysqli_fetch_array($re)){
                        ?>
                            <p class="infoma">Ngày : <?php echo $rws['NgayDang']; ?></p>
                            <p class="infoma">Trạng thái : <?php echo $rws['Trangthai']; ?></p>
                            <p class="infoma">Nhận xét : <?php echo $rws['Nhanxet']; ?></p>
                            <p class="infoma"></p>
                            <p class="infoma">----------------------------------------------------------------------</p>
                            <?php
                            }
                        ?>
                            <?php
                        $st='Delivered';
                        $st1 = 'Cancelled';
                        $rt = mysqli_query($con,"select * from tblorders where Id='$oid'");
                        while($num=mysqli_fetch_array($rt)){
                            $currrentSt=$num['Tinhtrangorder'];
                        }
                        if($st==$currrentSt){
                        ?><p class="infoma" id="delivered">Sản phẩm đã được giao</p><?php
                        }
                        else if($st1==$currrentSt){
                            ?><p class="infoma" id="cancelled">Hóa đơn đã hủy</p><?php
                        }
                        else{
                            ?>
                            <table  class="infoma">
                                <tr>
                                    <td>
                                        Tình trạng :
                                    </td>
                                    <td><span>
                                            <select name="status" class="fontkink" required="required">
                                                <option value="">Chọn tình trạng</option>
                                                <option value="In Process">Đang xử lý</option>
                                                <option value="Delivered">Đã giao</option>
                                                <option value="Cancelled">Hủy đơn</option>
                                            </select>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Nhận xét :</p> 
                                    </td>
                                    <td>
                                            <span>
                                                <textarea name="remark" cols="26" rows="3" required="required"></textarea>
                                            </span>
                                    </td>
                                </tr>
                            </table>
                            <div class="upd"><input id="upd" class="btn btn-primary" type="submit" name="submit2"
                                    value="Cập nhật" size="40" style="cursor: pointer;"></div>
                            <?php
                            }
                        ?>
                        </div>
                    </form>
                    <?php
                    }
                    ?>
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