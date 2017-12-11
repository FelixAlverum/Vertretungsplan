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
$name = $_SESSION['u_surname'];
$query = "SELECT *
          FROM `vertretungen`
          WHERE `v_substitute`= '$name'";
$result = mysqli_query($conn, $query);
// var_dump($result);
if ($conn->affected_rows >= 1) {
    ?>

<h1>Abwesenheit / Vertretung ablehnen oder bestätigen</h1>

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
	<form action="showDataLogin.php" method="post">
		<input type="hidden" name="passID" value="<?php echo $row['v_id']?>">
		<input type="submit" value="Zeige alle Daten + Bearbeiten">
	</form>
	</td>
	
	<td>
	</tr>
	<?php
    }
    ?>
 </tbody>   
</table>



<?php 
}else {
    echo "Es muss nichts vertreten werden";
}
include 'footer.php';
?>