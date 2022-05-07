<?php
    include_once(__DIR__ . "/Db.php");

    class User {
        private $email;
        private $username;
        private $password;

        public function getEmail()
        {
                return $this->username;
        }

        public function setEmail($email)
        {
            $tm = "@student.thomasmore.be";
            $tm2 = "@thomasmore.be";

            if(empty($email)){
                throw new Exception("Email cannot be empty.");
            }
            if(preg_match("/\b($tm|$tm2)\b/", $email) === 0){
                throw new Exception("Email should be a TM-email");
            }
            
            $this->email = $email;

            return $this;

        }

        public function getUsername()
        {
                return $this->username;
        }

        public function setUsername($username)
        {
            if(empty($username)){
                throw new Exception("Username cannot be empty.");
            }
            $this->username = $username;

            return $this;
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function setPassword( $password )
        {
            if(strlen($password) < 5){
                throw new Exception("Passwords must be longer than 6 characters.");
            }

            $this->password = $password;
            return $this;
        }


        public function getError()
        {
                return $this->error;
        }
        public function setError($error)
        {
                $this->error = $error;

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
                throw new Exception("User not exist.");
                return false;
            }
            //password not hashed yet
            if(password_verify($this->password, $user['password'])){
                return true;
            }
            // if($this->password == $hash){
                
            //     return true;
            // }
            else{
                throw new Exception("Password not right.");
                return false;
            }
        }

        public function register() {
            $options = [
                'cost' => 12
            ];
            $password = password_hash($this->password, PASSWORD_DEFAULT, $options);
            $email = $this->email;
            $username = $this->username;
            $conn = Db::getInstance();
            $stmt= $conn->prepare("INSERT INTO users (email, username, password) VALUES (:email,:username,:password)");
            $stmt->bindValue(":email", $email);
            $stmt->bindValue(":username", $username);
            $stmt->bindValue(":password", $password);
            $stmt->execute();
        }

        //delete user from database
        public function deleteUser() {
            $conn = Db::getInstance();
            $sql = "DELETE FROM users WHERE username = '$this->username'";
            $stmt= $conn->prepare($sql);
            $stmt->execute();
        }       



    }