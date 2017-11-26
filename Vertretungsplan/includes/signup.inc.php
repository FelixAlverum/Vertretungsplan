<?php
// User isnt allowed on this website
//-> check if he clicked the submit button
if (isset($_POST['submit'])) {
  include_once 'dbh.inc.php';

  // get variables as a String
  $username   = mysqli_real_escape_string($conn, $_POST['username']);
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

  //Error handlers #TODO Errormeldungen ausgeben
  // Check for empty fields
  if (empty($username) OR empty($forename) OR empty($surname) OR
   empty($email) OR empty($sub1)) {
     header("Location: ../signup.php?signup=empty"); // #TODO echo/print + colorize errors
     exit();// Script stops here
  }

  //Check for correct password
  if (empty($pwd) OR empty($pwdRepeat)) {
    header("Location: ../signup.php?password=empty");
    exit();
  }
  if ($pwd !== $pwdRepeat) {
    header("Location: ../signup.php?password=unequal");
    exit();
  }

  //Check if input characters are valid
  if (!preg_match("/^[a-zA-Z0-9 \s]*$/", $username) OR !preg_match("/^[a-zA-Z0-9 \s]*$/", $forename) OR
      !preg_match("/^[a-zA-Z0-9 \s]*$/", $surname)  OR !preg_match("/^[a-zA-Z0-9 \s]*$/", $sub1) OR
      !preg_match("/^[a-zA-Z0-9 \s]*$/", $sub2)     OR !preg_match("/^[a-zA-Z0-9 \s]*$/", $sub3) OR
      !preg_match("/^[a-zA-Z0-9 \s]*$/", $sub4)     OR !preg_match("/^[a-zA-Z0-9 \s]*$/", $sub5) OR
      !preg_match("/^[a-zA-Z0-9 \s]*$/", $sub6)     OR !preg_match("/^[a-zA-Z0-9 \s]*$/", $sub7) OR
      !preg_match("/^[a-zA-Z0-9 \s]*$/", $sub8)) {
        header("Location: ../signup.php?signup=invalid");
        exit();
  }

  // Check if email is valid
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?signup=email");
    exit();
  }

  //Ceck if username is taken
  $sql = "SELECT * FROM users WHERE user_username ='$username'";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);
  if ($resultCheck > 0) {
    header("Location: ../signup.php?signup=usernameTaken");
    exit();
  }

  // Hashin the password
  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  //$admin in int parsen && Check if admin is  checked and admin password is correct
   boolval($admin) ? 'true' : 'false'; //#TODO code verstehen
   if ($admin === true) {
     if ($_POST['pwAdmin'] !== "1234") {
       header("Location: ../signup.php?password=unequal");
       exit();
     }
   }

  // Insert the user to the database
  $sql = "INSERT INTO `users`(`user_id`, `user_username`, `user_pwd`, `user_email`, `user_forename`, `user_surname`, `user_gender`, `user_admin`, `user_sub1`, `user_sub2`, `user_sub3`, `user_sub4`, `user_sub5`, `user_sub6`, `user_sub7`, `user_sub8`)
          VALUES ('$id', '$username', '$hashedPwd', '$email', '$forename', '$surname', '$gender', '$admin', '$sub1', '$sub2', '$sub3', '$sub4', '$sub5', '$sub6', '$sub7', '$sub8')";
  $result = mysqli_query($conn, $sql);

  header("Location: ../index.php?signup=success");
  exit();

}else {
  header("Location: ../signup.php");
  exit();
}

?>
