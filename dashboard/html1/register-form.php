<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
	<link rel="stylesheet" type="text/css" href="..\dist\css\register-style.css">
	<link rel="stylesheet"  href="https:/stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<meta charset="UTF-8">

<?php

include '../../common/dbsql.php';

session_start();
$userId=$_SESSION['user_id'];

        
        $dataRow = retrive("user","*","user_id", $_SESSION['user_id']);
      

        $name = $dataRow['name'];
      

            //get the role and relevent location
                if($dataRow['role']=='admin'){
                    $location= "../admin/admin_panel.php";
                 

                }else{
                   $location="pages-profile.php";
                 
                }
        


?>


</head>
<body >
	<section class="registration_form">
		<h1 class="title"> Registration form

		</h1><div class="bottom-border"></div>
	<form action="register-form.php" method="post">
		<div class="container">
			<div class="contact-form row">
				<div class="form-field col-lg-6">
					<input id='name' class="input-text" type="text" name="name" required  >
					<label for="name " class="label">full name</label>
				</div>
				<div class="form-field col-lg-6">
					<input id='email' class="input-text" type="email" name="email" >
					<label for="email " class="label">email</label>
				</div>
				<div class="form-field col-lg-6">
					<input id='nic' class="input-text" type="text" name="nic" required>
					<label for="nic " class="label">NIC number</label>
				</div>
				<div class="form-field col-lg-6">
					<input id='highid' class="input-text" type="text" name="" >
					<label for="highid" class="label">higher ID</label>
				</div>
				<div class="form-field col-lg-6">
					<input id='date' class="input-date" type="date" name="dob" >
					<label for="date" class="label">date of birth</label>
				</div>
				<div class="form-field col-lg-6">
					<div class="radio-style">
					<input id='team' class="input-radio" type="radio" name="team" value="left">  Team A
					<input id='team' class="input-radio" type="radio" name="team" value="right" > Team B
					</div> 
					<label for="team" class="label">team</label>
				
				</div>
				
				<div class="form-field col-lg-6">
					<input id='phone' class="input-text" type="text" name="phoneNum" >
					<label for="phone" class="label">contact number</label>
				</div>
				<div class="form-field col-lg-6">
					<div class="radio-style">
					<input id='gender' class="input-radio" type="radio" name="gender" value="m" > male
					<input id='gender' class="input-radio" type="radio" name="gender" value="f" > female
					</div> 
					<label for="gender" class="label">gender</label>
				
				</div>
				<div class="form-field col-lg-12">
					<input id='adress' class="input-text" type="text" name="addr"  >
					<label for="adress" class="label">adress</label>
				</div>
				<div class="form-field col-lg-6">
					<input id='province' class="input-text" type="text" name="province"  >
					<label for="province" class="label">province</label>
				</div>
				<div class="form-field col-lg-6">
					<input id='district' class="input-text" type="text" name="district"  >
					<label for="district" class="label">district</label>
				</div>
				<div class="form-field col-lg-6">
					<input id='city' class="input-text" type="text" name="city" >
					<label for="city" class="label">city </label>
				</div>
				<div class="form-field col-lg-6">
					<input id='pcode' class="input-text" type="text" name="pCode"  >
					<label for="pcode" class="label">postal code</label>
				</div>
				<div class="form-field col-lg-4">
					<input id='pcode' class="submit-btn" type="submit" name="submit" value="submit" >
					
				</div>			
				<div class="form-field col-lg-3">
					<!-- <input id='pcode' class="submit-btn" type="submit" name="submit" value="submit" > -->
					<button  class="submit-btn" name="home_btn"
                                onclick="backToWhat()" style="background: red;" ><i
                                    class="mdi mdi-account-network selected"></i><span class="hide-menu">Back</span></button>
				</div>

			</div>
		</div>
	</form>
	</section>

<!-- insert data -->
<?php

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

$_POST = secure_form($_POST);

if(isset($_POST['submit'])){
		// get data and put into variables


	$values = [];

			// $name=$_POST['name'];
			// $mail=$_POST['email'];
			// $nicNum=$_POST['nic'];
			// $higherId = $userId;
			// $dob =$_POST['dob'];
			// $team=$_POST['team'];
			// $phoneNum=$_POST['phoneNum'];
			// $gender=$_POST['gender'];
			// $addr=$_POST['addr'];
			// $district=$_POST['district'];
			// $province=$_POST['province'];
			// $city=$_POST['city'];
			// $pCode=$_POST['pCode'];
			// $pw="456";

			$values[] = $_POST['name'];
			$values[] = $_POST['email'];
			$values[] = $_POST['nic'];
			$values[] = $userId;
			$values[] = $_POST['team'];
			$values[] = $_POST['dob'];
			$values[] = $_POST['phoneNum'];
			$values[] = $_POST['gender'];
			$values[] = $_POST['addr'];
			$values[] = $_POST['district'];
			$values[] = $_POST['province'];
			$values[] = $_POST['city'];
			$values[] = $_POST['pCode'];
			$values[] = "456";
			$values[] = "s";


			//var_dump($values);




// Cheack the availability

				

		

			$tableName="temp_register_detail";
			$fields= ["name","email","nic","higherId","team","dob","phone","gender","address","district","province","city","postalCode","password","visibility"];
			// $values= "$name,$mail,$nicNum,$higherId,$dob,$phoneNum,$gender,$addr,$district,$province,$city,$pCode,$pw";


			$result =  insert($tableName,$fields,$values);

			if ($result=="OK"){
				echo "<script>alert('done');</script>";
			}else{
				echo "<script>alert('failed');</script>";
			}




}




?>


<!-- back buuton -->
<script type="text/javascript">
    
    function backToWhat() {
        if  (confirm("Press 'OK' to leave the Eternity Test, or 'Cancel' if you want to stay: ")){
            window.location= "<?php echo $location ?>";
        } 
        // body...
    }
</script>




</body>
</html>