<?php
#TODO dosn't work
session_start();
if (empty($_SESSION['user_id'])){
    header("Location: index.php");
}
$sql= " DELETE 
        FROM `vertretungen`
        WHERE `vertretungen`.`v_teacher_id`= ".$_SESSION['u_id']."
        ORDER BY `v_date` DESC
        WHERE `vertretungen`.`v_id`= ".$_SESSION['number']."";
$result = mysqli_query($conn, $query);
header("Location: indexLogin.php?deleted");
?>