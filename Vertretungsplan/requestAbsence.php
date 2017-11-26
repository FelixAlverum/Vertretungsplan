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
?>

<h1>Antrag auf Vertretung</h1>

<form action="processRequestAbsence.php" method="post">
	Am :<input type="date" name="date"><br>
	Schulstunden eintragen
	<input type="text" name="from" 		placeholder="von" maxlength="2">
	<input type="text" name="to" 		placeholder="bis" maxlength="2"><br>
	<input type="text" name="class" 	placeholder="Klasse"><br>
	Fach: <select name="subject">		<!-- #TODO sch�nere L�sung -->
		<option><?php null?></option>	<!-- #TODO nur die angegebenen F�cher anzeigen -->
		<option><?php echo $_SESSION['u_sub1']?></option>
		
		<?php if (!empty($_SESSION['u_sub2'])){?>
			<option><?php echo $_SESSION['u_sub2']?></option>
		<?php } ?>
		
		<?php if (!empty($_SESSION['u_sub3'])){?>
			<option><?php echo $_SESSION['u_sub3']?></option>
		<?php } ?>
		
		<?php if (!empty($_SESSION['u_sub4'])){?>
			<option><?php echo $_SESSION['u_sub4']?></option>
		<?php } ?>
		
		<?php if (!empty($_SESSION['u_sub5'])){?>
			<option><?php echo $_SESSION['u_sub5']?></option>
		<?php } ?>
		
		<?php if (!empty($_SESSION['u_sub6'])){?>
			<option><?php echo $_SESSION['u_sub6']?></option>
		<?php } ?>
		
		<?php if (!empty($_SESSION['u_sub7'])){?>
			<option><?php echo $_SESSION['u_sub7']?></option>
		<?php } ?>
		
		<?php if (!empty($_SESSION['u_sub8'])){?>
			<option><?php echo $_SESSION['u_sub8']?></option>
		<?php } ?>
	</select><br>
	<input type="text" name="room"		placeholder="Raumverlegung?"> <br>
	<input type="text" name="substitute"placeholder="Vertretungslehrer?"><br>
	<textarea name="reason"				placeholder="Grund f�r den Entfall"></textarea> <br> <!--#TODO CSS feste Ma�e + sch�n formatieren -->
	Maximal 2000 Zeichen:<br> <!-- #TODO Zeichenz�hler!!!! -->
	<textarea name ="comment" 			placeholder="Bemerkungen"></textarea><br> <!-- #TODO CSS feste Ma�e + sch�n formatieren -->
	<input type="submit" name="submit" value="Absenden">
</form>

<?php 
include 'footer.php';
?>