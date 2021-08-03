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
        <div class="exercise__body">
        	<div class="exercise__container">
        		<div class="exercise__info">
        			<div class="exercise__info-title d-flex">
        				<h3>Bài tập</h3>
	        			</div>
        			<div class="exercise__info-name-date">
        				<span class="exercise__info-name">Nhã Trần</span><span class="exercise__info-date">20/11/2021</span>
        			</div>
        			<div class="exercise__info-match d-flex">
        				<span class="exercise__info-match-max">100 điểm</span>
        				<span class="exercise__info-deadline">Đến hạn 23:59, 26 tháng 3, 2021</span>
        			</div>
        			<hr>
        			<div class="exercise__info-tutorial">
        				Các bạn viết chương trình C đề kiểm tra và nộp: (1) file .c/.cpp; (2) Màn hình kết quả của chương trình
        			</div>
        		</div>
        		<div class="exercise__up">
        			<div class="exercise__up-together">
        				<div class="exercise__title">Bài tập của bạn</div>
        			    <div class="exercise__status">Đã nộp</div>
        			</div>
        			<form action="" method="post">
	        			<div class="exercise__up-file">
	        				<div class="exercise__up-file-item">Baocao.docs</div>
	        			    <div class="exercise__up-file-item">Baocao.docs</div>
	        			    <div class="exercise__up-file-item">Baocao.docs</div>
	        			</div>
	        			<input type="submit" name="done" value="Hủy nộp bài"></button>
        			</form>
        		</div>
        	</div>
        </div>
    </div>
    <script type="text/javascript" src="../js/index.js"></script>
</body>
</html>