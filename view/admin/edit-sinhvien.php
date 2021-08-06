<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['masinhvien']==0)) {
  header('location:view/home.php');
  } else{
    $idsinhvien = $_GET['editid'];

if(isset($_POST['submit']))
  {
    $hoten=$_POST['hoten'];
    $sodienthoai = $_POST['sodienthoai'];
    $diachi = $_POST['diachi'];
    $email = $_POST['email'];
    $lop = $_POST['lop'];
    $query=mysqli_query($con, "update  tbluser set hoten = '$hoten',sodienthoai = '$sodienthoai',diachi = '$diachi',email = 'email',malop = '$lop' where masinhvien='$idsinhvien'");
    if ($query) {
        $msg="Sinh viên đã được cập nhật !".$birthdate;
    }
     else
    {
      $msg="Đã xảy ra lỗi. Vui lòng thử lại !";
    }
}
  ?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>Sinh viên</title>
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
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">
    bkLib.onDomLoaded(nicEditors.allTextAreas);
    </script>
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
                            <h4>Cập nhật khoa</h4>
                        </div>
                        <div class="form-body">
                            <form method="post">
                                <p style="font-size:16px; color:red" align="center">
                                    <?php if($msg){
                                        echo $msg;
                                    }?> 
                                </p>
                                <?php $query4 = mysqli_query($con,"select tbluser.*,tbllop.malop,tbllop.tenlop FROM tbluser join tbllop on tbluser.malop = tbllop.malop WHERE tbluser.masinhvien = '$idsinhvien'");
                                $row4 = mysqli_fetch_array($query4);
                                 ?>
                                <div class="form-group"> <label for="exampleInputPassword1">Họ tên</label>
                                <input type="text" id="hoten" name="hoten" class="form-control"
                                    placeholder="Họ tên" value="<?php echo $row4['hoten'] ?>" required="true"> </div>
                                <div class="form-group"> <label for="exampleInputPassword1">Ngày sinh</label>
                                    <div class="form-group"> <label for="exampleInputPassword1">Số điện thoại</label>
                                <input type="text" id="sodienthoai" name="sodienthoai" class="form-control"
                                    placeholder="Số điện thoại" value="<?php echo $row4['sodienthoai'] ?>" required="true"> </div>
                                    <div class="form-group"> <label for="exampleInputPassword1">Địa chỉ</label>
                                <input type="text" id="diachi" name="diachi" class="form-control"
                                    placeholder="Địa chỉ" value="<?php echo $row4['diachi'] ?>" required="true"> </div>
                                    <div class="form-group"> <label for="exampleInputPassword1">Email</label>
                                <input type="text" id="email" name="email" class="form-control"
                                    placeholder="Email" value="<?php echo $row4['email'] ?>" required="true"> </div>
                                <div class="form-group"> <label for="exampleInputPassword1">Chọn lớp</label>
                                    <div class="controls">
                                        <select name="lop" class="form-control" required>
                                            <option value="<?php echo $row4['malop'] ?>"><?php echo $managername=$row4['tenlop'] ?></option>
                                            <?php $query5=mysqli_query($con,"select * from tbllop");
                                            while($row5=mysqli_fetch_array($query5))
                                            {
                                            echo $manager=$row5['tenlop'];
                                            if($managername == $manager){
                                                continue;
                                            }else{
                                            ?>
                                            <option value="<?php echo $row5['malop'];?>">
                                                <?php echo $row5['tenlop'];?></option>
                                            <?php } }?>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>
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