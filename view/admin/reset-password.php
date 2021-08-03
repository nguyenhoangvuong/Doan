<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
error_reporting(0);
if (strlen($_SESSION['bpmsaid']==0)) {
    header('location:logout.php');
    }
if(isset($_POST['submit']))
  {
    $contactno=$_SESSION['contactno'];
    $email=$_SESSION['email'];
    $password=md5($_POST['newpassword']);
        $query=mysqli_query($con,"update tbladmin set Matkhau='$password'  where  Email='$email' && Sodienthoai='$contactno' ");
   if($query)
   {
        header('location:dashboard.php');
        echo "<script>alert('Thay đổi mật khẩu thành công');</script>";
        session_destroy();
   }
  }
  ?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>Thay đổi mật khẩu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="codedthemes">
    <meta name="keywords"
        content=", Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="codedthemes">
    <link rel="shortcut icon" href="assets1/images/favicon.png" type="image/x-icon">
    <link rel="icon" href="assets1/images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700" rel="stylesheet">
    <link href="assets1/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="assets1/icon/icofont/css/icofont.css">
    <link rel="stylesheet" type="text/css" href="assets1/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets1/plugins/Waves/waves.min.css">
    <link rel="stylesheet" type="text/css" href="assets1/css/main.css">
    <link rel="stylesheet" type="text/css" href="assets1/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="assets1/css/color/color-1.min.css" id="color" />
    <script>
    function checkpass() {
        if (document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
            alert('Mật khẩu Mới và Xác nhận Mật khẩu không khớp');
            document.changepassword.confirmpassword.focus();
            return false;
        }
        return true;
    }
    </script>
</head>

<body>
    <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="login-card card-block">


                        <form class="md-float-material" method="post" action="" name="changepassword"
                            onsubmit="return checkpass();">
                            <div class="text-center">
                                <img src="assets1/images/favicon.png" alt="logo">
                            </div>
                            <h3 class="text-center txt-primary" STYLE="font-family:times new roman">
                                MẬT KHẨU MỚI
                            </h3>
                            <p style="font-size:16px; color:red" align="center">
                                <?php 
									if($msg){
										echo $msg;
									}  
								?>
                            </p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="md-input-wrapper">
                                        <input type="password" class="md-form-control" name="newpassword"
                                            required="required">
                                        <label>Mật khẩu mới</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="md-input-wrapper">
                                        <input type="password" name="confirmpassword" class="md-form-control"
                                            required="required">
                                        <label>Xác nhận mật khẩu</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-10 offset-xs-1">
                                    <button name="submit" type="submit"
                                        class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">XÁC NHẬN</button>
                                </div>
                            </div>
                        </form>
                        <a href="index.php" STYLE="font-family:times new roman">Trở lại</a>
                        <div class="clearfix"> </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>

</body>

</html>