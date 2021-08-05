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
        $doan=$_POST['doan'];
        $giaovien = $_POST['giaovien'];
        $sinhvien = $_POST['sinhvien'];
        $sql=mysqli_query($con,"insert into tblphancong(madoan,magiaovien,masinhvien) values('$doan','$giaovien','$sinhvien')");
        if($sql){
            $_SESSION['msg']="Phân công thành công!!";
        }
    }
    
    if(isset($_GET['del']))
      {
          mysqli_query($con,"delete from tblphancong where maphancong = '".$_GET['id']."'");
          $_SESSION['delmsg']="Xóa thành công !!";
      }
    
  ?>
<!DOCTYPE HTML>
<html lang="en">
    
<head>
    <title>SPA || Phân công đồ án</title>
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
                                <h3 style="font-family:times new roman;width:100%;text-align:center">Phân công</h3>
                            </div>
                            <div class="modal-body">
                                <div class="form-body">
                                    <form method="post">
                                        <p style="font-size:16px; color:red" align="center">
                                            <?php if($msg){
                                    echo $msg;
                                }  ?> </p>
                                         <div class="form-group"> <label for="exampleInputPassword1">Chọn đồ án</label>
                                            <div class="controls">
                                                <select name="doan" class="form-control" required>
                                                    <option value="">Chọn đồ án</option>
                                                    <?php $query=mysqli_query($con,"select * from tbldoan");
                                            while($row=mysqli_fetch_array($query))
                                            {?>
                                                    <option value="<?php echo $row['madoan'];?>">
                                                        <?php echo $row['tendoan'];?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group"> <label for="exampleInputPassword1">Chọn giáo viên</label>
                                            <div class="controls">
                                                <select name="giaovien" class="form-control" required>
                                                    <option value="">Chọn giáo viên</option>
                                                    <?php $query=mysqli_query($con,"select * from tblgiaovien");
                                            while($row=mysqli_fetch_array($query))
                                            {?>
                                                    <option value="<?php echo $row['magiaovien'];?>">
                                                        <?php echo $row['tengiaovien'];?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group"> <label for="exampleInputPassword1">Chọn sinh viên</label>
                                            <div class="controls">
                                                <select name="sinhvien" class="form-control" required>
                                                    <option value="">Chọn sinh viên</option>
                                                    <?php $query=mysqli_query($con,"select * from tbluser where quyen = 'sinhvien'");
                                            while($row=mysqli_fetch_array($query))
                                            {?>
                                                    <option value="<?php echo $row['masinhvien'];?>">
                                                        <?php echo $row['hoten'];?></option>
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
                        <h4>Danh sách phân công đồ án <button id="myBtn" class="btn btn-primary">Phân công đồ án</button></h4>
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
                                    <th>Mã đồ án / Tên đồ án</th>
                                    <th>Mã giáo viên / Tên giáo viên hướng dẫn</th>
                                    <th>Mã sinh viên / Tên sinh viên</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php
                                        $ret=mysqli_query($con,"select tblphancong.*,tbldoan.tendoan,tblgiaovien.tengiaovien,tbluser.hoten from tblphancong join tblgiaovien on tblphancong.magiaovien = tblgiaovien.magiaovien join tbldoan on tblphancong.madoan = tbldoan.madoan join tbluser on tblphancong.masinhvien = tbluser.masinhvien");
                                        $cnt=1;
                                        while ($row=mysqli_fetch_array($ret)) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $cnt;?></th>
                                        <td><?php  echo $row['madoan'].' / '.$row['tendoan'];?></td>
                                        <td><?php  echo $row['magiaovien'].' / '.$row['tengiaovien'];?></td>
                                        <td><?php  echo $row['masinhvien'].' / '.$row['hoten'];?></td>
                                        <td><a
                                                href="phancong.php?id=<?php echo $row['maphancong']?>&del=delete"
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