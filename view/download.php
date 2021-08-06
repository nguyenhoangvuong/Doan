<?php 

include('../connect/connection.php');

$id = $_GET['id']; // Get id from url bar

if (!$id) {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


	<title>File Upload PHP Script - Pure Coding</title>
<style>
		@import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

		* {
		    margin: 0;
		    padding: 0;
		    box-sizing: border-box;
		    font-family: 'Roboto', sans-serif;
		}

		body {
		    width: 100%;
		    min-height: 100vh;
		    background: #4F6072;
		    display: flex;
		    justify-content: center;
		    align-items: center;
		    flex-direction: column;
		}

		.file__upload {
		    width: 400px;
		    height: 445px;
		    margin: 20px;
		    box-shadow: 0 0 5px rgba(0,0,0,.3);
		}

		.file__upload .header {
		    width: 100%;
		    height: 145px;
		    background: #4db6ac;
		    padding: 20px;
		    display: flex;
		    justify-content: center;
		    align-items: center;
		    border-radius: 5px 5px 0 0;
		}

		.file__upload .header p {
		    color: #FFF;
		}

		.file__upload .header p i.fa {
		    margin-right: 10px;
		}

		.file__upload .header p span {
		    font-size: 2rem;
		    font-weight: 100;
		}

		.file__upload .header p span span {
		    font-weight: 600;
		}

		.file__upload .body {
		    background: #FFF;
		    width: 100%;
		    height: calc(100% - 145px);
		    border-radius: 0 0 5px 5px;
		    display: flex;
		    justify-content: center;
		    align-items: center;
		    flex-direction: column;
		    text-align: center;
		}

		.file__upload .body input[type="file"] {
		    opacity: 0;
		}

		.file__upload .body i.fa {
		    color: #d3d3d3;
		    margin-bottom: 20px;
		}

		.file__upload .body p strong {
		    color: #4db6ac;
		}

		.file__upload .body p span {
		    color: #4db6ac;
		    text-decoration: underline;
		}

		.btn {
		    background: #4db6ac;
		    border: none;
		    outline: none;
		    margin: 20px 0;
		    padding: .7rem 2rem;
		    font-size: 1.3rem;
		    color: #FFF;
		    border-radius: 3px;
		    opacity: .8;
		    cursor: pointer;
		    transition: .3s;
		}

		.btn:hover {
		    opacity: 1;
		}

		#link_checkbox {
		    display: none;
		}

		#link {
		    border: 1px solid;
		    color: #4db6ac;
		    background: none;
		    width: calc(100% - 20px);
		    border-radius: 0;
		    outline: none;
		    padding: 10px;
		    font-size: 1rem;
		    margin: 10px 0;
		    display: none;
		}

		#link_checkbox:checked ~ #link {
		    display: block;
		}

		label[for="link_checkbox"] {
		    padding: .5rem 2rem;
		    background: #4db6ac;
		    color: #FFF;
		    outline: none;
		    cursor: pointer;
		}

		.download .download_link {
		    text-decoration: none;
		    color: #FFF;
		    background: #4db6ac;
		    padding: .5rem 2rem;
		    border-radius: 3px;
		    opacity: .8;
		    transition: .3s;
		}

		.download .download_link:hover {
		    opacity: 1;
		}
	</style>
</head>
<body>
	<div class="file__upload">
		<div class="header">
			<p><i class="fa fa-download fa-2x"></i><span><span>down</span>load</span></p>			
		</div>
		<form class="body">
			<div class="download">
                <?php 
                    
                $sql = "SELECT * FROM tbldoan WHERE madoan='$id'";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {
                    if ($row = mysqli_fetch_assoc($result)) {
                ?>
                <a href="uploads/<?php echo $row['new_name']; ?>" download="<?php echo $row['name']; ?>" class="download_link"><?php echo $row['name']; ?></a>
                <?php
                    }
                }
                ?>
            </div>
		</form>
	</div>
</body>
</html>