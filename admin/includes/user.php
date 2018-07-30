<?php
    class User extends DB_Object {
        public $id;
        public $username;
        public $password;
        public $first_name;
        public $last_name;
        public $user_image;
        public $upload_directory = "images";
        public $image_placeholder = "http://placehold.it/400x400&text=image";
        protected static $db_table = "users";
        protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image');

        public function image_path_or_placeholder() {
            return empty($this->user_image) 
            ? $this->image_placeholder : $this->upload_directory . DS .  $this->user_image;
        }

        public static function verify_user($username, $password) {
            global $database;
            $username = $database->escape_string($username);
            $password = $database->escape_string($password);
            $sql = "SELECT * FROM " . self::$db_table . " WHERE ";
            $sql .= "username = '{$username}' ";
            $sql .= "AND password = '{$password}' ";
            $sql .= "LIMIT 1";

            $results = self::run_query($sql);
            return empty($results) ? false : array_shift($results);
        }
        public static function get_latest_photo($id) {
            $sql = "SELECT user_image FROM " . self::$db_table . " WHERE ";
            $sql .= "id = '{$id}' ";
            $sql .= "LIMIT 1";
            
            $results = self::run_query($sql)[0];
            return empty($results) ? false : array_shift($results);
        }
    }
?>