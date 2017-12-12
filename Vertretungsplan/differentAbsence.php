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

<form action="processReqestDifferentAbsence.php" method="post">
	Am :<input type="date" name="date"><br>
	Schulstunden eintragen
	<input type="text" name="from" 		placeholder="von" maxlength="2">
	<input type="text" name="to" 		placeholder="bis" maxlength="2"><br>
	<input type="text" name="class" 	placeholder="Klasse"><br>
	<input type="text" name="subject"   placeholder="Fach"><br>
	<input type="text" name="room"		placeholder="Raum"> <br>
	<input type="text" name="missingTeacher" placeholder="Lehrer fehlend E-MAIL"><br>
	<input type="text" name="substitute"placeholder="Vertretungslehrer"><br>
	
	<textarea name="reason"				placeholder="Grund für den Entfall"></textarea> <br> <!--#TODO CSS feste Maße + schön formatieren -->
	
	Maximal 2000 Zeichen:<br> <!-- #TODO Zeichenzähler!!!! -->
	<textarea name ="comment" 			placeholder="Bemerkungen"></textarea><br> <!-- #TODO CSS feste Maße + schön formatieren -->
	
	<input type="submit" name="submit" value="Absenden">
</form>

<?php 
include 'footer.php';
?>