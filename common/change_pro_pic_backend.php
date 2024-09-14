<?php
include "dbsql.php";
session_start();
// $user_id=35;
$user_id=$_SESSION['user_id'];

//get data 
$image = $_FILES['file']['name'];
$uploadOk=1;
$error="";
$location = "../dashboard/assets/images/user4to/";
$target_file = $location . basename($image);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$dirForDb="../assets/images/user4to/".basename($image);

//update fuction for add pic data to db
function updateProPic($tableName,$column,$newValue,$field,$value){

	$connOk=conn_db();

	$sql= "UPDATE $tableName SET $column = '$newValue' WHERE $field = '$value';";
    echo $sql;

	if($connOk->query($sql)==TRUE){
		return "done";
	}
	else{
		return "failed";
	}

}


// Check file size
if ($image > 800000) {
  $error="Sorry, your file is too large. please give a photo less than 5mb ";
  $uploadOk = 0;

}
// Allow certain file formats
else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
  $error= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

//send back if there is any error
if($uploadOk==0){
	header("location: change_pro_pic.php?error=$error");
	exit();
}else{
		//move the file
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
		    echo "The file ". htmlspecialchars( basename( $image)). " has been uploaded.";
		  } else {
		    $error= "Sorry, there was an error uploading your file.";
		    header("location: change_pro_pic.php?error=$error");
			exit();
		  }

		  $tableName="user";
		  $field="pro_pic";
		  
		  $check_field='user_id';


		 //update database
		  $result= updateProPic($tableName,$field,$dirForDb,$check_field,$user_id);

		  if ($result=='done'){
		  	 header("location: change_pro_pic.php?error=done");
			exit();
		  }else{
		  	 header("location: change_pro_pic.php?error=sorry! upload failed");
			exit();
		  }



}






?>

