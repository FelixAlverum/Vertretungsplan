<?php 
echo "reject.php Antrag abgelehnt";

/*
 * 1. Datensatz löschen - done
 * 2. Lehrer per Mail informieren
 * 3. Möglichen Vertretungslehrer per Mail informieren
 */

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
header("Location: confirmAbsence.php?deleted");


?>