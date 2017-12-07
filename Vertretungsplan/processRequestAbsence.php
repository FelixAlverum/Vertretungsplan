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
    $teacher_id = $_SESSION['u_id'];
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
    header("Location: requestAbsence.php?input=empty");
    exit();
}

// Check if $from and $to are numbers
if (! preg_match("/^[0-9]*$/", $from) or ! preg_match("/^[0-9]*$/", $to)) {
    header("Location: requestAbsence.php?input=invalid");
    exit();
}

// Check if $from and $ to are not negative or 0
if ($from <= 0 OR $to <= 0) {
    header("Location: requestAbsence.php?input=invalid");
    exit();
}

// Check if form < to
if ($from > $to) {
    header("Location: requestAbsence.php?from>to");
    exit();
}

/* //#TODO korrekte angabe für today finden
 * Check if the date is today or in the future
 */
$format='y.m.d';
$now = time();
if ($date.date($format) < $now.date($format)){ 
    header("Location: requestAbsence.php?invalidDate");
    exit();
}

// Check if input characters are valid
#TODO check for äöü in preg_match
if (! preg_match("/^[a-zA-Z0-9 \s]*$/", $class) or ! preg_match("/^[a-zA-Zäöü0-9 \s]*$/", $reason) or ! preg_match("/^[a-zA-Zäöü0-9 \s]*$/", $comment)) {
    header("Location: requestAbsence.php?input=invalid");
    exit();
}

// If substitute is unknown
if (empty($substitute)){
    $substitute = "Unbekannt";
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