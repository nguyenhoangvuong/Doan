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
    <title>SPA || Tất cả cuộc hẹn</title>
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
                        <h4>Tất cả cuộc hẹn:
                            <form method="POST" action="export.php">
                                <button class="input-group-addon "
                                    style="position:fixed;top:100px;width:80px;right:320px;background-color:GREEN;color:white;height:35px;border-radius:5px"
                                    name="btnExport" type="submit">Xuất Excel</button>
                            </form>
                        </h4>
                        <div class="input-group" style="position:fixed;top:100px;width:270px;right:30px">
                            <div class="input-group-addon" style="background-color:#337ab7;color:white">
                                Search
                            </div>
                            <input type="text" name="search_text" id="search_text" Placeholder="Search appointment..."
                                class="form-control">
                        </div>
                        <br>
                        <div id="result1"></div>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once('includes/footer.php');?>
    </div>
    <script src="js/classie.js"></script>
    <script>
    $(document).ready(function() {
        $.ajax({
            url: "fetch1.php",
            method: "post",
            data: {
                search: "",
            },
            dataType: "text",
            success: function(data) {
                $('#result1').html(data);
            }
        });

        $('#search_text').keyup(function() {
            var txt = $(this).val();
            if (txt != '') {
                $.ajax({
                    url: "fetch1.php",
                    method: "post",
                    data: {
                        search: txt
                    },
                    dataType: "text",
                    success: function(data) {
                        $('#result1').html(data);
                    }
                });
            } else {
                $('#result1').html('');
                $.ajax({
                    url: "fetch1.php",
                    method: "post",
                    data: {
                        search: txt
                    },
                    dataType: "text",
                    success: function(data) {
                        $('#result1').html(data);
                    }
                });
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