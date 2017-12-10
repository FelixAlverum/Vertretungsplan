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
// #TODO TODO.php mit signup.inc.php bearbeiten anstatt einen neuenEintrag zu machen, Datensatz überschreiben
?>

    <h1>Daten ändern</h1>
    <p>Erlaubte zeichen sind die Leertaste, a-z, A-Z und die Zahlen von 0-9 bei der Email Adresse und dem Passwort gilt das nicht</p>
    <form action="processChangeData.php" method="post">
      <input type="text" name="forename" value="<?php echo $_SESSION['u_forename'];?>"><br>
      <input type="text" name="surname" value="<?php echo $_SESSION['u_surname'];?>"><br>
      <input type="text" name="email" value="<?php echo $_SESSION['u_email'];?>"><br>
	
      <input type="radio" name="gender" value="female"  <?php if ($_SESSION['u_gender'] == "female"){?> checked <?php }?>> Weiblich
      <input type="radio" name="gender" value="male"    <?php if ($_SESSION['u_gender'] == "male"){  ?> checked <?php }?>>Männlich <br>
		
		<!-- Richtiges Kästchen aus der  Session Variable nehmen und anklicken-->
      <input type="checkbox" name="admin"   value="1" <?php if ($_SESSION['u_admin'] == 1){?> checked <?php }?>>Berechtigung Stundenentfall zu bestätigen <br>
       
      <p>Passwort für Adminberechtigung (nur eintippen, wenn wenn die vorherige Box angekreuzt wurde.)</p>
      <input type="password" name="pwAdmin" placeholder="Passwort"> <br>
      
      <p>Bitte tragen sie alle Fächer ein, die sie unterrichten</p>
      <input type="text" name="sub1" value="<?php echo $_SESSION['u_sub1'];?>"><br>
      
      <input type="text" name="sub2" 
      <?php if(empty($_SESSION['u_sub2'])){ ?>
          placeholder="Fach 2"
      <?php }else {?>
      	  value="<?php echo $_SESSION['u_sub2'];?>"
      <?php }?>><br>
     
      <input type="text" name="sub3" 
      <?php if(empty($_SESSION['u_sub3'])){ ?>
          placeholder="Fach 3"
      <?php }else {?>
      	  value="<?php echo $_SESSION['u_sub3'];?>"
      <?php }?>><br>
      
      <input type="text" name="sub4" 
      <?php if(empty($_SESSION['u_sub4'])){ ?>
          placeholder="Fach 4"
      <?php }else {?>
      	  value="<?php echo $_SESSION['u_sub4'];?>"
      <?php }?>><br>
      
      <input type="text" name="sub5" 
      <?php if(empty($_SESSION['u_sub5'])){ ?>
          placeholder="Fach 5"
      <?php }else {?>
      	  value="<?php echo $_SESSION['u_sub5'];?>"
      <?php }?>><br>
      
      <input type="text" name="sub6" 
      <?php if(empty($_SESSION['u_sub6'])){ ?>
          placeholder="Fach 6"
      <?php }else {?>
      	  value="<?php echo $_SESSION['u_sub6'];?>"
      <?php }?>><br>
      
      <input type="text" name="sub7" 
      <?php if(empty($_SESSION['u_sub7'])){ ?>
          placeholder="Fach 7"
      <?php }else {?>
      	  value="<?php echo $_SESSION['u_sub7'];?>"
      <?php }?>><br>
      
      <input type="text" name="sub8" 
      <?php if(empty($_SESSION['u_sub8'])){ ?>
          placeholder="Fach 8"
      <?php }else {?>
      	  value="<?php echo $_SESSION['u_sub8'];?>"
      <?php }?>><br>
      <input type="button" name="addSub" value="Weiteres Fach hinzufügen"><br> <!-- #TODO get this button working -->
	  
      <input type="text" name="username" value="<?php echo $_SESSION['u_username'];?>"><br>
      Passwort zum Bestätigen eintippen und "Daten ändern" drücken
      <input type="password" name="oldPwd" placeholder="Altes Passwort"><br>
      <input type="checkbox" name="keepPwd"   value="1">Ich möchte mein altes Passwort behalten<br>
      <input type="password" name="pwd" placeholder="Neues Passwort"><br>
      <input type="password" name="pwdRepeat" placeholder="Neues Passwort wiederholen"><br>

      <input type="submit" name="submit" value="Daten ändern">
    </form>
    <p>Erst nach dem Ausloggen werden die Daten übernommen</p>
 
 <?php 
 include 'footer.php';
 ?>
