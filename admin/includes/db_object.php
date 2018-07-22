
<!-- $ tail -f /Applications/MAMP/logs/php_error.log   /for errors/ -->
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
        public static function instantiate($result) {
            $calling_class = get_called_class();
            $instantiated_class = new $calling_class;
            foreach($result as $property => $value) {
                if ($instantiated_class->has_property($property)) {
                    $instantiated_class->$property = $value;
                }
            }
            return $instantiated_class;
        }
        private function has_property($property) {
            $all_properties = get_object_vars($this);
            return array_key_exists($property, $all_properties);
            // return property_exists($this, $the_attribute);
        }
        protected function properties() {
            $properties = array();
            foreach(static::$db_table_fields as $db_field) {
                if (property_exists($this, $db_field)) {
                    $properties[$db_field] = $this->$db_field;
                 }
              }
            return $properties;
        }
        
        protected function clean_properties() {
            global $database;
            $clean_properties = array();
            foreach($this->properties() as $key => $value) {
                $clean_properties[$key] = $database->escape_string($value);
            }
            return $clean_properties;
        }
        public function save() {
            return isset($this->id) ? $this->update() : $this->create();
        }

        public function create() {
            global $database;
            $properties =  $this->clean_properties();
            $sql = "INSERT INTO " . static::$db_table . " (" . implode(',', array_keys($properties)) .") ";
            $sql .= "VALUES('" . implode("','", array_values($properties)) . "')";
    
            if($database->query($sql)) {
                $this->id = $database->find_new_id();
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

            $sql = "UPDATE " . static::$db_table . " SET ";
            $sql .= implode(", ", $property_pairs);
            $sql .= " WHERE id= " . $database->escape_string($this->id);

            $database->query($sql);
            return (mysqli_affected_rows($database->connection) == 1) ? true : false;
        }
        public function delete(){
            global $database;
            $sql = "DELETE FROM " . static::$db_table;
            $sql .= " WHERE id= " . $database->escape_string($this->id);
            $sql .= " LIMIT 1";

            $database->query($sql);
            return (mysqli_affected_rows($database->connection) == 1) ? true : false;
        }
    }
?>