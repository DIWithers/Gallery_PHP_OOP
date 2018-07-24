<?php 
    class Photo extends DB_Object {
        public $id;
        public $title;
        public $description;
        public $filename;
        public $filetype;
        public $size;
        public $alt_text;
        public $caption;
        public $tmp_path;
        public $upload_directory = "images";
        protected static $db_table = "photos";
        protected static $db_table_fields = array('id', 'title', 'description', 'filename', 'filetype', 'size', 'alt_text', 'caption');
        
        public function image_path() {
            return $this->upload_directory . DS . $this->filename;
        }

        public function save() {
            if ($this->id) {
                $this->update();
            }
            else {
                if (!empty($this->errors)) {
                    return false;
                }
                if (empty($this->filename) || empty($this->tmp_path)) {
                    $this->errors[] = "Error: File not available.";
                    return false;
                }
                $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;
                if (file_exists($target_path)) {
                    $this->errors[] = "Error: The file {$this->filename} already exists.";
                    return false;
                }
                if (move_uploaded_file($this->tmp_path, $target_path)) {
                    if ($this->create()) {
                        unset($this->tmp_path);
                        return true;
                    }
                }
                else {
                    $this->errors[] = "Error: It is possible you do not have the proper permissions for this file directory.";
                    return false;
                }
            }
        }
        public function delete_photo() {
            if ($this->delete()) {
                $target_path =  SITE_ROOT . DS . 'admin' . DS . $this->image_path();
                return unlink($target_path) ? true : false;
            }
            else {
                return false;
            }
        }
    }
?>