<?php
    include_once(__DIR__ . "/Db.php");

    class User {
        private $username;
        private $password;

        public function getUsername()
        {
                return $this->username;
        }

        public function setUsername($username)
        {
                $this->username = $username;

                return $this;
        }

        public function getPassword()
        {
                return $this->password;
        }

        public function setPassword( $password )
        {
                // if(strlen($password) < 5){
                //     throw new Exception("Passwords must be longer than 5 characters.");
                // }

                $this->password = $password;
                return $this;
        }

        public function canLogin() {
        
            $conn = Db::getInstance();;
            $stmt = $conn->prepare("select * from users where username = :username");
            $stmt -> bindValue(":username", $this -> username);
            $stmt -> execute();
            $user = ($stmt->fetch());
            if(isset($user['password'])){
                $hash = $user['password'];
            }
          
            if(!$user){
                echo "user not exist";
                return false;
            }
            //password not hashed yet
            // if(password_verify($this->password, $user['password'])){
            //     echo "nice";
            //     return true;
            // }
            if($this->password == $hash){
                
                return true;
            }
            else{
                echo "password not right";
                return false;
            }
        }

    }