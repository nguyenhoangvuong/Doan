<?php
session_start();
error_reporting(0);
include('../includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
    date_default_timezone_set('Asia/Kolkata');
    $currentTime = date( 'd-m-Y h:i:s A', time () );
    
    if(isset($_POST['submit']))
    {
        $category=$_POST['sername'];
        $cost=$_POST['cost'];
        $sql=mysqli_query($con,"insert into tbldichvu(Tendichvu,Chiphi) values('$category','$cost')");
        $_SESSION['msg']="Thêm dịch vụ thành công !!";
    
    }
    
    if(isset($_GET["del"]))
    {   
        $a = $_GET['id'];
        $b = mysqli_query($con,"delete from tbldichvu where Id = '$a'");
        if($b){
            header('Location:manage-services.php');
            $_SESSION['msg'] = "Xóa thành công !";
        }
        else{
            header('Location:manage-services.php');
            $_SESSION['msg'] = "Xóa thất bại !";
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
    <title>SPA || Quản lý dịch vụ</title>
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
<style>
    .alert-success {
        background: #eaf4e2;
        border-color: #c1dea9;
        color: #61a06f;
    }

    .alert .close {
        position: relative;
        top: 1px;
        right: -10px;
        line-height: 20px;
    }

    button.close {
        padding: 0;
        cursor: pointer;
        background: transparent;
        border: 0;
        -webkit-appearance: none;
    }

    .close {
        float: right;
        font-size: 20px;
        font-weight: bold;
        line-height: 20px;
        color: #333;
        text-shadow: 0 1px 0 #ffffff;
        opacity: 0.2;
        filter: alpha(opacity=20);
    }

    .alert {
        padding: 8px 35px 8px 14px;
        margin-bottom: 20px;
        text-shadow: 0 1px 0 rgb(255 255 255 / 50%);
        background-color: #fcf8e3;
        border: 1px solid #fbeed5;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
    }

    .alert-danger,
    .alert-error {
        background: #f7e7e4;
        border-color: #ecbeb6;
        color: #b55351;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        border: 1px solid #888;
        width: 40%;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.4s
    }

    /* Add Animation */
    @-webkit-keyframes animatetop {
        from {
            top: -300px;
            opacity: 0
        }

        to {
            top: 0;
            opacity: 1
        }
    }

    @keyframes animatetop {
        from {
            top: -300px;
            opacity: 0
        }

        to {
            top: 0;
            opacity: 1
        }
    }

    /* The Close Button */
    .close {
        color: white;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-header {
        padding: 2px 16px;
        background-color: #337ab7;
        color: white;
    }

    .modal-body {
        padding: 2px 16px;
    }

    .modal-footer {
        padding: 2px 16px;
        background-color: #337ab7;
        color: white;
    }
    </style>
</head>

<body class="cbp-spmenu-push">

    <div class="main-content">
        <?php include_once('includes/sidebar.php');?>
        <?php include_once('includes/header.php');?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                    <div id="myModal" class="modal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="close">&times;</span>
                                <h3 style="font-family:times new roman;width:100%;text-align:center">Thêm dịch vụ</h3>
                            </div>
                            
                            <div class="modal-body">
                                    <div class="form-body">
                                        <form method="post">
                                            <p style="font-size:16px; color:red" align="center">
                                                <?php if($msg){
									echo $msg;
								}  ?> </p>
                                            <div class="form-group"> <label for="exampleInputEmail1">Tên dịch vụ</label>
                                                <input type="text" class="form-control" id="sername" name="sername"
                                                    placeholder="Tên dịch vụ" value="" required="true">
                                            </div>
                                            <div class="form-group"> <label for="exampleInputPassword1">Chi phí</label>
                                                <input type="text" id="cost" name="cost" class="form-control"
                                                    placeholder="Chi phí" value="" required="true">
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-primary">Thêm</button>
                                        </form>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <h6 style="font-family:times new roman;width:100%;text-align:center">Admin-Spa</h6>
                            </div>
                        </div>

                    </div>
                    <div class="table-responsive bs-example widget-shadow">
                            <h4>Danh sách dịch vụ 
                                <button id="myBtn" class="btn btn-primary">Thêm dịch vụ</button>
                                <form method="POST" action="export.php"><button class="input-group-addon " style="position:fixed;top:100px;width:80px;right:320px;background-color:GREEN;color:white;height:35px;border-radius:5px" name="btnExportdichvu" type="submit">Xuất Excel</button>
                        </form>
                            </h4>
                                <div class="input-group" style="position:fixed;top:100px;width:270px;right:30px">
                                    <div class="input-group-addon" style="background-color:#337ab7;color:white">
                                        Search
                                    </div>
                                    <input type="text" name="search_text" id="search_text" Placeholder="Search services..." class="form-control">
                                </div>
                            <br>
                        <div id="result"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('includes/footer.php');?>
    </div>
    <script src="js/classie.js"></script>

    <script>
        $(document).ready(function(){
            $.ajax({
                url:"fetch.php",
                method:"post",
                data:{search:""},
                dataType:"text",
                success:function(data){
                    $('#result').html(data);
                }
            });

            $('#search_text').keyup(function(){
                var txt = $(this).val();
                if(txt !=''){
                    $.ajax({
                        url:"fetch.php",
                        method:"post",
                        data:{search:txt},
                        dataType:"text",
                        success:function(data){
                            $('#result').html(data);
                        }
                    });
                }else{
                    $('#result').html('');
                    $.ajax({
                        url:"fetch.php",
                        method:"post",
                        data:{search:txt},
                        dataType:"text",
                        success:function(data){
                            $('#result').html(data);
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
    <script>
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];
    btn.onclick = function() {
        modal.style.display = "block";
    }
    span.onclick = function() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/bootstrap.js"> </script>
</body>

</html>
<?php }  ?>