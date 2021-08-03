<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (!function_exists('currency_format')) {
    function currency_format($number, $suffix = 'đ') {
        if (!empty($number)) {
            return number_format($number, 0, ',', '.') . "{$suffix}";
        }
    }
}
    $sear= $_POST['search'];
    $ret=mysqli_query($con,"select * from tbldichvu where Tendichvu like '%$sear%'");
    $result = mysqli_num_rows($ret);
    if($result > 0){
        if(isset($_POST['submit'])){
        ?>
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Succesfull !</strong>
    <?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
</div>
<?php } ?>

<?php
if($_SESSION['msg']){
    echo "<script>alert('".$_SESSION['msg']."')</script>";
    unset($_SESSION['msg']);
}

?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Tên dịch vụ</th>
            <th>Giá dịch vụ</th>
            <th>Ngày tạo</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $cnt=1;
        while ($row=mysqli_fetch_array($ret)) {
            ?>
        <tr>
            <th scope="row"><?php echo $cnt;?></th>
            <td><?php  echo $row['Tendichvu'];?></td>
            <td><?php  echo currency_format($row['Chiphi']);?></td>
            <td><?php  echo $row['Ngaytao'];?></td>
            <td><a href="edit-services.php?editid=<?php echo $row['ID'];?>">Sửa</a> ||
                <a href="manage-services.php?id=<?php echo $row['ID']?>&del=delete"
                    onClick="return confirm('Bạn thực sự muốn xóa ?')"><i class="icon-remove-sign"></i>Xóa</a>
            </td>
        </tr> <?php 
        $cnt=$cnt+1;
        }?>
    </tbody>
</table>
<?php
}else{
    echo '<h4 style="color:red">Không tìm thấy kết quả liên quan đến : "'.$sear.'"</h4>';
}
?>