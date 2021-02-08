<?php
    class User{
        protected $pdo;

        function __construct($pdo){
            $this->pdo = $pdo;
        }

        public function checkInput($var){
            $var = htmlspecialchars($var);
            $var = trim($var);
            $var = stripcslashes($var);
            return $var;
        }

        public function checkEmail($email){
            $stmt = $this->pdo->prepare("SELECT `email` FROM `twitters` WHERE `email` = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
    
            $count = $stmt->rowCount();
            if($count > 0){
                return true;
            }else{
                return false;
            }
        }

        public function login($email, $password){
            $password1 = md5($password);
            $stmt = $this->pdo->prepare("SELECT `twitter_id` FROM `twitters` WHERE `email` = :email AND `password` = :password");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password1, PDO::PARAM_STR);
            $stmt->execute();
    
            $count = $stmt->rowCount();
            $user = $stmt->fetch(PDO::FETCH_OBJ);
    
            if($count > 0){
                $_SESSION['twitter_id'] = $user->twitter_id;
                header('Location: home.php');
            }else{
                return false;
            }
        }
        
        public function userData($user_id){
            $stmt = $this->pdo->prepare('SELECT * FROM `twitters` WHERE `twitter_id` = :user_id');
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
    
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
        
        public function create($table, $fields = array()){
            $columns = implode(',', array_keys($fields));
            $values  = ':'.implode(', :', array_keys($fields));
            $sql     = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";
    
            if($stmt = $this->pdo->prepare($sql)){
                foreach ($fields as $key => $data) {
                    $stmt->bindValue(':'.$key, $data);
                }
                $stmt->execute();
                return $this->pdo->lastInsertId();
            }
        }
    }
?>