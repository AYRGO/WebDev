<?php
    session_start();
 
    require_once '../include/dbcon.php';
 
    if (isset($_POST['login'])) {
        if ($_POST['Email'] != "" || $_POST['Password'] != "") {
            $Email = $_POST['Email'];
            $Password = $_POST['Password'];
            $sql = "SELECT * FROM admin WHERE Email=:Email AND Password=:Password ";
            $query = $conn->prepare($sql);
            $query->bindParam(':Email', $Email); 
            $query->bindParam(':Password', $Password); 
            $query->execute(); 
            $row = $query->rowCount();
            $fetch = $query->fetch();

            if ($row > 0) {
                $_SESSION['Email'] = $fetch['Email'];
                $loggedInUser = $_SESSION["Email"];
                $pdoQuery = "INSERT INTO audittrail (Email, Description) VALUES (:Email, 'User logged in')";
                $pdoResult = $conn->prepare($pdoQuery);
                $pdoResult->execute(['Email' => $loggedInUser]);

                header("location: dashboard/index.php");
            } else {
                echo "
                <script>alert('Invalid Email or password')</script>
                <script>window.location = 'aindex.php'</script>
                ";
            }
        } else {
            echo "
                <script>alert('Please complete the required field!')</script>
                <script>window.location = 'index.php'</script>
            ";
        }
    }
?>