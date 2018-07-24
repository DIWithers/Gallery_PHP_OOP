<?php
    class Comment extends DB_Object {
        public $id;
        public $photo_id;
        public $author;
        public $body;
        protected static $db_table = "comments";
        protected static $db_table_fields = array('id', 'photo_id', 'author', 'body');

        public static function create_comment($photo_id, $author, $body) {
            if (!empty($photo_id) && !empty($author) && !empty($body)) {
                $comment = new Comment();
                $comment->photo_id = (int)$photo_id;
                $comment->author = $author;
                $comment->body = $body;
                return $comment;
            } 
            else return false;
        }
    }
?>