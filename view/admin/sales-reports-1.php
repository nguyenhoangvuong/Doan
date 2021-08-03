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
    <title>SPA | Báo cáo bán hàng online</title>
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
                <div class="forms">
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="form-title">
                            <h4>Báo cáo bán hàng online:</h4>
                        </div>
                        <div class="form-body">
                            <form method="post" name="bwdatesreport" action="sales-reports-detail-1.php"
                                enctype="multipart/form-data">
                                <p style="font-size:16px; color:red" align="center"> <?php if($msg){
									echo $msg;
								}  ?> </p>
                                <div class="form-group"> <label for="exampleInputEmail1">Từ ngày</label> <input
                                        type="date" class="form-control1" name="fromdate" id="fromdate" value=""
                                        required='true'> </div>
                                <div class="form-group"> <label for="exampleInputPassword1">Đến ngày</label><input
                                        type="date" class="form-control1" name="todate" id="todate" value=""
                                        required='true'> </div>
                                <div class="form-group"> <label for="exampleInputPassword1">Loại yêu cầu </label> <input
                                        type="radio" name="requesttype" value="mtwise" checked="true"> Tháng
                                    <input type="radio" name="requesttype" value="yrwise">Năm
                                </div>
                                <button type="submit" name="submit" class="btn btn-default">Xác nhận</button>
                            </form>
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
<?php } ?>