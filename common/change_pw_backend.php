
<?php
include "dbsql.php";
session_start();
$id= $_SESSION['user_id'];

//after submit


	//declare variable
	$currentPw = $_POST['currentPw'];
	$newPw = $_POST['newPw'];
	$newPw2 = $_POST['newPw2'];

	$tableName="user";
	$columns="*";
	$fields="password";
	$values="$id";
	$field="user_id";
	$columnsUpdate="password";

	//cheack pw

	$dataTaken = retrive($tableName,$columns,$field,$values);
	
//echo $dataTaken['password'];
	if($dataTaken['password']==$currentPw){//if pw correct
		if($newPw==$newPw2){//cheack new pw

			$result=update($tableName,$columnsUpdate,$newPw,$field,$id);
			

			header("Location: change_pw.php?error=$result");
			exit();
				

		}else{
			header("Location: change_pw.php?error=passwords are not matching");
			exit();
		}

	}else{//if pw incorrect
		header("Location: change_pw.php?error=current password is wrong");
		exit();
	}
	

 ?>