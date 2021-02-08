<?php
    if(isset($_POST['signup'])){
        $screenName = $_POST['twittername'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $error = '';
    
        if(empty($screenName) or empty($password) or empty($email)){
            $error = 'All fields are required';
        }
        else {
            $email = $getFromU->checkInput($email);
            $screenName = $getFromU->checkInput($screenName);
            $password = $getFromU->checkInput($password);
    
            if(!filter_var($email)) {
                $error = 'Invalid email format';
            }
            else if(strlen($screenName) > 20){
                $error = 'Name must be between in 6-20 characters';
            }
            else if(strlen($password) < 5){
                $error = 'Password is too short';
            }
            else {
                if($getFromU->checkEmail($email) === true){
                    $error = 'Email is already in use';
                }
                else {
                    $password = md5($password);
                    $user_id = $getFromU->create('twitters', array('email' => $email, 'password' => $password , 'twittername' => $screenName));
                    $_SESSION['twitter_id'] = $user_id;
                    header('Location: includes/signup.php?step=1');
                }
            }
        }
    }

?>
<div> 
    <form method="post">
        <h3>Signup: </h3>
        <input type="text" name="twittername" placeholder="User Name"/><br><br>
        <input type="email" name="email" placeholder="Email"/><br><br>
        <input type="password" name="password" placeholder="Password"/><br><br>
        <input type="submit" name="signup" Value="Signup"><br><br>
        <?php
            if(isset($error)){
                echo $error;
            }
        ?>
    </form>
</div>