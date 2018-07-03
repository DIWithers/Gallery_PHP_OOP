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
            return self::run_query("SELECT * FROM users WHERE id={$id} LIMIT 1")[0];
        }
        public static function run_query($query) {
            global $database;
            $query_results = $database->query($query); 
            $results_array = array();
            while($row = mysqli_fetch_array($query_results)) {
                $results_array[] = self::instantiate($row);
            }
            return $results_array;
        }
        public static function instantiate($user_result) {
            $user = new self;
            foreach($user_result as $property => $value) {
                if ($user->has_property($property)) {
                    $user->$property = $value;
                }
            }
            return $user;
        }
        private function has_property($property) {
            $all_properties = get_object_vars($this);
            return array_key_exists($property, $all_properties);
        }
        public static function verify_user() {
            global $database;
            $username = $database->escape_string($username);
            $password = $database->escape_string($password);
            $sql = "SELECT * FROM users WHERE ";
            $sql .= "username = '{$username}' ";
            $sql .= "AND password = '{$password}' ";
            $sql .= "LIMIT 1";

            $result = self::run_query($sql);
            return !empty($result) ? array_shift($result) : false;
        }
    }
?>