<?php
session_start();

require_once '../include/dbcon.php';

if (isset($_POST["Visitor"])) {
    $Fullname = $_POST['Fullname'];
    $Purpose = $_POST['Purpose'];
    $Gender = $_POST['Gender'];
    $Contact = $_POST['Contact'];

    $pdo = new PDO("mysql:host=localhost;dbname=admin", "root", "");

    $sql = "INSERT INTO visit (Fullname, Description, Gender, Contact) VALUES (:Fullname, :Purpose, :Gender, :Contact)";

    $pdoResult = $pdo->prepare($sql);

    $pdoExec = $pdoResult->execute([
        ":Fullname" => $Fullname,
        ":Purpose" => $Purpose,
        ":Gender" => $Gender,
        ":Contact" => $Contact,
    ]);

    if ($pdoExec) {
        header("location: ../home.php");
    } else {
        echo 'Failed to register user.';
    }
}
?>