<?php

include "../common/dbsql.php";



session_start();
$_SESSION['user_id']='1';

$connOk = conn_db();


//header("Location: ../dashboard/admin/admin_panel.php");//need to add admin page addr here
//			exit();
function secure_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function secure_form($form)
{
    foreach ($form as $key => $value)
    {
        $form[$key] = secure_input($value);
    }
    return $form;
}
// get data from form
$data = secure_form($_POST);
$pw = $data['pw'];
$mail = $data['mail'];

//echo $pw;



//if one field is missing, then do
if (empty($pw)){

	header("Location: login.php?error=password is required.");
	exit();
}elseif (empty($mail)) {
	header("Location: login.php?error=E-mail is required.");
	exit();
	
}else{

//get data from db

	$tablename="user";
	$cols="*";
	$fields ="email";
	$value="$mail";

	$dataRow = retrive($tablename,$cols,$fields,$value);

	
echo $dataRow['email'];
echo $dataRow['password'];


	if($dataRow['email']==$mail AND $dataRow['password']==$pw){//if its correct
		session_start();
		$_SESSION['user_id']=$dataRow['user_id'];

		//cheak role
		if($dataRow['role']!="admin"){//member
			header("Location: ../dashboard/html1/pages-profile.php");
			exit();
		}elseif ($dataRow['role']=="admin") {//admin
			header("Location: ../dashboard/admin/admin_panel.php");//need to add admin page addr here
			exit();
		}


	}else{//if pw or username wrong

		header("Location: login.php?error=Entered details are wrong!");
		exit();

	}





	/*if ($dataRow['email']==$mail){

		// echo "logged in";
		session_start();
		$_SESSION['user_id']=$dataRow['user_id'];

		if($dataRow['role']!="admin"){
			header("Location: ../dashboard/html1/pages-profile.php");
			exit();
		}elseif ($dataRow['role']=="admin") {
			header("Location: ../dashboard/admin/admin_panel.php");//need to add admin page addr here
			exit();
		}
	}else{
				header("Location: login.php?error=Entered details are wrong!");
				exit();
		}*/  

		}












?>