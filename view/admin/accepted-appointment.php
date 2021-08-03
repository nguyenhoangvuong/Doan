<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{

    $connect = new PDO("mysql:host=localhost;dbname=spa", "root", "");

    $query = "select * from tblcuochen where Trangthai='1'";

    $statement = $connect->prepare($query);

    $statement->execute();

    $result = $statement->fetchAll();

  ?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>SPA || Cuộc hẹn được chấp nhận</title>
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
                        <h4>Cuộc hẹn được chấp nhận:</h4>
                        <form method="POST" id="convert_form" action="export.php">
                            <table class="table table-bordered table-striped" id="table_content">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Số cuộc hẹn</th>
                                        <th>Tên khách</th>
                                        <th>Số điện thoại</th>
                                        <th>Ngày hẹn</th>
                                        <th>Thời gian</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
								$ret=mysqli_query($con,"select * from  tblcuochen where Trangthai='1' order by Ngayhen desc");
								$cnt=1;
								while ($row=mysqli_fetch_array($ret)) {
							?>
                                    <tr>
                                        <th scope="row"><?php echo $cnt;?></th>
                                        <td><?php  echo $row['Socuochen'];?></td>
                                        <td><?php  echo $row['Ten'];?></td>
                                        <td><?php  echo $row['Sodienthoai'];?></td>
                                        <td><?php  echo $row['Ngayhen'];?></td>
                                        <td><?php  echo $row['Giohen'];?></td>
                                        <td><a href="view-appointment.php?viewid=<?php echo $row['ID'];?>">Xem chi
                                                tiết</a>
                                        </td>
                                    </tr> <?php 
						$cnt=$cnt+1;
						}?>
                                </tbody>
                            </table>
                        </form>
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
    <script>
    $(document).ready(function() {
        $('#convert').click(function() {
            var table_content = '<table>';
            table_content += $('#table_content').html();
            table_content += '</table>';
            $('#file_content').val(table_content);
            $('#convert_form').submit();
        });
    });
    </script>
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/bootstrap.js"> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</body>

</html>
<?php }  ?>