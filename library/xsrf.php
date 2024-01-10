<?php

class XSRF{
    //XSRF protection class

    private static $form_field_name = 'token';
    private static $cookie_name = 'token';

    public static function checktoken(){
      //XSRF check
      $formCode = null;
      $cookieCode = null;

      if(isset($_COOKIE[self::$cookie_name]) && isset($_POST[self::$form_field_name])){
        $formCode = $_POST[self::$form_field_name];
        $cookieCode = $_COOKIE[self::$cookie_name];
      }
      else{
        throw new Exception('XSRF check failed');
      }

      if(base64_decode($formCode) != hex2bin($cookieCode)){
        throw new Exception('XSRF check failed');
      }

      return true;
    }

    public static function createtoken(){
      //create a XSRF code
      if(!isset($_COOKIE[self::$cookie_name])){
        $code = bin2hex(random_bytes(16));
      }
      else{
        $code = $_COOKIE[self::$cookie_name];
      }

      setcookie(self::$cookie_name, $code, time() + 86400);

      return base64_encode(hex2bin($code));
    }
}