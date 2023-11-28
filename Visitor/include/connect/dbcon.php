<?php
try {
    $host = 'localhost'; 
    $dbname = 'admin'; 
    $username = 'root'; 
    $password = ''; 

    
    $pdoConnect = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdoConnect->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
     
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>