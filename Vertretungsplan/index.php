<?php
include 'header.php';
include 'includes/dbh.inc.php';

// TODO in mysqli umschreiben
// TODO limit variabel machen
$query = "SELECT * FROM `vertretungen` ORDER BY `vertretungen`.`v_upload` DESC LIMIT 10";
$result = mysqli_query($conn, $query);
// var_dump($result);
if ($conn->affected_rows >= 1) {
    ?>

<table>
<thead>
    <tr>
      <th>Datum</th>
      <th>Klasse</th>
      <th>Stunde</th>
      <th>Status</th>
      <th></th>
    </tr>
  </thead>
<tbody>
<?php
    $counter=1;
    while ($row = $result->fetch_assoc()) {
?>
	<tr>
	<td><?php echo $row['v_date'];?></td>
	<!-- #TODO display date in an easy readable way -->
	<td><?php echo $row['v_class'];?></td>
	<td><?php echo $row['v_from'];?>-<?php echo $row['v_to'];?></td>
	<td>
		<?php
        $status = "Vertretung";
        if ($row['v_status'] == 0)
            $status = "Entfall";
        echo $status;
        ?></td>
	<td>
	<form action="#<?php echo $counter?>">
		<button>Mehr anzeigen</button>
	</form>

	<td>
	</tr>	
<?php
    $counter++; // increment counter
    }
 ?>
 </tbody>   
</table>


<?php
}
include_once 'footer.php';
?>
