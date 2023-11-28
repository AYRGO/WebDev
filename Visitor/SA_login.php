<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Replace with your database credentials
    $hostname = 'your_db_hostname';
    $username = 'your_db_username';
    $password = 'your_db_password';
    $dbname = 'your_db_name';

    try {
        // Create a PDO connection
        $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
        
        // Set PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Retrieve username and password from POST request
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Query to fetch user from the database (Note: Hash passwords in production)
        $sql = "SELECT * FROM users WHERE username=:username AND password=:password";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Login successful
            $_SESSION['username'] = $username;
            header("Location: welcome.php"); // Redirect to welcome page after successful login
            exit();
        } else {
            // Login failed
            $login_error = "Invalid username or password";
        }
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="" method="post">
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
    
    <?php if (isset($login_error)) { ?>
        <p><?php echo $login_error; ?></p>
    <?php } ?>
</body>
</html>
