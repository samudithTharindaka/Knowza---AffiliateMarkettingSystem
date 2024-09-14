
<!DOCTYPE html>
<html>
<head>
	<title>
		test
	</title>
</head>
<body>

	<form action="cheack.php">
		
		<input type="text" name="id">
		<input type="submit" name="submit">
	</form>




</body>
</html>







<?php

include "../common/db.php";





if (isset($_GET['submit'])){
$id=$_GET['id'];
	$res=Database::retrieve("user","*",array("user_id"),array($id));

	if ($res[0]== array()){
		echo "<br>";
		echo $res[0]["user_id"];
		echo "<br>";
		echo $res[0]["name"];

	}
}


?>
