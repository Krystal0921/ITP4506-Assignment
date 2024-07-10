<?php
class menu
{
  public $type;
  public $foods;

  public function __construct($type, $foods = array()) 
  {
    $this->type = $type;
    $this->foods = $foods;
  }
}
?>