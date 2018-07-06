<?php 
    class Photo extends DB_Object {
        protected static $db_table = "photos";
        public $photo_id;
        public $title;
        public $description;
        public $filename;
        public $type;
        public $size;

    }
?>