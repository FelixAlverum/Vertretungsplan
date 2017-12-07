<?php
session_start();

if (isset($_POST['submit'])) {
    include 'dbh.inc.php';
    
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    
    // Weiterleiten zu signup.php
    if ($username == "Anmeldung" AND $pwd == "1234") {
        header("Location: ../signup.php");
        exit();
    }
    
    // Error handlers
    // Check if input is EmptyIterator
    if (empty($username) or empty($pwd)) {
        header("Location: ../index.php?login=empty");
        exit();
    }
    
    // User in database?
    $sql = "SELECT * FROM users WHERE user_username='$username'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck < 1) {
        header("Location: ../index.php?login=error");
        exit();
    }
    
    // Check if password match to username
    if ($row = mysqli_fetch_assoc($result)) {
        // De-hasing password
        $hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
        // Check if password match to username
        
        if ($hashedPwdCheck == false) {
            header("Location: ../index.php?login=wrongPassword");
            exit();
        } elseif ($hashedPwdCheck == true) {
            // Login the User
            $_SESSION['u_id'] = $row['user_id'];
            $_SESSION['u_username'] = $row['user_username'];
            $_SESSION['u_forename'] = $row['user_forename'];
            $_SESSION['u_surname'] = $row['user_surname'];
            $_SESSION['u_email'] = $row['user_email'];
            $_SESSION['u_gender'] = $row['user_gender'];
            $_SESSION['u_admin'] = $row['user_admin'];
            $_SESSION['u_sub1'] = $row['user_sub1'];
            $_SESSION['u_sub2'] = $row['user_sub2'];
            $_SESSION['u_sub3'] = $row['user_sub3'];
            $_SESSION['u_sub4'] = $row['user_sub4'];
            $_SESSION['u_sub5'] = $row['user_sub5'];
            $_SESSION['u_sub6'] = $row['user_sub6'];
            $_SESSION['u_sub7'] = $row['user_sub7'];
            $_SESSION['u_sub8'] = $row['user_sub8'];
            
           
            header("Location: ../indexLogin.php?login=success");
            exit();
        }
    }
} else {
    header("Location: ../index.php?login=error");
    exit();
}

?>
