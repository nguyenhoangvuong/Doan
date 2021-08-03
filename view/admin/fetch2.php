<?php
include('includes/dbconnection.php');
$sear= $_POST['search'];
$ret=mysqli_query($con,"select distinct tblkhachhang.Ten,tblhoadon.BillId,tblhoadon.NgayDang from tblkhachhang   
join tblhoadon on tblkhachhang.ID=tblhoadon.Userid where tblkhachhang.Ten like '%$sear%' || tblhoadon.BillId like '%$sear%' || tblhoadon.NgayDang like '%$sear%' order by tblhoadon.Ngaydang desc");
$result = mysqli_num_rows($ret);
if($result > 0){
    ?>
<table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID hóa đơn</th>
                                    <th>Tên khách hàng</th>
                                    <th>Ngày hóa đơn</th>
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
                                    <td><?php  echo $row['BillId'];?></td>
                                    <td><?php  echo $row['Ten'];?></td>
                                    <td><?php  echo $row['NgayDang'];?></td>
                                    <td><a href="view-invoice.php?invoiceid=<?php  echo $row['BillId'];?>">Xem chi tiết</a></td>
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