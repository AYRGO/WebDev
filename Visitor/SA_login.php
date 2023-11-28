<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // palitan ng database credentials
    $hostname = 'your_db_hostname';
    $username = 'your_db_username';
    $password = 'your_db_password';
    $dbname = 'your_db_name';

    // Create connection
    $conn = new mysqli($hostname, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve username and password from POST request
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Query to fetch user from the database (Remember to use prepared statements for better security)
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            // Login successful
            $_SESSION['username'] = $username;
            header("Location: welcome.php"); // Redirect to welcome page after successful login
            exit();
        } else {
            // Login failed
            $error = "Invalid username or password";
        }
    } else {
        $error = "Please provide username and password";
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login SuperAdmin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
 <h2>Login</h2>
    <form action="" method="post">
        <?php if (isset($error)) { ?>
            <p><?php echo $error; ?></p>
        <?php } ?>
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <input type="submit" value="Login">
     
        </div>
    </form>

</body>
</html>
