<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit']))
  {
    $sername=$_POST['sername'];
    $category=$_POST['category'];
 	$eid=$_GET['editid'];
    $query=mysqli_query($con, "update  tbltheloaiphu set TheloaiId='$category',theloaiphu='$sername' where Id='$eid' ");
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
    <title>SPA | Cập nhật thể loại phụ</title>

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
                            <h4>Cập nhật thể loại phụ</h4>
                        </div>
                        <div class="form-body">
                            <form method="post">
                                <p style="font-size:16px; color:red" align="center"> <?php if($msg){
								echo $msg;
							}  ?> </p>
                                <?php
								$cid=$_GET['editid'];
								$ret=mysqli_query($con,"select tbltheloai.Motatheloai,tbltheloai.Id,tbltheloai.Tentheloai,tbltheloaiphu.theloaiphu from tbltheloaiphu join tbltheloai on tbltheloai.Id=tbltheloaiphu.TheloaiId where tbltheloaiphu.Id='$cid'");
								$cnt=1;
								while ($row=mysqli_fetch_array($ret)) {
							?>
                            <div class="form-group"> <label for="exampleInputPassword1">Tên thể loại phụ</label> <input
                                        type="text" id="sername" name="sername" class="form-control" placeholder="Tên thể loại phụ"
                                        value="<?php  echo $row['theloaiphu'];?>" required="true"> </div>
                                <div class="form-group"> <label for="exampleInputPassword1">Thể loại</label> 
                                    <div class="controls">
                                        <select name="category" class="form-control" required>
                                            <option value="<?php echo $row['Id'] ?>"><?php echo $catname=$row['Tentheloai'] ?></option>
                                            <?php $query=mysqli_query($con,"select * from tbltheloai");
                                            while($row=mysqli_fetch_array($query))
                                            {
                                            echo $cat=$row['Tentheloai'];
                                            if($catname == $cat){
                                                continue;
                                            }else{
                                            ?>
                                            <option value="<?php echo $row['Id'];?>">
                                                <?php echo $row['Tentheloai'];?></option>
                                            <?php } }?>
                                        </select>
                                    </div>
                                </div>
                                <?php 
                            } ?>
                                <button type="submit" name="submit" class="btn btn-default">Cập nhật</button>
                                <a href="./manage-subcategory.php" type="submit" name="submit" class="btn btn-default">Trở lại</a>
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