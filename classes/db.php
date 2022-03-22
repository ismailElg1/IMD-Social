<?php
    abstract class Db {
        private static $conn;

        public static function getInstance(){
            if(self::$conn != null){
                echo "🚫";
                // connection found, return connection
                var_dump(self::$conn);
            } else{
                $config = parse_ini_file("config/config.ini");
                self::$conn = new PDO('mysql:host='. $config['db_host'] .';dbname=' . $config['db_name'], $config['db_user'], $config['db_password'] );
                var_dump(self::$conn);
            }
            
        }
    }