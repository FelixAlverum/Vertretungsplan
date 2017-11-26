<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<title>Vertretungsplan BSZ Bietigheim</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<form action="indexLogin.php" method="post">
		<input type="submit" value="Einlogmenü">
	</form>
	
	<form action="requestAbsence.php" method="post">
		<input type="submit" name="requestAbsence" value="Antrag erstellen"> <br>
	</form>
	
	<form action="editAbsence.php" method="post">
		<input type="submit" name="editAbsence" value="Anträge bearbeiten"><br>
	</form>
	
	<form action="TODO.php" method="post">
		<input type="submit" name="substitute" value="Vertretungen">
	</form>
	
	<form action="changeData.php" method="post">
		<input type="submit" name="changeData" value="Daten ändern">
	</form>
	
	<form action="includes/logout.inc.php" method="post">
		<input type="submit" name="logout" value="Logout">
	</form>
	
	<form action="TODO.php" method="post">
		<input type="submit" name="confirmAbscence" value="Vertretungen bestätigen">
	</form>
	

	<!-- Der Sinn dahinter ist, index.php besteht jetzt nur noch aus einem
kleinen Teil der Rest der immer gleich aussieht, kann mit include
wiederverwendet werden und das spart uns arbeit -->