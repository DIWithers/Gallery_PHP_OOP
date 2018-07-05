<?php 
    class DB_Object {
        public static function find_all() {
            return static::run_query("SELECT * FROM " . static::$db_table);
        }
        public static function find_by_id($id) {
            return static::run_query("SELECT * FROM " .  static::$db_table . " WHERE id={$id} LIMIT 1")[0];
        }
        public static function run_query($query) {
            global $database;
            $query_results = $database->query($query); 
            $results_array = array();
            while($row = mysqli_fetch_array($query_results)) {
                $results_array[] = static::instantiate($row);
            }
            return $results_array;
        }
        public static function instantiate($user_result) {
            $calling_class = get_called_class();
            $user = new $calling_class;
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
    }
?>