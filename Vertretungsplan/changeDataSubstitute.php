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
//Get data
$v_id = $_POST["passID"]; // id auslesen
// var_dump($v_id);
$v_id = (int)$v_id; //wert zu int parsen
// var_dump($v_id);
// query
$sql = " SELECT  *
         FROM    `vertretungen`
         WHERE   `v_id` = $v_id ";
//get result
$result = $conn->query($sql);
// var_dump($result);
//get Data
$row = $result->fetch_assoc();
//var_dump($row);
?>

<h1>Bearbeiten Antrag auf Vertretung</h1>

<form action="processChangeDataSubstitute.php" method="post">
	<input type="hidden" name="passID" value="<?php echo $v_id?>">
	Am :<input type="date" name="date" value ="<?php echo $row['v_date']; ?>"><br>
	Schulstunden eintragen
	<input type="text" name="from" 		value="<?php echo $row['v_from'];?>" maxlength="2">
	<input type="text" name="to" 		value="<?php echo $row['v_to'];?>" maxlength="2"><br>
	<input type="text" name="class" 	value="<?php echo $row['v_class'];?>"><br>
	Fach: <select 	name="subject">		<!-- #TODO schönere Lösung -->
		<option><?php null?></option>	<!-- #TODO nur die angegebenen Fächer anzeigen -->
		<option<?php if($_SESSION['u_sub1'] == $row['v_subject']){ ?> selected <?php } ?>>
			<?php echo $_SESSION['u_sub1'];?>
		</option>
		
		<?php if (!empty($_SESSION['u_sub2'])){?>
			<option <?php if ($_SESSION['u_sub2'] ==  $row['v_subject']){ ?> selected <?php }?>>
				<?php echo $_SESSION['u_sub2']?>
			</option>
		<?php } ?>
		
		<?php if (!empty($_SESSION['u_sub3'])){?>
			<option <?php if ($_SESSION['u_sub3'] ==  $row['v_subject']){ ?> selected <?php }?>>
				<?php echo $_SESSION['u_sub3']?>
			</option>
		<?php } ?>
		
		<?php if (!empty($_SESSION['u_sub4'])){?>
			<option <?php if ($_SESSION['u_sub4'] ==  $row['v_subject']){ ?> selected <?php }?>>
				<?php echo $_SESSION['u_sub4']?>
			</option>
		<?php } ?>
		
		<?php if (!empty($_SESSION['u_sub5'])){?>
			<option <?php if ($_SESSION['u_sub5'] ==  $row['v_subject']){ ?> selected <?php }?>>
				<?php echo $_SESSION['u_sub5']?>
			</option>
		<?php } ?>
		
		<?php if (!empty($_SESSION['u_sub6'])){?>
			<option <?php if ($_SESSION['u_sub6'] ==  $row['v_subject']){ ?> selected <?php }?>>
				<?php echo $_SESSION['u_sub6']?>
			</option>
		<?php } ?>
		
		<?php if (!empty($_SESSION['u_sub7'])){?>
			<option <?php if ($_SESSION['u_sub7'] ==  $row['v_subject']){ ?> selected <?php }?>>
				<?php echo $_SESSION['u_sub7']?>
			</option>
		<?php } ?>
		
		<?php if (!empty($_SESSION['u_sub8'])){?>
			<option <?php if ($_SESSION['u_sub8'] ==  $row['v_subject']){ ?> selected <?php }?>>
				<?php echo $_SESSION['u_sub8']?>
			</option>
		<?php } ?>
	</select><br>
	
	<input type="text" name="room"		value="<?php echo $row['v_room'];?>"> <br>
	<input type="text" name="substitute"value="<?php echo $row['v_substitute'];?>"><br>
	
	<textarea name="reason"				placeholder="Grund für Entfall"><?php echo $row['v_reason'];?></textarea> <br> <!--#TODO CSS feste Maße + schön formatieren -->
	
	Maximal 2000 Zeichen:<br> <!-- #TODO Zeichenzähler!!!! -->
	<textarea name ="comment" 			placeholder="Kommentar"><?php echo $row['v_comment'];?></textarea><br> <!-- #TODO CSS feste Maße + schön formatieren -->
	
	<input type="submit" name="submit" value="Absenden">
</form>

<?php 
include 'footer.php';
?>