<?php 
    class Photo extends DB_Object {
        public $photo_id;
        public $title;
        public $description;
        public $filename;
        public $filetype;
        public $size;
        public $tmp_path;
        public $upload_directory = "images";
        protected static $db_table = "photos";
        protected static $db_table_fields = array('photo_id', 'title', 'description', 'filename', 'filetype', 'size');
        public $errors = array();
        public $upload_errors_desc =  array(
            UPLOAD_ERR_OK => "There is no error, the file uploaded with success",
            UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive in php.ini.",
            UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.",
            UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
            UPLOAD_ERR_NO_FILE => "No file was uploaded.",
            UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
            UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
            UPLOAD_ERR_EXTENSION => " A PHP extension stopped the file upload."
        );

        public function set_file($file) {
            if(empty($file) || !$file || !is_array($file)) {
                $this->errors[] = "Error: No file uploaded.";
                return false;
            }
            if ($file['error'] !=0) {
                $this->errors[] = $this->upload_errors_desc[$file['error']];
                return false;
            }
            else {
                $this->filename = basename($file['name']);
                $this->tmp_path = $file['tmp_name'];
                $this->type = $file['type'];
                $this->size = $file['size'];
            }
        }
        
        public function save() {
            if ($this->photo_id) {
                $this->update();
            }
            if (!empty($this->errors)) {
                return false;
            }
            if (empty($this->filename) || empty($this->tmp_path)) {
                $this->errors[] = "Error: File not available.";
                return false;
            }

            $target_path = SITE_ROOT . DS. 'admin' . DS . $this->upload_directory . DS . $this->filename;
            
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
?>