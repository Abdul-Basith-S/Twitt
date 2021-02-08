<?php
    include 'core/init.php';
    $user_id = $_SESSION['twitter_id'];
    $user = $getFromU->userData($user_id);

	if(isset($_POST['twitt'])){
		$twitt = $getFromU->checkinput($_POST['twitt1']);

		if(!empty($twitt)){
			if(strlen($twitt)>150){
				$error = "Too large twitt!!";
			}
			$getFromU->create('twitts',array('twitt'=> $twitt, 'twitter_id1'=>$user_id, 'postedOn'=> date('Y-m-d H:i:s')));
		}else{
			$error = "Type your thoughts in the twitt box!!";
		}
	}
?>

<!DOCTYPE HTML> 
<html>
	<head>
		<title>Twit</title>
		
	</head>
	<body>

		<div class="header">
			<center>Welcome <?php echo $user->twittername; ?> !!</center>
		</div>
		
		<div class="nav">
				<center>Total Twitts : <?php $getFromT->countTweets($user_id);?><br>
						Following : <br>
						Followers : </center>
		</div>
		
		<div class="tweet_box">
			<form method="post" enctype="multipart/form-data">
			<center><textarea class="twitt1" name="twitt1" placeholder="Type your thoughts!" rows="4" cols="50"></textarea><br>
				<input type="submit" name="twitt" value="Twitt"/></center>
				<center><?php 
					if(isset($error)){
						echo $error;
					}
				?></center>
			</form>
		</div>

		<div class="tweet_display">
			<?php $getFromT->twitts(); ?>
		</div>	

	</body>
</html>