<?php
include('../includes/dbconnection.php');
if(!empty($_POST["cat_id"])) 
{
 $id=intval($_POST['cat_id']);
$query=mysqli_query($con,"SELECT * FROM tbltheloaiphu WHERE TheloaiId=$id");
?>
<option value="">Chọn thể loại phụ</option>
<?php
 while($row=mysqli_fetch_array($query))
 {
  ?>
  <option value="<?php echo htmlentities($row['Id']); ?>"><?php echo htmlentities($row['theloaiphu']); ?></option>
  <?php
 }
}
?>