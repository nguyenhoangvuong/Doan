<?php  
	error_reporting(0);
	if(isset($_GET['f']) && !empty($_GET['f'])){
		$file = $_GET['f'];
		$f = fopen($file,"r") or die("Không mở được file");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php 
	while (!feof($f)) {
		$nd = fgets($f);
		$mang = explode(".", $nd);
			echo $mang[0];
			echo $mang[1];
		}
	 ?>
</body>
</html>