<?php
    class User {
        public $id;
        public $username;
        public $password;
        public $first_name;
        public $last_name;
        protected static $db_table = "users";

        public static function find_all_users() {
            return self::run_query("SELECT * FROM " . self::$db_table);
        }
        public static function find_user_by_id($id) {
            return self::run_query("SELECT * FROM " .  self::$db_table . " WHERE id={$id} LIMIT 1")[0];
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
        public static function verify_user($username, $password) {
            global $database;
            $username = $database->escape_string($username);
            $password = $database->escape_string($password);
            $sql = "SELECT * FROM " . self::$db_table . " WHERE ";
            $sql .= "username = '{$username}' ";
            $sql .= "AND password = '{$password}' ";
            $sql .= "LIMIT 1";

            return self::run_query($sql)[0];
        }

        public function save() {
            return isset($this->id) ? $this->update() : $this->create();
        }

        public function create() {
            global $database;
            $sql = "INSERT into " . self::$db_table . " (username, password, first_name, last_name )";
            $sql .= "VALUES('";
            $sql .= $database->escape_string($this->username) . "', '";
            $sql .= $database->escape_string($this->password) . "', '";
            $sql .= $database->escape_string($this->first_name) . "', '";
            $sql .= $database->escape_string($this->last_name) . "')";
    
            if($database->query($sql)) {
                $this->id =  $database->find_new_id();
                return true;
            }
            else {
                return false;
            }
        }
        public function update() {
            global $database;
            $sql = "UPDATE " . self::$db_table . " SET ";
            $sql .= "username= '" . $database->escape_string($this->username) . "',";
            $sql .= "password= '" . $database->escape_string($this->password) . "',";
            $sql .= "first_name= '" . $database->escape_string($this->first_name) . "',";
            $sql .= "last_name= '" . $database->escape_string($this->last_name) . "' ";
            $sql .= "WHERE id= " . $database->escape_string($this->id);

            $database->query($sql);
            return (mysqli_affected_rows($database->connection) == 1) ? true : false;
        }
        public function delete(){
            global $database;
            $sql = "DELETE FROM " . self::$db_table;
            $sql .= " WHERE id= " . $database->escape_string($this->id);
            $sql .= " LIMIT 1";

            $database->query($sql);
            return (mysqli_affected_rows($database->connection) == 1) ? true : false;

        }
    }
?>