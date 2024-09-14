<?php
include 'dbsql.php';
session_start();

//echo $_SESSION['user_id'];
$id=$_SESSION['user_id'];



$tablename="user";
$cols="*";
$fields ="user_id";
$value=$id;


// get personal data
$dataRow=retrive($tablename,$cols,$fields,$value);
				//check role and get location
				if($dataRow['role']=='admin'){
                    $location= "../dashboard/admin/admin_panel.php";

                 

                }else{
                   $location="../dashboard/html1/pages-profile.php";
                 
                }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>change password</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>
    
	<link rel="stylesheet" href="../login/login_style.css" type ='text/css'>

	<script type = "text/javascript">

	</script>



	<style type="text/css">
		.backButton{
	    	margin-top: 10px;
		    padding: 0.4rem;
		    width: 100%;
		    background: linear-gradient(to left, #4776E6, #8e54e9);
		    cursor: pointer;
		    color: white;
		    font-size: 0.9rem;
		    font-weight: 300;
		    border-radius: 4px;
		    transition: all 0.3s ease;
			}
		.backButton:hover {
		    letter-spacing: 0.5px;
		    background: linear-gradient(to right, #4776E6, #8e54e9);
		}

	</style>
</head>
<body>


<main class="container">


<div class="container">
	
	



	
	<?php if (isset($_GET["error"])){ ?>
		<div class="error"><p >
			<?php echo $_GET["error"]; ?>
		</p>	</div>
	<?php } ?>


	<h2>Change profile Picture</h2>
	<form action="change_pro_pic_backend.php" method ='post' enctype="multipart/form-data">


		<div class="input-field">
		<!-- <input type="password" name="newPw" id= 'newPw' placeholder="Enter your new password"> -->
		<input type="file" name="file" />
			<div class="underline"></div>
		</div>
		<br>


		<input type="submit" value="change profile picture">
		
		<br>
		
		
		<!-- <button class="backButton" onclick="page_redirect()">Back</button> -->
	</form>

</div>
</main>


<script type="text/javascript">
    
    function backToWhat() {
        if  (confirm("Press 'OK' to leave the form, or 'Cancel' if you want to stay: ")){
            window.location= "<?php echo $location ?>";
       		console.log("hi");
    }
</script>


</body>
</html>

