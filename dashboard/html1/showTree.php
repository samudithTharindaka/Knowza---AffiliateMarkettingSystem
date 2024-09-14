<?php
include "../../common/dbsql.php";

session_start();
$left_side = [];
$right_side = [];
 $count_right=0;
 $count_left=0;

$user_id = $_SESSION['user_id'];
$logged_id =$_SESSION['user_id'];
$conn = conn_db();
//$result = mysqli_query($conn,"SELECT * FROM `direct_contact` WHERE user_id =$user_id;");
$result = mysqli_query($conn,"SELECT * FROM `direct_contact` WHERE user_id =$user_id   ");
while($row = $result->fetch_assoc()) {
    if ($row["team"] == "right"){
        $name = mysqli_query($conn,"SELECT name FROM `user` WHERE user_id = ". $row["direct_ref_id"])->fetch_assoc();
        $right_side[] = $name['name'];
//        $right_side [] =  $row["direct_ref_id"] ;
        print_tree($row["direct_ref_id"],$conn, "right_side");
         $count_right++;
    }
    else{
        $name = mysqli_query($conn,"SELECT name FROM `user` WHERE user_id = ". $row["direct_ref_id"])->fetch_assoc();
        $left_side[] = $name['name'];
//        $left_side [] =  $row["direct_ref_id"] ;
        print_tree($row["direct_ref_id"],$conn, "left_side");
        $count_left++;
    }

}

//print_tree($user_id,$conn);

function print_tree($user_id, $conn, $s_array){
    $result = mysqli_query($conn,"SELECT * FROM `direct_contact` WHERE user_id =$user_id   ");
    if ($result->num_rows == 0){
        return null;
    }
    else{

        while($row = $result->fetch_assoc()) {
//                echo "user_id: " . $row["user_id"]. " - direct_id: " . $row["direct_ref_id"] . "<br>";
//            echo "user_id = " . $row["direct_ref_id"] . "<br>";
            $name = mysqli_query($conn,"SELECT name FROM `user` WHERE user_id = ". $row["direct_ref_id"])->fetch_assoc();
            $GLOBALS[$s_array][]=$name["name"];
//            $GLOBALS[$s_array][]=$row["direct_ref_id"];
            print_tree($row["direct_ref_id"], $conn,$s_array);
        }
    }
}