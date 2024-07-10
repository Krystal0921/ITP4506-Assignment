<?php
class order_content
{
  public $o_ID;
  public $f_ID;
  public $o_Quantity;
  public $o_Seq_ID;
 
  public function __construct($o_ID, $f_ID, $o_Quantity, $o_Seq_ID)
  {
    $this->o_ID = $o_ID;
    $this->f_ID = $f_ID;
    $this->o_Quantity = $o_Quantity;
    $this->o_Seq_ID = $o_Seq_ID;
  }
}
?>