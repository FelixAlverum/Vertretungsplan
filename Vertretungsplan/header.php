<?php
session_start();
?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="UTF-8">
    <title>Vertretungsplan BSZ Bietigheim</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="modal.css">
  </head>

  <body>
  
  <div class="container"> <!-- div Ende ist in footer.php -->
	
	<div class="label">
	  	<h1>Vertretungsplan BSZ Bietigheim</h1>
	  	<img alt="BSZ_Logo" src="img/Logo.jpg"> 
	</div>
	
	<div class="login">
	<p>!!! Nur ein Benutzer pro Browser!!!</p>
    <form action="includes/login.inc.php" method="post">
      <input type="text"      name="username"   placeholder="Username"><br>
      <input type="password"  name="pwd"        placeholder="Passwort"><br>
      <button type="submit"   name="submit">Login</button>
    </form>
    </div>
    
    <div class="search">
	<!-- #TODO Ergebnisse filtern -->
	<p>Einstellungen zum Suchen</p>
	<form>
		<input type="number" name="limit" placeholder="Anzahl der Ergebnisse"><br>
		<input type="submit" name="update" value="Suchen">
	</form>
	</div>
	
	<div class="main">
<!-- Der Sinn dahinter ist, index.php besteht jetzt nur noch aus einem
kleinen Teil der Rest der immer gleich aussieht, kann mit include
wiederverwendet werden und das spart uns arbeit -->
