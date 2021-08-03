<?php
include('includes/dbconnection.php');
$sear= $_POST['search'];
$ret=mysqli_query($con,"select *from  tblkhachhang where Ten like '%$sear%' || Sodienthoai like '%$sear%'");
$result = mysqli_num_rows($ret);
if($result > 0){
    ?>
<table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên</th>
                                    <th>Số điện thoại</th>
                                    <th>Ngày tạo</th>
                                    <th style="width:18%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								$cnt=1;
								while ($row=mysqli_fetch_array($ret)) {
							?>
                                <tr>
                                    <th scope="row"><?php echo $cnt;?></th>
                                    <td><?php  echo $row['Ten'];?></td>
                                    <td><?php  echo $row['Sodienthoai'];?></td>
                                    <td><?php  echo $row['Ngaytao'];?></td>
                                    <td><a href="edit-customer-detailed.php?editid=<?php echo $row['ID'];?>">Sửa</a> ||
                                        <a href="add-customer-services.php?addid=<?php echo $row['ID'];?>">Dịch vụ</a> || <a href="add-customer-product.php?addid=<?php echo $row['ID'];?>">Sản phẩm</a></td>
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