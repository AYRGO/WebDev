<?php
    session_start();
 
    require_once '../include/dbcon.php';
 
    if (isset($_POST['login'])) {
        if ($_POST['Email'] != "" || $_POST['Password'] != "") {
            $Email = $_POST['Email'];
            $Password = $_POST['Password'];
            $sql = "SELECT * FROM superadmin WHERE Email=:Email AND Password=:Password ";
            $query = $conn->prepare($sql);
            $query->bindParam(':Email', $Email); 
            $query->bindParam(':Password', $Password); 
            $query->execute(); 
            $row = $query->rowCount();
            $fetch = $query->fetch();
            
            if ($row > 0) {
                $_SESSION['Email'] = $fetch['Email'];
                header("location: ../superadmin/dashboard/index.php");
            } else {
                echo "
                <script>alert('Invalid Email or password')</script>
                <script>window.location = 'index.php'</script>
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