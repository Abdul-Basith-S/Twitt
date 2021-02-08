<?php
  if(isset($_POST['login']) && !empty($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($email) or !empty($password)) {
      $email = $getFromU->checkInput($email);
      $password = $getFromU->checkInput($password);

      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errorMsg = "Invalid Email";
      }else {
        if($getFromU->login($email, $password) === false){
          $errorMsg = "The email or password is incorrect!";
        }
      }
    }else {
      $errorMsg = "Please enter username and password!";
    }
  }
?>
<div>
    <form method="post"> 
        <h3>Login:</h3>
		<input type="text" name="email" placeholder="Email-ID"/><br><br>
		<input type="password" name="password" placeholder="Password"/><br><br>
        <input type="submit" name="login" value="Login"/><br><br>	
        <?php
            if(isset($errorMsg)){
                echo $errorMsg;
            }
        ?>
    </form>
</div>