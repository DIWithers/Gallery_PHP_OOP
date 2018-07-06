<?php 
    class Photo extends DB_Object {
        protected static $db_table = "photos";
        public $photo_id;
        public $title;
        public $description;
        public $filename;
        public $filetype;
        public $size;
        protected static $db_table_fields = array('photo_id', 'title', 'description', 'filename', 'filetype', 'size');

    }
?>