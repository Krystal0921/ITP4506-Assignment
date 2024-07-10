<?php
class order_detail
{
    public $o_ID;
    public $f_ID;
    public $f_Name;
    public $f_Price;
    public $o_Quantity;
    public $o_Total_Amount;
    public $o_Seq_ID;
 
    public function __construct($o_ID, $f_ID, $f_Name, $f_Price, $o_Quantity ,$o_Total_Amount, $o_Seq_ID) {
        $this->o_ID = $o_ID;
        $this->f_ID = $f_ID;
        $this->f_Name = $f_Name;
        $this->f_Price = $f_Price;
        $this->o_Quantity = $o_Quantity;
        $this->o_Total_Amount = $o_Total_Amount;
        $this->o_Seq_ID = $o_Seq_ID;
    }
}
?>