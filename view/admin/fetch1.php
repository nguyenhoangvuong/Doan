<?php
include('includes/dbconnection.php');
$sear= $_POST['search'];
$ret=mysqli_query($con,"select * from  tblcuochen where Ten like '%$sear%' || Socuochen like '%$sear%' || Ngayhen like '%$sear%' order by Ngayhen desc");
$result = mysqli_num_rows($ret);
if($result > 0){
    ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Số cuộc hẹn</th>
            <th>Tên</th>
            <th>Sô điện thoại</th>
            <th>Ngày hẹn</th>
            <th>Thời gian hẹn</th>
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
            <td><?php  echo $row['Socuochen'];?></td>
            <td><?php  echo $row['Ten'];?></td>
            <td><?php  echo $row['Sodienthoai'];?></td>
            <td><?php  echo $row['Ngayhen'];?></td>
            <td><?php  echo $row['Giohen'];?></td>
            <td><a href="view-appointment.php?viewid=<?php echo $row['ID'];?>">Xem</a></td>
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