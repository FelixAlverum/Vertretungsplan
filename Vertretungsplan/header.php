<?php
session_start();
?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <title>Vertretungsplan BSZ Bietigheim</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>

  <body>
	<p>!!! Nur ein Benutzer pro Browser!!!</p>
    <form action="includes/login.inc.php" method="post">
      <input type="text"      name="username"   placeholder="Username"><br>
      <input type="password"  name="pwd"        placeholder="Passwort"><br>
      <button type="submit"   name="submit">Login</button>
    </form>
    

<!-- Der Sinn dahinter ist, index.php besteht jetzt nur noch aus einem
kleinen Teil der Rest der immer gleich aussieht, kann mit include
wiederverwendet werden und das spart uns arbeit -->
