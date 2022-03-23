<?php
    abstract class Security {
        public static function onlyLoggedInUsers() {
            session_start();
            if(!isset($_SESSION['username'])){
                echo "not logged in";
                return false;
            }
            else{
                echo " logged in";
                return true;
            }
        }
    }