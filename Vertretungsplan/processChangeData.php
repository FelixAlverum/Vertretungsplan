<?php
session_start();
// User isnt allowed on this website
//-> check if he clicked the submit button
if (isset($_POST['submit'])) {
  include_once 'includes/dbh.inc.php';

  // get variables as a String
  $username   = mysqli_real_escape_string($conn, $_POST['username']);
  $oldPwd     = mysqli_real_escape_string($conn, $_POST['oldPwd']);
  $keepPwd    = mysqli_real_escape_string($conn, $_POST['keepPwd']);
  $pwd        = mysqli_real_escape_string($conn, $_POST['pwd']);
  $pwdRepeat  = mysqli_real_escape_string($conn, $_POST['pwdRepeat']);
  $forename   = mysqli_real_escape_string($conn, $_POST['forename']);
  $surname    = mysqli_real_escape_string($conn, $_POST['surname']);
  $email      = mysqli_real_escape_string($conn, $_POST['email']);
  $gender     = mysqli_real_escape_string($conn, $_POST['gender']);
  $admin      = mysqli_real_escape_string($conn, $_POST['admin']);
  $sub1       = mysqli_real_escape_string($conn, $_POST['sub1']);
  $sub2       = mysqli_real_escape_string($conn, $_POST['sub2']);
  $sub3       = mysqli_real_escape_string($conn, $_POST['sub3']);
  $sub4       = mysqli_real_escape_string($conn, $_POST['sub4']);
  $sub5       = mysqli_real_escape_string($conn, $_POST['sub5']);
  $sub6       = mysqli_real_escape_string($conn, $_POST['sub6']);
  $sub7       = mysqli_real_escape_string($conn, $_POST['sub7']);
  $sub8       = mysqli_real_escape_string($conn, $_POST['sub8']);
  $id         = 0;

  //Error handlers #TODO Errormeldungen ausgeben + colorize errors
  // Check for empty fields
  if (empty($username) OR empty($forename) OR empty($surname) OR
   empty($email) OR empty($sub1)) {
     header("Location: changeData.php?signup=empty");
     exit();// Script stops here
  }

  //Check for pssword changes
  if (empty($oldPwd)){
      header("Location: changeData.php?oldPw=empty");
      exit();
  }
  if ($keepPwd == 1){
      $pwd = $pwdRepeat = $oldPwd;
  }
  
  //Check for correct password
  if (empty($pwd) OR empty($pwdRepeat)) {
    header("Location: changeData.php?password=empty");
    exit();
  }
  if ($pwd !== $pwdRepeat) {
    header("Location: changeData.php?password=unequal");
    exit();
  }

  //Check if input characters are valid
  if (!preg_match("/^[a-zA-Z0-9 \s]*$/", $username) OR !preg_match("/^[a-zA-Z0-9 \s]*$/", $forename) OR
      !preg_match("/^[a-zA-Z0-9 \s]*$/", $surname)  OR !preg_match("/^[a-zA-Z0-9 \s]*$/", $sub1) OR
      !preg_match("/^[a-zA-Z0-9 \s]*$/", $sub2)     OR !preg_match("/^[a-zA-Z0-9 \s]*$/", $sub3) OR
      !preg_match("/^[a-zA-Z0-9 \s]*$/", $sub4)     OR !preg_match("/^[a-zA-Z0-9 \s]*$/", $sub5) OR
      !preg_match("/^[a-zA-Z0-9 \s]*$/", $sub6)     OR !preg_match("/^[a-zA-Z0-9 \s]*$/", $sub7) OR
      !preg_match("/^[a-zA-Z0-9 \s]*$/", $sub8)) {
        header("Location: changeData.php?signup=invalid");
        exit();
  }

  // Check if email is valid
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: changeData.php?signup=email");
    exit();
  }

  //Check if email/username is taken only when there was a change
  $mailCheck = $_SESSION['u_email'];
  if($email !== $mailCheck){
    $sql = "SELECT * 
            FROM users 
            WHERE user_username = $username 
            OR user_email= $mailCheck";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        header("Location: changeData.php?signup=EmailOrUsernameTaken");
        exit();
  }
  }
  // Hashing the password
  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  //Check if admin is  checked and admin password is correct
   $admin = (bool) $admin;
   $oldAdmin= (bool)($_SESSION['admin']);
   var_dump($admin);
   if ($admin === true) {
     if ($admin != $oldAdmin){  
        if ($_POST['pwAdmin'] !== "1234") {
            header("Location: changeData.php?password=unequal");
            exit();
        }
     }
   }

  // Change Data the user to the database
  $sql = "UPDATE `users`
          SET   user_username='$username', 
                user_pwd='$hashedPwd', 
                user_email='$email', 
                user_forename='$forename', 
                user_surname='$surname', 
                user_gender='$gender', 
                user_admin='$admin', 
                user_sub1='$sub1',          user_sub2='$sub2', 
                user_sub3='$sub3',          user_sub4='$sub4', 
                user_sub5='$sub5',          user_sub6='$sub6', 
                user_sub7='$sub7',          user_sub8='$sub8'
          WHERE user_id=".$_SESSION['u_id'];
  $result = mysqli_query($conn, $sql);

  header("Location: indexLogin.php?change=success");
  exit();

}else {
  header("Location: changeData.php=unknownError");
  exit();
}

?>