


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
<?php 
	session_start();
	$id= $_SESSION['user_id'];
	include "dbsql.php";?>



<div class="container">
	
	



	
	<?php if (isset($_GET["error"])){ ?>
		<div class="error"><p >
			<?php echo $_GET["error"]; ?>
		</p>	</div>
	<?php } ?>


	<h2>Change Password</h2>
	<form action="change_pw_backend.php" method ='post'>

		<div class="input-field">
		<input id ='currentPw'  type="password" name="currentPw" placeholder="Enter your current password">
			<div class="underline"></div>
		</div>

		<div class="input-field">
		<input type="password" name="newPw" id= 'newPw' placeholder="Enter your new password">
			<div class="underline"></div>
		</div>
		<br>

		<div class="input-field">
		<input type="password" name="newPw2"  id ='newPw2' placeholder="Confirm your new password">
			<div class="underline"></div>
		</div>

		<input type="submit" value="Reset Password">
		<!-- <button class="backButton" onclick="page_redirect()">Back</button> -->
	</form>

	
</div>
</main>



</body>
</html>








