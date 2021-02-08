<?php
    class Twit extends User{

        function __construct($pdo){
            $this->pdo = $pdo;
        }

        public function twitts(){
            $stmt = $this->pdo->prepare("SELECT * FROM `twitts` ,`twitters` WHERE `twitter_id1` = `twitter_id` ");
            $stmt->execute();
            $tweets = $stmt->fetchAll(PDO::FETCH_OBJ);

            foreach($tweets as $tweet){
                echo '<center><div>
                            <span>@'.$tweet->twittername.'</span>
                            <span>'.$tweet->postedOn.'</span>
                        </div>
                        <div>
                            '.$tweet->twitt.'
                        </div></center>';
            }
        }

        public function countTweets($user_id){
            $stmt = $this->pdo->prepare("SELECT COUNT(`twitts_id`) AS `totalTwitts` FROM `twitts` WHERE `twitter_id1` = :user_id");
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		    $stmt->execute();
		    $count = $stmt->fetch(PDO::FETCH_OBJ);
		    echo $count->totalTwitts;
        }
    }
?>