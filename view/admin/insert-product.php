<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } 
else{
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
        $productimage1=$_FILES["productimage1"]["name"];
        $productimage2=$_FILES["productimage2"]["name"];
        $productimage3=$_FILES["productimage3"]["name"];

        $query=mysqli_query($con,"select max(Id) as pid from tblsanpham");
        $result=mysqli_fetch_array($query);
         $productid=$result['pid']+1;
        $dir="productimages/$productid";
        if(!is_dir($dir)){
            mkdir("productimages/".$productid);
        }
    
        move_uploaded_file($_FILES["productimage1"]["tmp_name"],"productimages/$productid/".$_FILES["productimage1"]["name"]);
        move_uploaded_file($_FILES["productimage2"]["tmp_name"],"productimages/$productid/".$_FILES["productimage2"]["name"]);
        move_uploaded_file($_FILES["productimage3"]["tmp_name"],"productimages/$productid/".$_FILES["productimage3"]["name"]);
        $sql=mysqli_query($con,"insert into tblsanpham(TheloaiId,TheloaiphuId,Tensanpham,Sanphamcongty,Giasanpham,Motasanpham,Phivanchuyen,Sanphamcosan,Hinhanh1,Hinhanh2,Hinhanh3,Giasanphamtruockhigiam) values('$category','$subcat','$productname','$productcompany','$productprice','$productdescription','$productscharge','$productavailability','$productimage1','$productimage2','$productimage3','$productpricebd')");
        
        if($sql){
            $msg="Thêm thành công !!";
        }else{
            $msg="Thêm thất bại !!";
        }
        
    
    }?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>Admin | Thêm sản phẩm</title>
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
                            <h4>Thông tin:</h4>
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
                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Thể loại</label>
                                    <select name="category" class="form-control" onChange="getSubcat(this.value);"
                                        required>
                                        <option value="">Chọn thể loại</option>
                                        <?php $query=mysqli_query($con,"select * from tbltheloai");
                                            while($row=mysqli_fetch_array($query))
                                            {?>
                                        <option value="<?php echo $row['Id'];?>">
                                            <?php echo $row['Tentheloai'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Thể loại phụ</label>
                                    <select name="subcategory" id="subcategory" class="form-control" required>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Tên sản phẩm</label>
                                    <input type="text" name="productName" placeholder="Nhập tên sản phẩm"
                                        class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Sản phẩm công ty</label>
                                    <input type="text" name="productCompany" placeholder="Nhập tên công ty của sản phẩm"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Giá sản phẩm trước khi giảm</label>
                                    <input type="text" name="productpricebd" placeholder="Giá trước khi giảm"
                                        class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Giá sản phẩm sau khi giảm (giá
                                        bán)</label>
                                    <input type="text" name="productprice" placeholder="Nhập giá bán"
                                        class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Mô tả sản phẩm</label>
                                    <textarea name="productDescription" placeholder="Nhập mô tả" rows="6"
                                        class="form-control">
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Phí vận chuyển</label>
                                    <input type="text" name="productShippingcharge" placeholder="Nhập phí vận chuyển"
                                        class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Hàng có sẵn</label>
                                    <select name="productAvailability" id="productAvailability" class="form-control"
                                        required>
                                        <option value="">Chọn</option>
                                        <option value="In Stock">Còn hàng</option>
                                        <option value="Out of Stock">Hết hàng</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Hình ảnh 1</label>
                                    <input type="file" name="productimage1" id="productimage1" value=""
                                        required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="basicinput">hình ảnh 2</label>
                                    <input type="file" name="productimage2"  required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="basicinput">Hình ảnh 3</label>
                                    <input type="file" name="productimage3" required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-default"
                                        style="width:200px">Thêm</button>
                                </div>
                            </form>
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
        <script src="js/jquery.nicescroll.js"></script>
        <script src="js/scripts.js"></script>
        <script src="js/bootstrap.js"> </script>
</body>

</html>
<?php } ?>