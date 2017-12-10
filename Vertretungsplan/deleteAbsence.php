<?php
#TODO question: Wollen sie wirklich löschen? |Ja |  | Nein|
session_start();
include_once 'includes/dbh.inc.php';
if (empty($_SESSION['user_id'])){
    header("Location: index.php");
}
//get ID
$v_id = $_POST['passID'];

//delete the data
$sql= " DELETE 
        FROM `vertretungen`
        WHERE `v_id`= ".$v_id."";
$result = mysqli_query($conn, $sql);

// go back
header("Location: indexLogin.php?deleted");
?>