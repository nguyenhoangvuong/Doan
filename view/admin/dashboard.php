<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['masinhvien']==0)) {
  header('location:view/home.php');
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
    <title>SPA | Bảng điều khiển</title>
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
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script>
    new WOW().init();
    </script>
    <script src="js/Chart.js"></script>
    <link rel="stylesheet" href="css/clndr.css" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    < script src = "js/underscore-min.js"
    type = "text/javascript" >
    </script>
    <script src="js/moment-2.2.1.js" type="text/javascript"></script>
    <script src="js/clndr.js" type="text/javascript"></script>
    <script src="js/site.js" type="text/javascript"></script>
    <script src="js/metisMenu.min.js"></script>
    <script src="js/custom.js"></script>
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/custommodal.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets1/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="assets1/css/main.css">
    <link rel="shortcut icon" href="assets1/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="assets1/icon/themify-icons/themify-icons.css">
    <script src="librerias/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
 <style>
    #parent {
        height: 90%;
        width: 100%;
        overflow: hidden;
    }

    #child {
        width: 100%;
        height: 90%;
        overflow-y: scroll;
        padding-right: 17px;
        box-sizing: content-box;
    }
    </style>

</head>

<body class="cbp-spmenu-push" style="position:fixed">
    <div class="main-content">
        <?php include_once('includes/sidebar.php');?>
        <?php include_once('includes/header.php');?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="row dashboard-header">
                    <div class="col-lg-3 col-md-6" style="font-family:'Ubuntu', sans-serif;">
                        <div class="card dashboard-product">
                            <?php $query7=mysqli_query($con,"select * from tbluser where quyen = 'sinhvien'");
                                $row1=mysqli_num_rows($query7);
							?>
                            <span>Sinh viên</span>
                            <h2 class="dashboard-total-products">
                                <?php echo $row1 ?></h2>
                            <span class="label label-warning">View</span>Arriving Today
                            <div class="side-box">
                                <i class="ti-signal text-warning-color"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" style="font-family:'Ubuntu', sans-serif;">
                        <div class="card dashboard-product">
                            <?php $query1=mysqli_query($con,"Select * from tblcuochen");
                        $totalservice=mysqli_num_rows($query1);

                        $query5=mysqli_query($con,"select tblhoadon.DichvuId as DichvuId, tbldichvu.Chiphi
                        from tblhoadon 
                        join tbldichvu  on tbldichvu.ID=tblhoadon.DichvuId");
                        while($row=mysqli_fetch_array($query5))
                        {
                           $todays_sale=$row['Chiphi'];
                           $todysale+=$todays_sale;
                        }
                     ?>
                            <span>Giáo viên</span>
                            <h2 class="dashboard-total-products">
                                <?php echo $totalservice.' / '.currency_format($todysale) ?></h2>
                            <span class="label label-primary">Views/Sales</span>View Today
                            <div class="side-box ">
                                <i class="ti-gift text-primary-color"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" style="font-family:'Ubuntu', sans-serif;">
                        <div class="card dashboard-product">
                            <?php $query2=mysqli_query($con,"Select * from tblcuochen");
								$totalappointment=mysqli_num_rows($query2);
								$query3=mysqli_query($con,"select  *from  tblcuochen where Trangthai='1'");
                        $accept = mysqli_num_rows($query3);
								$query4=mysqli_query($con,"select * from  tblcuochen where Trangthai='2'");
                        $reject = mysqli_num_rows($query4);
                     ?>
                            <span>Khoa</span>
                            <h2 class="dashboard-total-products">
                                <span><?php echo $totalappointment.'/'.$accept.'/'.$reject ?></span>
                            </h2>
                            <span class="label label-success">View</span>Reviews
                            <div class="side-box">
                                <i class="ti-direction-alt text-success-color"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" style="font-family:'Ubuntu', sans-serif;">
                        <div class="card dashboard-product">
                            <span>Lớp</span>
                            <h2 class="dashboard-total-products">
                                <span><?php echo currency_format($s = ($tong + $todysale))?></span>
                            </h2>
                            <span class="label label-danger">Sales</span>Reviews
                            <div class="side-box">
                                <i class="ti-rocket text-danger-color"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top:-60px;">
                <div class="col-sm-7">
                    <div class="panel panel-body" style="height:470px">
                        Thống Kê Tổng Doanh Thu
                        <div class="col-sm-12">
                            <div id="cargaLineal"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="panel panel-body">
                        <div class="col-sm-12">
                            <span id="myChart"></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5" style="font-family:'Ubuntu', sans-serif;">
                    <div class="panel panel-body" style="width:auto;height:215px">
                        <h4>Lịch sử truy cập người dùng</h4><br>
                        <div id="parent">
                            <div id="child">
                                <?php
                            $nhatky = mysqli_query($con,"select Emailnguoidung,Thoigianlogin from tblnhatkynguoidung order by Thoigianlogin desc");
                            while($row=mysqli_fetch_array($nhatky)){
                            ?>
                                <label for=""><?php echo $row['Emailnguoidung'].' - '.$row['Thoigianlogin'];?></label>
                                <?php
                            }
                        ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
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
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Contry', 'Mhl'],
            ['Dịch vụ', <?php  echo round($todysale/$s*100,2);?>],
            ['Sản phẩm offline', <?php  echo round($todysale1/$s*100);?>],
            ['Sản phẩm online', <?php  echo 100-round($todysale/$s*100,2);-round($todysale1/$s*100);?>],
        ]);

        var options = {
            title: 'Thống kê doanh thu theo từng loại hình',
            is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('myChart'));
        chart.draw(data, options);
    }
    </script>
</body>

</html>
<script type="text/javascript">
$(document).ready(function() {
    $('#cargaLineal').load('lineal.php');
});
</script>
<?php }  ?>