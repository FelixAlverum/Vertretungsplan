<?php 
include 'headerLoginAdmin.php';

$sql="  SELECT * 
        FROM `vertretungen` 
        WHERE `v_accepted`=0";
$result = mysqli_query($conn, $query);;
?>

<table>
<thead>
    <tr>
      <th>Datum</th>
      <th>Klasse</th>
      <th>Stunde</th>
      <th>Status</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
<tbody>
<?php
if ($conn->affected_rows >= 1) {
while ($row = $result->fetch_assoc()) {
?>
	<tr>
	<td><?php  $date = $row['v_date'];
	//<!-- #TODO display date in dd.mm.yyyy way -->
	           echo $date;?></td>  
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
	<form action="showData.php" method="post">
		<input type="hidden" name="passID" 		value="<?php echo $row['v_id']; ?> ">
		<input type="submit" name="displayShit" value="Mehr Anzeigen">
	</form>
	<td>
	
	<td>
	<form action="TODO.php" method="post">
		<input type="hidden" name="passID" 		value="<?php echo $row['v_id']; ?> ">
		<input type="submit" name="displayShit" value="Bestaetigen">
	</form>
	<td>
	</tr>	
<?php
    }
 ?>
 </tbody>   
</table>


<?php
}
include_once 'footer.php';
?>
