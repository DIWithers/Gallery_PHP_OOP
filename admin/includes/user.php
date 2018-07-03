<?php
    class User {
        public $id;
        public $username;
        public $password;
        public $first_name;
        public $last_name;

        public static function find_all_users() {
            return self::run_query("SELECT * FROM users");
        }
        public static function find_user_by_id($id) {
            $result = self::run_query("SELECT * FROM users WHERE id={$id} LIMIT 1");
            return mysqli_fetch_array($result);
        }
        public static function run_query($query) {
            global $database;
            return $database->query($query); 
        }
        public static function instantiate($user_result) {
            $user = new self;
            $user->id = $user_result['id'];
            $user->username = $user_result['username'];
            $user->password = $user_result['password'];
            $user->first_name = $user_result['first_name'];
            $user->last_name = $user_result['last_name'];
            return $user;
        }
    }
?>