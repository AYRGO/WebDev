<?php
session_start();

require_once '../include/connect/dbcon.php';

try {
    $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST["login"])) {
        if (empty($_POST["Email"]) || empty($_POST["Password"])) {
            $message = '<label>All fields are required</label>';
        } else {
            $pdoQuery = "SELECT * FROM admin WHERE Email = :Email";
            $pdoResult = $pdoConnect->prepare($pdoQuery);
            $pdoResult->execute(['Email' => $_POST["Email"]]);

            $user = $pdoResult->fetch();

            if ($user && password_verify($_POST["Password"], $user["Password"])) {
                $_SESSION["Email"] = $user["Email"];

                $loggedInUser = $_SESSION["Email"];
                $pdoQuery = "INSERT INTO audit_trail (Email, Description) VALUES (:Email, 'User logged in')";
                $pdoResult = $pdoConnect->prepare($pdoQuery);
                $pdoResult->execute(['Email' => $loggedInUser]);

                header("Location:../index.php");
                exit();
            } else {
                $message = '<label>Wrong email or password</label>';
            }
        }
    }
} catch (PDOException $error) {
    error_log($error->getMessage(), 0);
    $message = '<label>Something went wrong. Please try again later.</label>';
}
?>