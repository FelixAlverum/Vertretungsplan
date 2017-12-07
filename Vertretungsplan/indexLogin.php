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

<p>	Hallo 
	<!-- Richtige Anrede -->
	<?php if ($_SESSION['u_gender'] == "male"){
	    echo "Herr";
	}else {
	    echo "Frau";
	}?>
	<!-- Nachname --> 
	<?php echo $_SESSION['u_surname'] ?>	
	! </p>
	<p>Herzlich Wilkommen im Lehrerbereich der Vertretungsseite!</p>
	
	<?php 	#TODO URL miteinander vergleichen
	if (PHP_URL_QUERY == '?sendtRequest'){ // funktioniert nicht
	    echo "Die Vertretungsanfrage wurde versendet!";
	}
	?>

<?php
include 'footer.php';
?>
