<?php 
session_start();
//Distingusish between admin and user
if ($_SESSION['u_admin'] == 1){
    include 'headerLoginAdmin.php';
}else{
    include 'headerLogin.php';
}
$v_id = $_POST["passID"];
$v_id = (int)$v_id;
$sql = " SELECT  *
         FROM    `vertretungen`
         WHERE   `v_id` = $v_id ";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();
?>
<h1>Alle Daten zur Vertretung/ Abwesenheit am <?php echo $row['v_date'];?></h1>

Klasse : <?php echo $row['v_class'];?> <br>
Stunde:<?php echo $row['v_from'];?> - <?php echo $row['v_to'];?> <br>
Fach: <?php echo $row['v_subject'];?> <br>
Status:<?php $status = "Vertretung";
            if ($row['v_status'] == 0)
                $status = "Entfall";
            echo $status; ?> <br>
Vertretung bei :<?php echo $row['v_substitute'];?> <br>
Raum: <?php echo $row['v_room'];?> <br>
Best�tigt: <?php $status2 = "Nein";
            if ($row['v_accepted'] == 1)
                $status2 = "Ja";
            echo $status2; ?>


<form action="substitute.php" method="post">
	<input type="submit" value="Zur�ck">
</form>
<?php 
include 'footer.php';
?>