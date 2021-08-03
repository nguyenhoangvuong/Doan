<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
    header('location:logout.php');
    } 
  else{
      $pid = intval($_GET['id']);
      if(isset($_POST['submit']))
      {
          $productname=$_POST['productName'];
          $productimage3=$_FILES["productimage3"]["name"];

          move_uploaded_file($_FILES["productimage3"]["tmp_name"],"productimages/$pid/".$_FILES["productimage3"]["name"]);
          $sql = mysqli_query($con,"update tblsanpham set Hinhanh3 = '$productimage3' where Id = '$pid'");
          if($sql){
              $msg="Cập nhật thành công !!";
          }else{
              $msg="Cập nhật thất bại !!";
          }
          
      
      }?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>Admin | Sửa hình ảnh 3</title>
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
    <script>
    function getSubcat(val) {
        $.ajax({
            type: "POST",
            url: "get_subcat.php",
            data: 'cat_id=' + val,
            success: function(data) {
                $("#subcategory").html(data);
            }
        });
    }
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
                        <div class="form-body">
                            <form class="form-horizontal row-fluid" name="insertproduct" method="post"
                                enctype="multipart/form-data">
                                <p style="font-size:16px; color:red" align="center">
                                    <?php 
                                if($msg){
                                    echo $msg;
                                }
                                ?> </p>
                                <?php $query = mysqli_query($con,"select Tensanpham,Hinhanh3 from tblsanpham where Id='$pid'");
                                        $cnt = 1;
                                        while($row=mysqli_fetch_array($query))
									{
                                ?>
                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Tên sản phẩm</label>
                                        <input type="text" name="productName" readonly value="<?php echo htmlentities($row['Tensanpham']);?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Hình hiện tại</label>
                                    <br>
                                    <img src="productimages/<?php echo $pid ?>/<?php echo $row['Hinhanh3'] ?>" width="200" height="200">
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Hình mới</label>
                                    <input type="file" name="productimage3" id="productimage3" value="">
                                </div>
                                <?php }?>

                                <div class="form-group">
                                        <button class="btn btn-default" name="submit">Cập nhật</button>
                                </div>
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