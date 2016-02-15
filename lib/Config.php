<?php namespace Payment;

class Config
{
  public function __construct(){
    $this->data = include( ROOTDIR.'/config.php' );
  }
  
  public function get( $key, $default=false )
  {
    $config = $this->data;
    $parts = explode( ':', $key );
    while( count($parts) > 1 ){
      $part = array_shift( $parts );
      if( isset( $config[$part] ) ){
        $config = $config[$part];
      }
      else {
        return $default;
      }
    }
    $key = $parts[0];
    return isset( $config[$key] ) ? $config[$key] : $default;
  }
}