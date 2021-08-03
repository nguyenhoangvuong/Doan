<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
    header('location:logout.php');
    } 
  else{
      $pid = intval($_GET['editid']);
      if(isset($_POST['submit']))
      {
          $category=$_POST['category'];
          $subcat=$_POST['subcategory'];
          $productname=$_POST['productName'];
          $productcompany=$_POST['productCompany'];
          $productprice=$_POST['productprice'];
          $productpricebd=$_POST['productpricebd'];
          $productdescription=$_POST['productDescription'];
          $productscharge=$_POST['productShippingcharge'];
          $productavailability=$_POST['productAvailability'];
          $sql=mysqli_query($con,"update tblsanpham set TheloaiId='$category',TheloaiphuId='$subcat',Tensanpham='$productname',Sanphamcongty='$productcompany',Giasanpham='$productprice',Motasanpham='$productdescription',Phivanchuyen='$productscharge',Sanphamcosan='$productavailability',Giasanphamtruockhigiam='$productpricebd' where Id = '$pid'");
          
          if($sql){
              $msg="Cập nhật thành công !!";
          }else{
              $msg="Cập nhật thất bại !!";
          }
          
      
      }?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>Admin | Sửa sản phẩm</title>
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
                    <div class="form-title">
                            <h4>Sửa sản phẩm <a href="manage-product.php" type="submit" name="submit" class="btn btn-default">Trở lại</a></h4>
                        </div>
                        <div class="form-body">
                        <form class="form-horizontal row-fluid" name="insertproduct" method="post"
                                enctype="multipart/form-data">
                                <p style="font-size:16px; color:red" align="center">
                                    <?php 
                                if($msg){
                                    echo $msg;
                                }
                                ?> </p>

                                <?php 

								$query=mysqli_query($con,"select tblsanpham.*,tbltheloai.Tentheloai as catname,tbltheloai.Id as cid,tbltheloaiphu.theloaiphu as subcatname,tbltheloaiphu.Id as subcatid from tblsanpham join tbltheloai on tbltheloai.Id=tblsanpham.TheloaiId join tbltheloaiphu on tbltheloaiphu.Id=tblsanpham.TheloaiphuID where tblsanpham.Id='$pid'");
								$cnt=1;
								while($row=mysqli_fetch_array($query))
								{
								?>
                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Thể loại</label>
                                    <div class="controls">
                                        <select name="category" class="form-control" onChange="getSubcat(this.value);"
                                            required>
                                            <option value="<?php echo htmlentities($row['cid']);?>">
                                                <?php echo htmlentities($row['catname']);?></option>
                                            <?php $query=mysqli_query($con,"select * from tbltheloai");
											while($rw=mysqli_fetch_array($query))
											{
												if($row['catname']==$rw['Tentheloai'])
												{
													continue;
												}
												else{
												?>
                                            <option value="<?php echo $rw['Id'];?>">
                                                <?php echo $rw['Tentheloai'];?></option>
                                            <?php }} ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Thể loại phụ</label>
                                    <div class="controls">

                                        <select name="subcategory" id="subcategory" class="form-control" required>
                                            <option value="<?php echo htmlentities($row['subcatid']);?>">
                                                <?php echo htmlentities($row['subcatname']);?></option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Tên sản phẩm</label>
                                    <div class="controls">
                                        <input type="text" name="productName" placeholder="Nhập tên sản phẩm"
                                            value="<?php echo htmlentities($row['Tensanpham']);?>" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Sản phẩm công ty</label>
                                    <div class="controls">
                                        <input type="text" name="productCompany"
                                            placeholder="Nhập công ty của sản phẩm"
                                            value="<?php echo htmlentities($row['Sanphamcongty']);?>" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Giá sản phẩm trước khi giảm</label>
                                    <div class="controls">
                                        <input type="text" name="productpricebd" placeholder="Nhập giá trước khi giảm"
                                            value="<?php echo htmlentities($row['Giasanphamtruockhigiam']);?>"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Giá sản phẩm</label>
                                    <div class="controls">
                                        <input type="text" name="productprice" placeholder="Nhập giá"
                                            value="<?php echo htmlentities($row['Giasanpham']);?>" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Mô tả sản phẩm</label>
                                    <div class="controls">
                                        <textarea name="productDescription" placeholder="Nhập mô tả"
                                            rows="6" class="form-control">
											<?php echo $row['Motasanpham'];?>
										</textarea>
                                    </div>

									
                                </div>
								

                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Phí vận chuyển</label>
                                    <div class="controls">
                                        <input type="text" name="productShippingcharge"
                                            placeholder="Nhập phí vận chuyển"
                                            value="<?php echo htmlentities($row['Phivanchuyen']);?>" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Sản phẩm có sẵn</label>
                                    <div class="controls">
                                        <select name="productAvailability" id="productAvailability" class="form-control"
                                            required>
                                            <option value="<?php echo htmlentities($row['Sanphamcosan']);?>">
                                                <?php echo htmlentities($row['Sanphamcosan']);?></option>
                                            <option value="In Stock">Còn hàng</option>
                                            <option value="Out of stock">Hết hàng</option>
                                        </select>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Hình ảnh 1</label>
                                    <div class="controls">
                                        <img src="productimages/<?php echo htmlentities($pid);?>/<?php echo htmlentities($row['Hinhanh1']);?>"
                                            width="200" height="200"> <a
                                            href="update-image1.php?id=<?php echo $row['Id'];?>">Thay đổi ảnh</a>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Hình ảnh 2</label>
                                    <div class="controls">
                                        <img src="productimages/<?php echo htmlentities($pid);?>/<?php echo htmlentities($row['Hinhanh2']);?>"
                                            width="200" height="200"> <a
                                            href="update-image2.php?id=<?php echo $row['Id'];?>">Thay đổi ảnh</a>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Hình ảnh 3</label>
                                    <div class="controls">
                                        <img src="productimages/<?php echo htmlentities($pid);?>/<?php echo htmlentities($row['Hinhanh3']);?>"
                                            width="200" height="200"> <a
                                            href="update-image3.php?id=<?php echo $row['Id'];?>">Thay đổi ảnh</a>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="form-group">
                                    <div class="controls">
                                        <button type="submit" name="submit" class="btn btn-default" style="width:200px">Cập nhật</button>
                                    </div>
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