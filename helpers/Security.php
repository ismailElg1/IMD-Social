<?php
    abstract class Security {
        public static function onlyLoggedInUsers() {
            session_start();
            if(!isset($_SESSION['email'])){
                echo htmlspecialchars("not logged in");
                return false;
            }
            else{
                return true;
            }
        }
    }