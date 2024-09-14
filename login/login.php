<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title> login | knowza </title>
	<!-- <meta charset="UTF-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="login_style.css">

</head>
<body>

	

	<main class="container">

    <div class="container">
		
        <?php if (isset($_GET["error"])){ ?>
            <div class="error"><p >
                <?php echo $_GET["error"]; ?>
            </p>	</div>
        <?php } ?>


        <h2>Login</h2>
        <form action="login_backend.php" method='POST'>
            <div class="input-field">
                <input type="email" name="mail" id="username"
                    placeholder="Enter Your email">
                <div class="underline"></div>
            </div>
            <div class="input-field">
                <input type="password" name="pw" id="password"
                    placeholder="Enter Your Password">
                <div class="underline"></div>
            </div>

            <input type="submit" value="Continue">
        </form>

        <div class="footer">
            
        </div>
    </main>
</div>

</body>
</html>