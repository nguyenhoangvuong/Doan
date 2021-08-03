<?php
session_start();
error_reporting(0);
$sotin1trang = 10;
$trang = $_GET['trang'];
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
      if(isset($_GET['del'])){
        $query=mysqli_query($con,"delete from tblnhatkynguoidung where Id = '".$_GET['id']."'");
      }
  ?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>SPA || Danh sách người dùng</title>
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
                        <h4>Nhật ký người dùng:</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Email</th>
                                    <th>IP người dùng</th>
                                    <th>Thời gian login</th>
                                    <th>Thời gian logout</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $fr = ($trang - 1) * $sotin1trang;
								$ret=mysqli_query($con,"select *from  tblnhatkynguoidung limit $fr,$sotin1trang");
								$cnt=1;
								while ($row=mysqli_fetch_array($ret)) {
							?>
                                <tr>
                                    <th scope="row"><?php echo $cnt;?></th>
                                    <td><?php  echo $row['Emailnguoidung'];?></td>
                                    <td><?php  echo $row['Ipnguoidung'];?></td>
                                    <td><?php  echo $row['Thoigianlogin'];?></td>
                                    <td><?php  echo $row['Thoigianlogout'];?></td>
                                    <td><?php  echo $row['Trangthai'];?></td>
                                    <td><a href="user-log.php?id=<?php echo $row['Id'];?>&del=delete" onClick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a></td>
                                </tr> <?php 
						$cnt=$cnt+1;
						}?>
                            </tbody>
                        </table>
                        <div id="phantrang">
                            <?php
                                $ret1=mysqli_query($con,"select *from  tblnhatkynguoidung");
                                $tonsotin = mysqli_num_rows($ret1);
                                $sotrang = ceil($tonsotin / $sotin1trang);
                                for($t = $sotrang; $t >= 1;$t--){
                                    echo "<div style='width:100%;'><a style='color:white;margin-right:2%;float:right;background-color:#00FFFF;border-radius:50%;width:20px;text-align:center' href='user-log.php?trang=$t'> $t  </a></div>";
                                }
                            ?>
                        </div>
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