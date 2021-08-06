<div class="sticky-header header-section ">
      <div class="header-left">
        <button id="showLeftPush"><i class="fa fa-bars"></i></button>
        <div class="logo">
          <a href="dashboard.php">
            <h1>Plagiarisma</h1>
            <span>UTC2</span>
          </a>
        </div>
        <div class="clearfix"> </div>
      </div>
      <div class="header-right">
        <div class="profile_details_left">
          <ul class="nofitications-dropdown">
            <?php
              $ret1=mysqli_query($con,"select ID,Ten from  tblcuochen where Trangthai =''");
              $num=mysqli_num_rows($ret1);
            ?>  
            <li class="dropdown head-dpdn">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i></a>
              
              <ul class="dropdown-menu">
                <li>
                  <div class="notification_header">
                    <h3>Bạn có <?php echo $num;?> thông báo mới</h3>
                  </div>
                </li>
                <li>
                   <div class="notification_desc">
                     <?php if($num>0){
                        while($result=mysqli_fetch_array($ret1))
                        {
                    ?>
                  <a class="dropdown-item" href="view-appointment.php?viewid=<?php echo $result['ID'];?>"> + Cuộc hẹn mới được nhận từ <?php echo $result['Ten'];?> </a><br />
                  <?php }} else {?>
                      <a class="dropdown-item" href="all-appointment.php">Không có cuộc hẹn mới nào được nhận</a>
                        <?php } ?>
                  </div>
                  <div class="clearfix"></div>  
                 </a></li>
                 <li>
                  <div class="notification_bottom">
                    <a href="new-appointment.php">Xem tất cả</a>
                  </div> 
                </li>
              </ul>
            </li> 
          </ul>
          <div class="clearfix"> </div>
        </div>
        <div class="profile_details">  
        <?php
          $adid=$_SESSION['masinhvien'];
          $ret=mysqli_query($con,"select hoten from tbluser where masinhvien='$adid' and quyen = 'admin'");
          $row=mysqli_fetch_array($ret);
          $name=$row['hoten'];

        ?> 
          <ul>
            <li class="dropdown profile_details_drop">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <div class="profile_img"> 
                  <span class="prfil-img"><img src="images/download (1).png" alt="" width="50" height="40"> </span> 
                  <div class="user-name">
                    <p><?php echo $name; ?></p>
                    <span>Admin</span>
                  </div>
                  <i class="fa fa-angle-down lnr"></i>
                  <i class="fa fa-angle-up lnr"></i>
                  <div class="clearfix"></div>  
                </div>  
              </a>
              <ul class="dropdown-menu drp-mnu">
                <li> <a href="change-password.php"><i class="fa fa-cog"></i> Settings</a> </li> 
                <li> <a href="admin-profile.php"><i class="fa fa-user"></i> Profile</a> </li> 
                <li> <a href="http://localhost:8080/QuanLyDoAn/index.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
              </ul>
            </li>
          </ul>
        </div>  
        <div class="clearfix"> </div> 
      </div>
      <div class="clearfix"> </div> 
    </div>