<?php
    class User {
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
    }
?>


<?php
    // class User {
    //     public static function find_all_users() {
    //         global $database;
    //         return $database->query("SELECT * FROM users");
    //     }
    //     public static function find_user_by_id($id) {
    //         global $database;
    //         $result = $database->query("SELECT * FROM users WHERE id={$id} LIMIT 1");
    //         return mysqli_fetch_array($result);
    //     }
    // }
?>