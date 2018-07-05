<?php
    class User {
        public $id;
        public $username;
        public $password;
        public $first_name;
        public $last_name;
        protected static $db_table = "users";
        protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');

        public static function find_all() {
            return self::run_query("SELECT * FROM " . self::$db_table);
        }
        public static function find_by_id($id) {
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

        protected function properties() {
            return get_object_vars($this);
            // $properties = array();
            // foreach(self::$db_table_fields as $db_field) {
            //     if (property_exists($this, $db_field)) {
            //         $properties[$db_field] = $this->$db_field;
            //     }
            // }
            // return $properties;
        }
        protected function clean_properties() {
            global $database;
            $clean_properties = array();
            foreach($this->properties() as $key => $value) {
                $clean_properties[$key] = $database->escape_string($value);
            }
            return $clean_properties;
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
            $properties =  $this->clean_properties();
            $sql = "INSERT into " . self::$db_table . " (" . implode(',', array_keys($properties)) .") ";
            $sql .= "VALUES('" . implode("','", array_values($properties)) . "')";
    
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
            $properties =  $this->clean_properties();
            $property_pairs = array();
            foreach ($properties as $key => $value) {
                $property_pairs[] = "{$key}='{$value}'";
            }

            $sql = "UPDATE " . self::$db_table . " SET ";
            $sql .= implode(", ", $property_pairs);
            $sql .= " WHERE id= " . $database->escape_string($this->id);

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