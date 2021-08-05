<?php
    include('../connect/connection.php');
    session_start();
    error_reporting(0);
    if($_SESSION['masinhvien'] == 0){
        header('location:view/home.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ======== Boxicons ======= -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Lớp học</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div class="app">
        <?php
            include("header.php");
        ?>
        <div class="container">
        	<div class="container-list">
                <?php
                $masinhvien = $_SESSION['masinhvien'];
                $query = mysqli_query($con,"select tblgiaovien.tengiaovien as tengiaovien,tbllop.tenlop as tenlop,tbllop.malop as malop,tbldoan.tendoan as tendoan,tblphancong.madoan as madoan,tblphancong.masinhvien as masinhvien,tblphancong.magiaovien as magiaovien from tblphancong join tbldoan on tblphancong.madoan = tbldoan.madoan join tblgiaovien on tblphancong.magiaovien = tblgiaovien.magiaovien join tbluser on tblphancong.masinhvien = tbluser.masinhvien join tbllop on tbluser.malop = tbllop.malop where tblphancong.masinhvien = '$masinhvien' group by masinhvien");
                while ($row = mysqli_fetch_array($query)) {
                    ?>
                    <div class="container-item">
                    <div class="container-item-header">
                        <div class="container-item-header-title">
                            <div class="container-item-title">
                                <a href="exercise.php?id=<?php echo $row['malop'] ?>" style="color:white">
                                    <?php echo $row['tenlop']?>
                                </a>
                            </div>
                            <i class="container-item-icon fal fa-ellipsis-v"></i>
                            <div class="action">
                                <p>Hủy đăng ký</p>
                            </div>
                        </div>
                        <div class="container-item-our"><?php echo $row['tengiaovien'] ?></div>
                    </div>
                    <div class="container-iem-img">
                        <img src="../img/nguoinhen.png">
                    </div>
                    <div class="container-item-body">
                        <div class="container-item-body-links">
                            <?php  
                                $query1 = mysqli_query($con,"select tbldoan.tendoan,tbldoan.madoan from tblphancong join tbldoan on tblphancong.madoan = tbldoan.madoan where tblphancong.masinhvien = '$masinhvien'");
                                while ($row1 = mysqli_fetch_array($query1)) {
                            ?>
                                  <a href="exercise.php?id=<?php echo $row['malop'] ?>&&idda=<?php echo $row1['madoan'] ?>" class="container-item-body-link"><?php echo $row1['tendoan']; ?></a>  
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <div class="container-item-footer">
                        <i class="container-item-footer-icon fas fa-id-card-alt"></i>
                    </div>
                </div>
                    <?php
                }
                ?>
        	</div>
        </div>
    </div>
    <script type="text/javascript" src="../js/index.js"></script>
</body>
</html>