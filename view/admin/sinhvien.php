<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['masinhvien']==0)) {
  header('location:view/home.php');
  } 
  else{
    if(isset($_POST['submit']))
    {
        $hoten=$_POST['sername'];
        $ngaysinh = $_POST['birthdate'];
        $sodienthoai = $_POST['sodienthoai'];
        $diachi = $_POST['diachi'];
        $email = $_POST['email'];
        $lop = $_POST['lop'];
        $sql=mysqli_query($con,"insert into tbluser(hoten,ngaysinh,sodienthoai,diachi,email,matkhau,malop,quyen) values('$hoten','$ngaysinh','$sodienthoai','$diachi','$email','123','$lop','sinhvien')");
        if($sql){
            $_SESSION['msg']="Tạo sinh viên thành công!!";
        }
    }
    
    if(isset($_GET['del']))
      {
          mysqli_query($con,"delete from tbluser where masinhvien = '".$_GET['id']."'");
          $_SESSION['delmsg']="Xóa thành công !!";
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
        color: #000000;
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
                                <h3 style="font-family:times new roman;width:100%;text-align:center">Thêm sinh viên</h3>
                            </div>
                            <div class="modal-body">
                                <div class="form-body">
                                    <form method="post">
                                        <p style="font-size:16px; color:red" align="center">
                                            <?php if($msg){
                                    echo $msg;
                                }  ?> </p>
                                        <div class="form-group"> <label for="exampleInputPassword1">Họ tên</label>
                                            <input type="text" id="sername" name="sername" class="form-control"
                                                placeholder="Họ tên" value="" required="true"> </div>
                                        <div class="form-group"> <label for="exampleInputPassword1">Ngày sinh</label>
                                            <input type="date" id="birthdate" name="birthdate" class="form-control"
                                                required="true"> </div>
                                                <div class="form-group"> <label for="exampleInputPassword1">Số điện thoại</label>
                                            <input type="text" id="sodienthoai" name="sodienthoai" class="form-control"
                                                placeholder="Số điện thoại" value="" required="true"> </div>
                                                <div class="form-group"> <label for="exampleInputPassword1">Địa chỉ</label>
                                            <input type="text" id="diachi" name="diachi" class="form-control"
                                                placeholder="Địa chỉ" value="" required="true"> </div>
                                                <div class="form-group"> <label for="exampleInputPassword1">Email</label>
                                            <input type="text" id="email" name="email" class="form-control"
                                                placeholder="Email" value="" required="true"> </div>
                                        <div class="form-group"> <label for="exampleInputPassword1">Chọn lớp</label>
                                            <div class="controls">
                                                <select name="lop" class="form-control">
                                                    <option value="">Chọn lớp</option>
                                                    <?php $query=mysqli_query($con,"select * from tbllop");
                                            while($row=mysqli_fetch_array($query))
                                            {?>
                                                    <option value="<?php echo $row['malop'];?>">
                                                        <?php echo $row['tenlop'];?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary">Thêm</button>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <h6 style="font-family:times new roman;width:100%;text-align:center">Admin</h6>
                            </div>
                        </div>

                    </div>

                    <div class="table-responsive bs-example widget-shadow">
                        <h4>Danh sách sinh viên <button id="myBtn" class="btn btn-primary">Thêm sinh viên</button></h4>
                        <?php if(isset($_POST['submit']))
                                {?>
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Succesfull !</strong>
                            <?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
                        </div>

                        <?php } ?>

                        <?php if(isset($_GET['del']))
                                {?>
                        <div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Wrong !</strong>
                            <?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
                        </div>
                        <?php } ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã sinh viên</th>
                                    <th>Họ tên</th>
                                    <th>Ngày Sinh / Số điện thoại / Địa chỉ</th>
                                    <th>Email</th>
                                    <th>Mã lớp / Lớp</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php
                                        $ret=mysqli_query($con,"select tbluser.*,tbllop.tenlop as tenlop from tbluser join tbllop on tbluser.malop = tbllop.malop where quyen = 'sinhvien'");
                                        $cnt=1;
                                        while ($row=mysqli_fetch_array($ret)) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $cnt;?></th>
                                        <td><?php  echo $row['masinhvien'];?></td>
                                        <td><?php  echo $row['hoten'];?></td>
                                        <td><?php  echo $row['ngaysinh'].' / '.$row['sodienthoai'].' / '.$row['diachi'];?></td>
                                        <td><?php  echo $row['email'];?></td>
                                        <?php 
                                        if($row['malop'] == 0){
                                            ?>
                                            <td>Chưa có lớp</td>
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <td><?php  echo $row['malop'].' / '.$row['tenlop'];?></td>
                                            <?php
                                        }
                                        ?>
                                        <td><a href="edit-sinhvien.php?editid=<?php echo $row['masinhvien'];?>">Sửa</a> || <a
                                                href="sinhvien.php?id=<?php echo $row['masinhvien']?>&del=delete"
                                                onClick="return confirm('Bạn chắc chắn muốn xóa ?')"><i
                                                    class="icon-remove-sign"></i>Xóa</a></td>
                                    </tr> <?php 
                                    $cnt=$cnt+1;
                                }?>
                            </tbody>
                        </table>
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