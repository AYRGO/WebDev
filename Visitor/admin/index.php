<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>

			<?php if(isset($_SESSION['message'])): ?>
				<div class="alert alert-<?php echo $_SESSION['message']['alert'] ?> msg"><?php echo $_SESSION['message']['text'] ?></div>
			<script>
				(function() {
					// removing the message 3 seconds after the page load
					setTimeout(function(){
						document.querySelector('.msg').remove();
					},3000)
				})();
			</script>
			<?php 
				endif;
				// clearing the message
				unset($_SESSION['message']);
			?>

<img src="logooo.jpg" class="dhvsu">
    <div class="wrapper">
    <form action="function.php" method="POST">    
        <div style="width:500px;">
  
            <h2>Admin</h2>
    </div>
            <div class="input-box">
            <input type="email" placeholder ="Email" name="Email" required>
            <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
            <input type="password" placeholder ="Password" name="Password" required>
            <i class='bx bxs-lock-alt'></i>
            </div>
            
            <button type="submit" class="btn" name="login">Login </a></button>
        
	</form>
    	</div>
			
		
	
</body>
</html>
