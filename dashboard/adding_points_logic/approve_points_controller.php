<?php
session_start();

include '../../common/dbsql.php';

$pdo = new PDO("mysql:host=localhost:3306;dbname=knowza_4", 'root', '');
$conn = conn_db();
$user_id = $_POST['user_id'];
$indx = $_POST['indx'];
$dbname="tree";
$field="user_id";

if (isset($_POST["accept"])){

    $stmt = $pdo->prepare("SELECT * FROM tree WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $transaction_count = $res[0]["transaction_count"];
    $left_points = $res[0]["left_pt"];
    $right_points = $res[0]["right_pt"];
    $points_paid = $res[0]["point_paid"];

//    echo "left points left = " . $left_points-$points_paid;
//    echo "<br>";
//    echo "right points left = ". $right_points- $points_paid;



        //retrive
      







    echo "indx ;" . $indx;
    switch ($transaction_count){

        case 0:
            if (($left_points-$points_paid)>0 and  ($right_points-$points_paid)>0){
                $stmt = $pdo->prepare("UPDATE tree SET transaction_count = ? , point_paid = ? WHERE user_id = ?");
                $stmt->execute([$transaction_count+1,1,$user_id]);
                $sql = "UPDATE `points_req` SET `visibility`='h' WHERE indx = $indx;";
                $conn->query($sql);
                header("Location: ../admin/approve_points.php");
                exit();
            }
            else{
                $sql = "UPDATE `points_req` SET `visibility`='h' WHERE indx = $indx;";
                $conn->query($sql);
                header("Location: ../admin/approve_points.php?error=not_enough_points");
                exit();
            }
            break;
        case 1:
            if (($left_points-$points_paid)>=2 and  ($right_points-$points_paid)>=2){
                $stmt = $pdo->prepare("UPDATE tree SET transaction_count = ? , point_paid = ? WHERE user_id = ?");
                $stmt->execute([$transaction_count+1,3,$user_id]);
                $sql = "UPDATE `points_req` SET `visibility`='h' WHERE indx = $indx;";
                $conn->query($sql);
                header("Location: ../admin/approve_points.php");
                exit();
            }
            else{
                $sql = "UPDATE `points_req` SET `visibility`='h' WHERE indx = $indx;";
                $conn->query($sql);
                header("Location: ../admin/approve_points.php?error=not_enough_points");
                exit();
            }
            break;
        case 2:
            if (($left_points-$points_paid)>=3 and  ($right_points-$points_paid)>=3){
                $stmt = $pdo->prepare("UPDATE tree SET transaction_count = ? , point_paid = ? WHERE user_id = ?");
                $stmt->execute([$transaction_count+1,$points_paid + 3,$user_id]);
                $sql = "UPDATE `points_req` SET `visibility`='h' WHERE indx = $indx;";
                $conn->query($sql);
                header("Location: ../admin/approve_points.php");
                exit();
            }
            else{
                $sql = "UPDATE `points_req` SET `visibility`='h' WHERE indx = $indx;";
                $conn->query($sql);
                header("Location: ../admin/approve_points.php?error=not_enough_points");
                exit();
            }
            break;
        default:
            if (($left_points-$points_paid)>=3 and  ($right_points-$points_paid)>=3){
                $stmt = $pdo->prepare("UPDATE tree SET transaction_count = ? , point_paid = ? WHERE user_id = ?");
                $stmt->execute([1 + $transaction_count,$points_paid + 3, $user_id]);
                $sql = "UPDATE `points_req` SET `visibility`='h' WHERE indx = $indx;";
                $conn->query($sql);
                echo "ccc4";
                header("Location: ../admin/approve_points.php");
                exit();
            }
            else{
                $sql = "UPDATE `points_req` SET `visibility`='h' WHERE indx = $indx;";
                $conn->query($sql);
                header("Location: ../admin/approve_points.php?error=not_enough_points");
                exit();
            }
            break;
    }
    header("Location: ../admin/approve_points.php");
    exit();
}//end of if

if (isset($_POST["reject"])) {
    $sql = "UPDATE `points_req` SET `visibility`='h' WHERE indx = $indx;";
    $conn->query($sql);

    header("Location: ../admin/approve_points.php");
    exit();
}else{

header("../admin/approve_points.php");
exit();
}
?>