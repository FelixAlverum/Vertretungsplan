<?php 
echo "accept.php";
include 'includes/dbh.inc.php';
/*
 * 1. bestätigt auf true setzen - done
 * 2. lehrer informieren (Mail), dass die Vertretung klar geht
 * 3. möglichen vertretungslehrer informierens
 */

//get ID
$v_id = $_POST['passID'];
$accepted   = true;
var_dump($v_id);
//update data
$sql = "UPDATE `vertretungen`
        SET `v_accepted` = '$accepted'
        WHERE `v_id` = '$v_id' ;";
$result = mysqli_query($conn, $sql);
header("Location: confirmAbsence.php?accepted");
exit();
?>