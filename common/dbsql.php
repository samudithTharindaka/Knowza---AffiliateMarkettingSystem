<?php


//connection
function conn_db(){
	$server="localhost:3306";
	$username="root";
	$pw="";
	$dbname="knowza_3";


	$conn= mysqli_connect($server,$username,$pw,$dbname);

	if(!$conn){
		echo "connection error";
	}
	return $conn;

}


// function retrive($tableName,$columns,$fields,$values){

// 	$connOk = conn_db();


// 	if ($columns == "*") {//if all data need to be selected then 
//             $sql= "SELECT $columns FROM $tableName WHERE $fields=$values";
//         } else {
//             $cols = join(", ", $columns);
//             $sql = "SELECT $cols FROM $tableName WHERE $fields=$values";
//         }

//             $result = mysqli_query($connOk,$sql);

//             $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

//             return $row;

// }

// $retriveData = retrive("user","*","email","jalitha@gmail.com");
// echo $retriveData["password"];
// echo $retriveData["email"];

//function retrive($tableName,$columns,$fields,$values){
//
//	$connOk = conn_db();
//
//
//	if ($columns == "*") {//if all data need to be selected then
//            $sql= "SELECT $columns FROM $tableName WHERE $fields=$values";
//        } else {
//            $cols = join(", ", $columns);
//            $sql = "SELECT $cols FROM $tableName WHERE $fields=$values";
//        }
//
//            $result = $connOk->query($sql);
//
//            if ($result->num_rows > 0) {
//    			// output data of each row
//    			$row = $result->fetch_assoc() ;
//    			var_dump($row);
//    			 return $row;
//			}else {
//    			echo "0 results";
//			}
//
// }





function retrive($tableName,$columns,$fields,$values){

    $connOk = conn_db();


    if ($columns == "*") {//if all data need to be selected then
        $sql= "SELECT $columns FROM $tableName WHERE $fields='$values'";
         
    } else {
        $cols = join(", ", $columns);
        $sql = "SELECT $cols FROM $tableName WHERE $fields='$values'";
    }
    $row=[];
    $result = $connOk->query($sql);
    
    if ($result ->num_rows> 0) {
        // output data of each row
        $row = $result->fetch_assoc();
    }else {
        echo "0 results";
    }
    return $row;
}




function retriveBulk($tableName,$columns,$fields,$values){

    $connOk = conn_db();


    if ($columns == "*") {//if all data need to be selected then
        $sql= "SELECT $columns FROM $tableName WHERE $fields='$values'";
         
    } else {
        $cols = join(", ", $columns);
        $sql = "SELECT $cols FROM $tableName WHERE $fields='$values'";
    }

    $result = $connOk->query($sql);
    $rows = [];
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()){
            $rows[] = $row;
        
        }

    }else {
        echo "0 results";
    }
    return $rows;
}






// function insert($tableName,$fields,$values){

// 	$connOk = conn_db();


// 	$sql= "INSERT INTO $tableName ($fields) VALUES ($values)";



// 	if($connOk->query($sql)==TRUE){
// 		echo "<script> alert('data successfully added');</script>";
// 	}
// 	else{
// 		echo "<script> alert('something went wrong');</script>";
// 	}




// }

function insert($tableName, $fields, $values){

	$flds = join(", ", $fields);
	$values = join("', '", $values);
	$values = "'" . $values . "'";
	$sql = "INSERT into $tableName ($flds) VALUES ($values);";
	$connOk = conn_db();
	
	if($connOk->query($sql) == TRUE){
			return "OK";
		}
	else{
		return "NO";
	}

}


function update($tableName,$column,$newValue,$field,$value){

	$connOk=conn_db();

	$sql= "UPDATE $tableName SET $column = $newValue WHERE $field = $value";

	if($connOk->query($sql)==TRUE){
		return "done";
	}
	else{
		return "failed";
	}

}






?>