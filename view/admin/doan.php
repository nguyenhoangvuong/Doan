<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['masinhvien']==0)) {
  header('location:view/home.php');
  } 
  else{
    mysqli_query($con,"update tbldoan set tinhtrang ='đã giao' where tbldoan.madoan in (SELECT tblphancong.madoan FROM tblphancong)");

    if(isset($_POST['submit']))
    {
        $tendoan=$_POST['tendoan'];
        $mota = $_POST['mota'];
        $deadline = $_POST['deadline'];
        $sql=mysqli_query($con,"insert into tbldoan(tendoan,mota,deadline) values('$tendoan','$mota','$deadline')");
        if($sql){
            $_SESSION['msg']="Tạo đồ án thành công!!";
        }
    }
    
    if(isset($_GET['del']))
      {
          mysqli_query($con,"delete from tbldoan where madoan = '".$_GET['id']."'");
          $_SESSION['delmsg']="Xóa thành công !!";
      }
      // if(isset($_POST['chamdiem'])){
      //   $diem = $_POST['diem'];
      //   $id = $_POST['iddaan'];
      //   $sql=mysqli_query($con,"update tbldoan set diem = '$diem' where madoan = '$id'");
      // }
    
  ?>
<!DOCTYPE HTML>
<html lang="en">
    
<head>
    <title>Quản lý đồ án</title>
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
                                <h3 style="font-family:times new roman;width:100%;text-align:center">Thêm đồ án</h3>
                            </div>
                            <div class="modal-body">
                                <div class="form-body">
                                    <form method="post">
                                        <p style="font-size:16px; color:red" align="center">
                                            <?php if($msg){
                                    echo $msg;
                                }  ?> </p>
                                         <div class="form-group"> <label for="exampleInputPassword1">Tên đồ án</label>
                                            <input type="text" id="tendoan" name="tendoan" class="form-control"
                                                placeholder="Tên đồ án" value="" required="true"> </div>
                                        <div class="form-group"> <label for="exampleInputPassword1">Mô tả</label>
                                            <input type="text" id="mota" name="mota" class="form-control"
                                                placeholder="Mô tả" value="" required="true"> </div>
                                            <div class="form-group"> <label for="exampleInputPassword1">Deadline</label>
                                        <input type="date" id="deadline" name="deadline" class="form-control"
                                            placeholder="Sĩ số" value="" required="true"> </div>
                                        
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
                        <h4>Danh sách đồ án <button id="myBtn" class="btn btn-primary">Thêm đồ án</button></h4>
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
                                    <th>Link download</th>
                                    <th>Mô tả</th>
                                    <th>Điểm</th>
                                    <th>Ngày đăng</th>
                                    <th>deadline</th>
                                    <th>Tình trạng</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php
                                        $ret=mysqli_query($con,"select * from tbldoan");
                                        $cnt=1;
                                        while ($row=mysqli_fetch_array($ret)) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $cnt;?></th>
                                        <td><?php  echo $row['madoan'].' / '.$row['tendoan'];?></td>
                                        <td>
                                            <?php  
                                            if($row['done'] != ''){
                                                ?>
                                                <a href="<?php echo $row['duongdan'] ?>"><?php echo $row['name'];?></a>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td><?php  echo $row['mota'];?></td>
                                        <td><?php  echo $row['diem'];?></td>
                                        <td><?php  echo $row['ngaydang'];?></td>
                                        <td><?php  echo $row['deadline'];?></td>
                                        <td><?php  echo $row['tinhtrang'];?></td>
                                        <td>
                                            <?php 
                                            if($row['name'] != ''){
                                                ?>
                                                <a href="chamdiem.php?id=<?php echo $row['madoan'] ?>">Chấm điểm</a> ||
                                                <a target="_blank" href="http://localhost:8080/QuanLyDoAn/view/uploads/<?php echo $row['new_name'];?>">Xem file</a> || 
                                                <?php
                                                }
                                             ?>
                                         <a href="doan.php?id=<?php echo $row['madoan']?>&del=delete"
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