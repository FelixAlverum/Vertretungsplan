<!DOCTYPE html>
<html>

<head>
<meta Charset="UTF-8">
<title>Vertretungsplan BSZ Bietigheim</title>
<link rel="stylesheet" type="text/css" href="styleLogin.css">
</head>

<body>
	
	<div class="container"> <!-- div Ende ist in footer.php -->
	
	<div class="label">
	  	<h1>Vertretungsplan BSZ Bietigheim</h1>
	  	<img alt="BSZ_Logo" src="img/Logo.jpg"> 
	</div>
	
	<div class="navigation">
		<form action="indexLogin.php" method="post">
			<input type="submit" value="Einlogmenü">
		</form>
	</div>
	
	<div class="school">
		<form action="requestAbsence.php" method="post">
			<input type="submit" name="requestAbsence" value="Antrag erstellen"> <br>
		</form>
	
		<form action="editAbsence.php" method="post">
			<input type="submit" name="editAbsence" value="Anträge bearbeiten"><br>
		</form>
	
		<form action="TODO.php" method="post">
			<input type="submit" name="substitute" value="Vertretungen">
		</form>
	</div>
	
	<div class="logout">
		<form action="includes/logout.inc.php" method="post">
			<input type="submit" name="logout" value="Logout">
		</form>
	</div>
	
	<div class="personal">
		<form action="changeData.php" method="post">
			<input type="submit" name="changeData" value="Daten ändern">
		</form>
	</div>
	
	<div class="main">
	
	<!-- Der Sinn dahinter ist, index.php besteht jetzt nur noch aus einem
kleinen Teil der Rest der immer gleich aussieht, kann mit include
wiederverwendet werden und das spart arbeit -->