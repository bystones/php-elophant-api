<?php

namespace Elophant;

class Autoloader {

    static public function register() {
        spl_autoload_register(array(new self, 'autoload'));
    }

    static public function autoload($class) {
        if (0 !== strpos($class, 'Elophant')) {
            return null;
        }

        $file = __DIR__ . '/../' . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }

}
