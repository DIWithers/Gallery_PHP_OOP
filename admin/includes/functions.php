<?php 
    // checks for file inclusion and corrects if forgotten
    function classAutoLoader($class) {
        $class = strtolower($class);
        $path = "includes/{$class}.php";
        if(file_exists($path)) {
            require_once($path);
        }
        else die ("ERROR : The filename {$class}.php was not found.");
    }
    spl_autoload_register("classAutoLoader");

?>