<?php
// -> check if he clicked the submit button
if (isset($_POST['submit'])) {
    include_once 'includes/dbh.inc.php';
    session_start();
    //Check if user is allowed on this page
    if (empty($_SESSION['u_id'])) {
        header("Location: index.php?notAllowed");
        exit();
    }
    
    // Set Vatiables as Strings
    $id = 0;
    $teacher_name = mysqli_real_escape_string($conn, $_POST['missingTeacher']);
    $accepted   = false;          // Der Antrag wurde vom Sekreteriat oder Abteilungsleiter bestätigt
    $status     = true;           // 0 = Entfall || 1 = Vertretung
    $date       = mysqli_real_escape_string($conn, $_POST['date']);
    $from       = mysqli_real_escape_string($conn, $_POST['from']);
    $to         = mysqli_real_escape_string($conn, $_POST['to']);
    $class      = mysqli_real_escape_string($conn, $_POST['class']);
    $room       = mysqli_real_escape_string($conn, $_POST['room']);
    $substitute = mysqli_real_escape_string($conn, $_POST['substitute']);
    $subject    = mysqli_real_escape_string($conn, $_POST['subject']);
    $reason     = mysqli_real_escape_string($conn, $_POST['reason']);
    $comment    = mysqli_real_escape_string($conn, $_POST['comment']);
    /*
     * echo "$date <br>";
     * echo "$from <br>";
     * echo "$to <br>";
     * echo "$class<br>";
     * echo "$subject<br>";
     * echo "$reason<br>";
     * echo "$comment<br>";
     * echo "$room<br>"
     * echo "$substitute<br>"
     */
    
    
    // Error handlers # TODO Errormeldungen ausgeben
    // Check for empty fields
    if (empty($date) or empty($from) or empty($to) or empty($class) or empty($subject) or empty($reason)) {
        header("Location: differentAbsence.php?input=empty");
        exit();
    }
    
    // Check if $from and $to are numbers
    if (! preg_match("/^[0-9]*$/", $from) or ! preg_match("/^[0-9]*$/", $to)) {
        header("Location: differentAbsence.php?input=invalid");
        exit();
    }
    
    // Check if $from and $ to are not negative or 0
    if ($from <= 0 OR $to <= 0) {
        header("Location: differentAbsence.php?input=invalid");
        exit();
    }
    
    // Check if form < to
    if ($from > $to) {
        header("Location: differentAbsence.php?from>to");
        exit();
    }
    
    /* //#TODO korrekte angabe für today finden
     * Check if the date is today or in the future
     */
    var_dump();
    var_dump(time());
    
    if (strtotime($date) < time()){
        header("Location: differentAbsence.php?invalidDate");
        exit();
    }
    
    // If substitute is unknown
    if (empty($substitute)){
        $substitute = "Unbekannt";
    }
    
    //get Teacher_id
    $sql1=" SELECT `user_id`
            FROM `users`
            WHERE `user_email`='$teacher_name'";
    var_dump($sql1);
    $result1=mysqli_query($conn, $sql1);
    var_dump($result1);
    $row = $result1->fetch_assoc();
    $teacher_id = $row['user_id'];
    
    //check if teacher teaches the reqestet subject
    $correctSubject=false;
    for($i=1; $i<9; $i++){
        if ($row['user_sub'+$i] == $subject);{
            $correctSubject=true;
        }
    }
    if ($correctSubject== false){
        header("Location: differentAbsence.php?wrongSubject");
        exit();
    }
    
    // Vertretung in Datenbank einfügen
    $sql = "INSERT INTO `vertretungen`(`v_id`, `v_teacher_id`, `v_date`, `v_from`, `v_to`, `v_class`, `v_subject`, `v_status`, `v_reason`, `v_comment`, `v_substitute`, `v_room`, `v_accepted`)
          VALUES ('$id', '$teacher_id', '$date', '$from', '$to', '$class', '$subject', '$status', '$reason', '$comment', '$substitute', '$room', '$accepted')";
    $result = mysqli_query($conn, $sql);
    
    header("Location: indexLogin.php?sendtRequest");
    exit();
    
}else{
    header("Location: indexLogin.php?AccesDenied");
    exit();
}

?>