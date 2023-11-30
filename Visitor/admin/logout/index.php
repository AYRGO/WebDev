<?php
require_once '../../include/dbcon.php';
    session_start();
    if (isset($_SESSION[ "Email"])) {
        $loggedInUser = $_SESSION["Email"];
        $pdoQuery = "INSERT INTO audittrail (`Email`, `Description`) VALUES (:Email, 'User logged out')";
        $pdoResult = $conn->prepare($pdoQuery);
        $pdoResult->execute([':Email' => $loggedInUser]);
    }
    
    unset($_SESSION['Email']);
    session_destroy();
    header('location: ../../home.php');
?>