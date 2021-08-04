<?php
    include('../connect/connection.php');
    session_start();
    error_reporting(0);
    if($_SESSION['masinhvien'] == 0){
        header('location:view/home.php');
    }else{
        $malop = $_GET['id'];
        $idda = $_GET['idda'];


        // upfile==================================================================

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
    <title>Bài tập</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/exercise.css">
</head>
<body>
    <div class="app">
        <?php
            include("header.php");
        ?>
        <?php 
            $query = mysqli_query($con,"select tblgiaovien.tengiaovien as tengiaovien,tbldoan.ngaydang as ngaydang,tbldoan.diem as diem,tbldoan.deadline as deadline,tbllop.tenlop as tenlop,tbldoan.tendoan as tendoan,tbldoan.madoan as madoan,tblphancong.masinhvien as masinhvien,tblphancong.magiaovien as magiaovien from tblphancong join tbldoan on tbldoan.madoan = '$idda' join tblgiaovien on tblphancong.magiaovien = tblgiaovien.magiaovien join tbluser on tblphancong.masinhvien = tbluser.masinhvien join tbllop on tbluser.malop = '$malop' group by madoan");
        ?>
        <div class="exercise__body">
        	<div class="exercise__container">
        		<div class="exercise__info">
        			<div class="exercise__info-title d-flex">
        				<h3>Bài tập</h3>
	        		</div>

        			<?php 
                    while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <div class="exercise__info-name-date">
                            <span class="exercise__info-name"><?php echo $row['tengiaovien'] ?></span>
                            <span class="exercise__info-date"><?php echo $row['ngaydang'] ?></span>
                    </div>
                    <div class="exercise__info-match d-flex">
                        <span class="exercise__info-match-max"><?php echo $row['diem'] ?> / 100 điểm</span>
                        <span class="exercise__info-deadline">Đến hạn 23:59 , <?php echo $row['deadline'] ?></span>
                    </div>
                    <hr>
                    <div class="exercise__info-tutorial">
                        <?php echo $row['tendoan'] ?>
                    </div>
                        <?php
                    }
                    ?>
        		</div>
        		<div class="exercise__up">
        			<div class="exercise__up-together">
        				<div class="exercise__title">Bài tập của bạn</div>
                        <?php  
                            $msv = $_SESSION['masinhvien'];
                            $query1 = mysqli_query($con,"select tbldoan.duongdan from tbldoan join tblphancong on tblphancong.madoan = tbldoan.madoan where tblphancong.masinhvien = '$msv' and tbldoan.madoan = '$idda'");
                            $row1 = mysqli_fetch_array($query1);

                            if($row1['tbldoan.tinhtrang'] == ''){
                                ?>
                                    <div class="exercise__status" style="color:red">Thiếu</div>
                                <?php
                            }else{
                                ?>
                                    <div class="exercise__status" style="color:green">Đã nộp</div>
                                <?php
                            }
                        ?>
        			</div>
                        <div class="exercise__up-file">
                            <!-- Chỗ này show tên file ra -->
                        </div>
                        
                        <?php
                        if($row1['tbldoan.tinhtrang'] == ''){
                            ?>  
                                <div class="excercise.php" style="display: flex;flex-direction: column;margin-top: 20px">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <input type="file" name="file">
                                    <input style="background-color: #cc6e26;color: white;margin-top: 10px;" type="submit" value="Upload" name="nopbai">
                                </form>
                                </div>
                            <?php
                        }else{
                            ?>
                                <input type="submit" name="done" value="Hủy nộp bài"></input>
                            <?php
                        }
                        ?>
        		</div>
        	</div>
        </div>
    </div>
    <script type="text/javascript" src="../js/index.js"></script>
</body>
</html>