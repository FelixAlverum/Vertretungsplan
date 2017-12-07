<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registrieren</title>
  </head>
  
  <body>
    <h1>Registrieren</h1>
    <p>Erlaubte zeichen sind die Leertaste, a-z, A-Z und die Zahlen von 0-9 bei der Email Adresse und dem Passwort gilt das nicht</p>
    <form action="includes/signup.inc.php" method="post">
      <input type="text" name="forename" placeholder="Vorname"><br>
      <input type="text" name="surname" placeholder="Nachname"><br>
      <input type="text" name="email" placeholder="E-Mail"><br>

      <input type="radio" name="gender" value="female" checked> Weiblich
      <input type="radio" name="gender" value="male">Männlich <br>

      <input type="checkbox" name="admin"   value="1">Berechtigung Stundenentfall zu bestätigen <br>
      <p>Passwort für Adminberechtigung (nur eintippen wenn wenn die vorherige Box angekreuzt wurde.</p>
      <input type="password" name="pwAdmin" placeholder="Passwort"> <br>

      <p>Bitte tragen sie alle Fächer ein, die sie unterrichten</p>
      <input type="text" name="sub1" placeholder="Fach 1"><br>
      <input type="text" name="sub2" placeholder="Fach 2"><br>
	  <input type="text" name="sub3" placeholder="Fach 3"><br>
	  <input type="text" name="sub4" placeholder="Fach 4"><br>
	  <input type="text" name="sub5" placeholder="Fach 5"><br>
	  <input type="text" name="sub6" placeholder="Fach 6"><br>
	  <input type="text" name="sub7" placeholder="Fach 7"><br>
	  <input type="text" name="sub8" placeholder="Fach 8"><br>
      <input type="button" name="addSub" value="Weiteres Fach hinzufügen"><br>

      <input type="text" name="username" placeholder="Benutzername"><br>
      <input type="password" name="pwd" placeholder="Passwort"><br>
      <input type="password" name="pwdRepeat" placeholder="Passwort wiederholen"><br>

      <input type="submit" name="submit" value="Registrieren">
    </form>
  </body>
</html>
