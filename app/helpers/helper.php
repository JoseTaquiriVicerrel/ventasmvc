<?php
if(! function_exists('myEcho')){
  function myEcho ($data)
  {
    echo "<pre>", print_r($data), "</pre>";
  }
}
if (!function_exists('env')) {
  function env( $key , $default = null )
  {
    if(array_key_exists($key,$_ENV) ){
      return $_ENV[$key];
    }else{
      return $default;
    }
  }
}