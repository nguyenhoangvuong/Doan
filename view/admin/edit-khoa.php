<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['masinhvien']==0)) {
  header('location:view/home.php');
  } else{
    $idkhoa = $_GET['editid'];

if(isset($_POST['submit']))
  {
  	$sername=$_POST['sername'];
    $pagedes=$_POST['pagedes'];
    $truongphong=$_POST['truongphong'];
    $query=mysqli_query($con, "update  tblkhoa set tenkhoa='$sername',mota='$pagedes',truongkhoa = '$truongphong' where makhoa='$idkhoa'");
    if ($query) {
        $msg="Dịch vụ đã được cập nhật !";
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
    <title>Khoa</title>
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
                                <?php $query4 = mysqli_query($con,"select tblkhoa.tenkhoa as tenkhoa,tblkhoa.makhoa,tblkhoa.mota,tblkhoa.truongkhoa as truongkhoa,tblgiaovien.tengiaovien from tblkhoa join tblgiaovien on tblkhoa.truongkhoa = tblgiaovien.magiaovien where tblkhoa.makhoa = '$idkhoa'");
                                $row4 = mysqli_fetch_array($query4);
                                 ?>
                                <div class="form-group"> <label for="exampleInputPassword1">Tên khoa</label>
                                    <input type="text" id="sername" name="sername" class="form-control"
                                        placeholder="Tên khoa" value="<?php echo $row4['tenkhoa'] ?>" required="true"> </div>
                                <div class="form-group"> <label for="exampleInputPassword1">Mô tả</label>
                                <textarea name="pagedes" id="pagedes" rows="7" class="form-control"><?php echo $row4['mota']; ?></textarea></div>
                                <div class="form-group"> <label for="exampleInputPassword1">Chọn trưởng phòng</label>
                                    <div class="controls">
                                        <select name="truongphong" class="form-control" required>
                                            <option value="<?php echo $row4['truongkhoa'] ?>"><?php echo $managername=$row4['tengiaovien'] ?></option>
                                            <?php $query5=mysqli_query($con,"select * from tblgiaovien");
                                            while($row5=mysqli_fetch_array($query5))
                                            {
                                            echo $manager=$row5['tengiaovien'];
                                            if($managername == $manager){
                                                continue;
                                            }else{
                                            ?>
                                            <option value="<?php echo $row5['magiaovien'];?>">
                                                <?php echo $row5['tengiaovien'];?></option>
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