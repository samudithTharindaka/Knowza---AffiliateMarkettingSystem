<?php

include_once '../../common/dbsql.php';
include_once 'User.php';

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


$data = secure_form($_POST);
$pdo = new PDO("mysql:host=localhost:3306;dbname=knowza_3", 'root', '');

var_dump($data);

 if (isset($_POST['submit'])) {
     $user_id = $data['higherId'];
     $user_row = retrive("user","*","user_id", $user_id);
     $username = $user_row["name"];
     $user_data = retrive("tree", "*", "user_id",$user_id);
     $data_temp_reg_details = retrive("tamp_register_detail","*","indx",$user_id);// line by samu

     $higher_id = $user_data["higher_id"];
     $left_points = $user_data["left_pt"];
     $right_points = $user_data["right_pt"];
     $points_paid = $user_data["point_paid"];
     $team = $user_data["team"];
     $team_cheak=$data_temp_reg_details['team'];//line by samu
     $transaction_count = $user_data["transaction_count"];

     // getting the relevant user details to the user class
     $user = new User($user_id,$username,$higher_id,$left_points,$right_points,$points_paid,$team,$transaction_count);

     //getting the new users data
     $new_indx = $data["indx"];
     $new_name = $data["name"];
     $new_email = $data["email"];
     $new_nic = $data["nic"];
     $new_higherId = $data["higherId"];
     $new_team = $data["team"];
     $new_dob = $data["dob"];
     $new_gender = $data["gender"];
     $new_addr = $data["addr"];
     $new_province = $data["province"];
     $new_pCode = $data["pCode"];

     //adding the new user to the user table
     $stmt = $pdo->prepare("INSERT INTO user (name, pro_pic, password, email, role, nic, dob, gender, addr, province, pCode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ? , ?)");
     $stmt->execute([$new_name, " ", "user123", $new_email, "mem",$new_nic, $new_dob, $new_gender, $new_addr, $new_province, $new_pCode ]);

     $new_user_row = retrive("user","*","email", $new_email);
     $new_userId = $new_user_row["user_id"];

     //removing the user from temporary registration
     $conn = conn_db();
     $sql = "UPDATE `temp_register_detail` SET `visibility`='h' WHERE indx = $new_indx;";
     $conn->query($sql);
//     $stmtU = $pdo->prepare("UPDATE temp_register_detail SET visibility = ? WHERE indx = ? ;");
//     $stmtU->execute(["h",`$new_indx`]);
//     $result = update("temp_register_detail", "visibility", 'h', "indx", $new_indx);
//     echo $result;


     if ( $new_team == 'left') {
         $current_points = $user->getLeftPoints();
         $current_points++;

         //updating the values of the tree table of the current user
         $user_id=$user->getUserId();
         $stmt = $pdo->prepare("UPDATE tree SET left_pt = ? WHERE user_id = ?");
         $stmt->execute([$current_points,$user_id]);
         increment_higher($user, $pdo);

         //adding the new user to the tree table
         $stmtT = $pdo->prepare("INSERT INTO tree (higher_id, user_id, left_pt, right_pt, point_paid, team, transaction_count) VALUES ( ?, ?, ?, ?, ?, ?, ?)");
         $stmtT->execute([$user_id, $new_userId, 0, 0, 0,"left", 0 ]);

         //adding the user into direct references
         $stmt = $pdo->prepare("INSERT INTO direct_contact (user_id, direct_ref_id, team) VALUES ( ?, ?, ?)");
         $stmt->execute([$user_id, $new_userId, "left" ]);

     }
     else {
         $current_points =$user->getRightPoints();
         $current_points++;

         $user_id=$user->getUserId();
         $stmt = $pdo->prepare("UPDATE tree SET right_pt = ? WHERE user_id = ?");
         $stmt->execute([$current_points,$user_id]);
         increment_higher($user, $pdo);

         //adding the new user to the tree table
         $stmtT = $pdo->prepare("INSERT INTO tree (higher_id, user_id, left_pt, right_pt, point_paid, team, transaction_count) VALUES ( ?, ?, ?, ?, ?, ?, ?)");
         $stmtT->execute([$user_id, $new_userId, 0, 0, 0,"right", 0 ]);

         //adding the user into direct references
         $stmt = $pdo->prepare("INSERT INTO direct_contact (user_id, direct_ref_id, team) VALUES ( ?, ?, ?)");
         $stmt->execute([$user_id, $new_userId, "right" ]);
     }
 }

if (isset($_POST['reject'])){
    $new_indx = $data["indx"];
    //removing the user from temporary registration
    $conn = conn_db();
    $sql = "UPDATE `temp_register_detail` SET `visibility`='h' WHERE indx = $new_indx;";
    $conn->query($sql);
}

//increment the points of the higher of the ladder
function increment_higher($user , $pdo){
    $higher_id = $user->getHigherId();
    $team_side = $user->getTeam();
    $point_side = $team_side . "_pt";
    while ($team_side != "top"){
        $stmt = $pdo->prepare("SELECT * FROM tree WHERE user_id = ?");
        $stmt->execute([$higher_id]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
//        var_dump($res);
        $current_points = $res[0][$point_side];
        $current_points++;
        $stmt = $pdo->prepare("UPDATE tree SET $point_side = ? WHERE user_id = ?");
        $stmt->execute([$current_points,$higher_id]);

        //getting the next higher id
        $higher_id = $res[0]["higher_id"];
        $team_side = $res[0]["team"];
        $point_side = $team_side . "_pt";
    }


}

header('Location: ../admin/approve_main.php');
exit;