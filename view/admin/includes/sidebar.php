  <style>
      #ab{

      }
  </style>
  <div class=" sidebar" role="navigation">
      <div class="navbar-collapse">
          <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
              <ul class="nav" id="side-menu">
                  <li>
                      <a href="dashboard.php"><i class="fa fa-home nav_icon"></i>Dashboard</a>
                  </li>
                  <li>
                      <a href="manage-nienkhoa.php"><i class="fa fa-cogs nav_icon"></i>Quản lý niên khóa</a>
                      <ul class="nav nav-second-level collapse">
                          <li>
                              <a href="manage-services.php">Quản lý dịch vụ</a>
                          </li>
                          <li>
                              <a href="manage-category.php">Quản lý thể loại</a>
                          </li>
                          <li>
                              <a href="manage-subcategory.php">Quản lý thể loại phụ</a>
                          </li>
                          <li>
                              <a href="manage-product.php">Quản lý sản phẩm </a><a href="insert-product.php"><h4 style="position:fixed;left:190px;top:337px;" class="btn btn-primary">Thêm mới</h4></a>
                          </li>
                      </ul>
                  </li>
                  <li>
                      <a href="khoa.php"><i class="fa fa-book nav_icon"></i>Khoa</a>
                  </li>
                  <li>
                      <a href="all-appointment.php"><i class="fa fa-check-square-o nav_icon"></i>Quản lý sinh viên<span class="fa arrow"></span></a>
                      <ul class="nav nav-second-level collapse">
                          <li>
                              <a href="all-appointment.php">Tất cả cuộc hẹn
                              <?php
                                $result = mysqli_query($con,"select * from tblcuochen");
                                $num_rows1 = mysqli_num_rows($result);
                                {
                                ?>
                             <b class="label orange pull-right" style="background-color:#ffff00;color:black;font-size:1rem;"><?php echo $num_rows1; ?></b>
                            <?php } ?>
                              </a>
                          </li>
                          <li>
                              <a href="new-appointment.php">Cuộc hẹn mới
                              <?php
                                $result = mysqli_query($con,"select *from  tblcuochen where Trangthai=''");
                                $num_rows1 = mysqli_num_rows($result);
                                {
                                ?>
                             <b class="label orange pull-right" style="background-color:#ffffff;color:black;font-size:1rem;"><?php echo $num_rows1; ?></b>
                            <?php } ?>
                              </a>
                          </li>
                          <li>
                              <a href="accepted-appointment.php">Cuộc hẹn được chấp nhận
                              <?php
                                $result = mysqli_query($con,"select *from  tblcuochen where Trangthai='1'");
                                $num_rows1 = mysqli_num_rows($result);
                                {
                                ?>
                             <b class="label orange pull-right" style="background-color:#4CAF50;color:black;font-size:1rem;"><?php echo $num_rows1; ?></b>
                            <?php } ?>
                              </a>
                          </li>
                          <li>
                              <a href="rejected-appointment.php">Cuộc hẹn đã từ chối
                              <?php
                                $result = mysqli_query($con,"select *from  tblcuochen where Trangthai='2'");
                                $num_rows1 = mysqli_num_rows($result);
                                {
                                ?>
                             <b class="label orange pull-right" style="background-color:#ff5252;color:black;font-size:1rem;"><?php echo $num_rows1; ?></b>
                            <?php } ?>
                              </a>
                          </li>
                      </ul>
                  </li>
                  
                  <li>
                  <a href="invoices.php"><i class="fa fa-file-text-o nav_icon"></i>Quản lý giáo viên<span class="fa arrow"></span></a>
                      <ul class="nav nav-second-level collapse">
                          <li>
                              <a href="invoices.php?trang=1">Hóa đơn tại quầy
                              <?php
         
                                $result = mysqli_query($con,"select distinct tblkhachhang.Ten,tblhoadon.BillId,tblhoadon.NgayDang from tblkhachhang   
                                join tblhoadon on tblkhachhang.ID=tblhoadon.Userid");
                                $num_rows1 = mysqli_num_rows($result);
                                {
                                ?>
                             <b class="label orange pull-right" style="background-color:#DD6777;color:black;font-size:1rem;"><?php echo $num_rows1; ?></b>
                            <?php } ?>
                              </a>
                          </li>
                          <li>
                              <a href="today-order.php?oid=">Đơn trong ngày
                              <?php
                                $f1="00:00:00";
                                $from=date('Y-m-d')." ".$f1;
                                $t1="23:59:59";
                                $to=date('Y-m-d')." ".$t1;
                                $result = mysqli_query($con,"select * from tblorders where Ngayorder Between '$from' and '$to'");
                                $num_rows1 = mysqli_num_rows($result);
                                {
                                ?>
                             <b class="label orange pull-right" style="background-color:#ffff00;color:black;font-size:1rem;"><?php echo $num_rows1; ?></b>
                            <?php } ?>
                        </a>
                          </li>
                          <li>
                              <a href="pendding-order.php">Đơn hàng đang chờ
                                <?php	
                                    $ret = mysqli_query($con,"select * from tblorders where Tinhtrangorder='In Process' || Tinhtrangorder is null");
                                    $num = mysqli_num_rows($ret);
                                    {?><b class="label orange pull-right" style="background-color:#33FFFF;color:black;font-size:1rem;"><?php echo $num; ?></b>
                                    <?php 
                                    } 
                                ?>
                               </a>
                          </li>
                          <li>
                              <a href="delivered-order.php">Đơn hàng đã giao
                              <?php	
                                    $status='Delivered';									 
                                    $ret = mysqli_query($con,"select * from tblorders where Tinhtrangorder ='$status'");
                                    $num = mysqli_num_rows($ret);
                                    {?><b class="label orange pull-right" style="background-color:#00FF00;color:black;font-size:1rem;"><?php echo $num; ?></b>
                                    <?php 
                                    } 
                                ?>
                              </a>
                          </li>
                          <li>
                              <a href="cancelled.php">Đơn hàng đã hủy
                              <?php	
                                    $status1='Cancelled';									 
                                    $ret = mysqli_query($con,"select * from tblorders where Tinhtrangorder ='$status1'");
                                    $num = mysqli_num_rows($ret);
                                    {?><b class="label orange pull-right" style="background-color:lightblue;color:black;font-size:1rem;"><?php echo $num; ?></b>
                                    <?php 
                                    } 
                                ?>
                              </a>
                          </li>
                      </ul>
                  </li>
                  
                  <li>
                  <a href="customer-list.php"><i class="fa fa-user nav_icon"></i>Quản lý lớp<span
                              class="fa arrow"></span></a>
                      <ul class="nav nav-second-level collapse">
                          <li>
                              <a href="customer-list.php">Danh sách khách hàng
                              <?php	
                                    $status='Delivered';									 
                                    $ret = mysqli_query($con,"select *from  tblkhachhang ");
                                    $num = mysqli_num_rows($ret);
                                    {?><b class="label orange pull-right" style="background-color:#00FF00;color:black;font-size:1rem;"><?php echo $num; ?></b>
                                    <?php 
                                    } 
                                ?>
                              </a>
                          </li>
                          <li>
                              <a href="user-list.php">Danh sách người dùng</a>
                          </li>
                          <li>
                              <a href="user-log.php?trang=1">Nhật ký người dùng</a>
                          </li>
                      </ul>
                  </li>
                  <li>
                      <a href="bwdates-reports-ds.php"><i class="fa fa-check-square-o nav_icon"></i>Quản lý đồ án<span class="fa arrow"></span></a>
                      <ul class="nav nav-second-level collapse">
                          <li><a href="bwdates-reports-ds.php"> Báo cáo giữa các ngày</a></li>
                          <!-- <li><a href="sales-reports.php">Báo cáo offline</a></li> -->
                          <li><a href="sales-reports-1.php">Báo cáo bán hàng online</a></li>
                      </ul>
                  </li>
              </ul>
              <div class="clearfix"> </div>
          </nav>
      </div>
  </div>