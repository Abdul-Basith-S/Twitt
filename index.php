<?php
    include 'core/init.php';
    if(isset($_SESSION['twitter_id'])){
        header('Location: index.php');
    }
?>

<html>
	<head>
		<center> <title>Twit</title>
	</head>
    <body>		
    <div>
        <h1>Welcome to Twit!!</h1>
                
        <div>
        <?php include 'includes/login.php';?>
        </div>

        <div>
        <?php include 'includes/signup.php';?>
        </div>
    </div>
    </body></center>
</html>