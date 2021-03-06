<?php
session_start();
//Check if user is allowed on this page
if (empty($_SESSION['u_id'])) {
    header("Location: index.php?notAllowed");
    exit();
}
//Distingusish between admin and user
if ($_SESSION['u_admin'] == 1){
    include 'headerLoginAdmin.php';
}else{
    include 'headerLogin.php';
}

include 'includes/dbh.inc.php';
// TODO in mysqli umschreiben
$query = "SELECT *
          FROM `vertretungen`
          WHERE `vertretungen`.`v_accepted`=0";
$result = mysqli_query($conn, $query);
// var_dump($result);
if ($conn->affected_rows >= 1) {
    ?>

<h1>Abwesenheit/Entfall ablehnen / bestätigen</h1>

<table>
<thead>
    <tr>
      <th>Datum</th>
      <th>Klasse</th>
      <th>Stunde</th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </thead>
<tbody>
<?php
    while ($row = $result->fetch_assoc()) {
        ?>
	<tr>
	<td><?php echo $row['v_date'] ?></td>
	<!-- #TODO display date in an easy readable way -->
	<td><?php echo $row['v_class'];?></td>
	<td><?php echo $row['v_from'];?>-<?php echo $row['v_to'];?></td>
	<td>
	<form action="showDataAbsence.php" method="post">
		<input type="hidden" name="passID" value="<?php echo $row['v_id']?>">
		<input type="submit" value="Zeige alle Daten + Bearbeiten">
	</form>
	</td>
	<td>
	<form action="reject.php" method="post">
		<input type="hidden" name="passID" value="<?php echo $row['v_id']?>">
		<input type="submit" value="Ablehnen">
	</form>
	</td>
	<td>
	<form action="accept.php" method="post">
		<input type="hidden" name="passID" value="<?php echo $row['v_id']?>">	
		<input type="submit" name="changeData" value="Annehmen">
	</form>
	<td>
	</tr>
	<?php
    }
    ?>
 </tbody>   
</table>



<?php 
}else {
    echo "Es muss nichts bestätigt werden";
}
include 'footer.php';
?>