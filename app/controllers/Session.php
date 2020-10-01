<?php
class Session {
    public static function exists($name){
        return (isset($_SESSION[$name]))? true : false;
    }

    public static function set($data) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        foreach ($data as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    public static function get($key) {
        return $_SESSION[$key];
    }

}

?>