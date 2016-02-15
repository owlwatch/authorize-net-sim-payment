<?php namespace Payment;

class Assets
{
  public function __construct()
  {
    $this->root = ROOTURL.'/assets';
  }
  
  public function url( $path )
  {
    return $this->root.$path;
  }
}
