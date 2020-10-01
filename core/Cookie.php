<?php

/**
 *
 */
class Cookie
{

  public static function set($value , $name , $expiry)
  {
    if (setCookie($value , $name , time()+$expiry, '/')) {
      return false;
    }
    return true;
  }

  public static function delete($name)
  {
    self::set($name , '' , time() -1);
  }

  public static function get($name)
  {
    return $_COOKIE[$name];
  }

  public static function exists($name)
  {
    return isset($_COOKIE[$name]);
  }

}

 ?>
