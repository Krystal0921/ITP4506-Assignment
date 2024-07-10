<?php
class restaurant_orders_list
{
    public $o_ID;
    public $c_ID;
    public $r_ID;
    public $o_Time;
    public $o_Delivery_Address;
    public $c_Phone_Number;
    public $o_Total_Amount;

    public function __construct($o_ID, $c_ID, $r_ID, $o_Time, $o_Delivery_Address, $c_Phone_Number, $o_Total_Amount) 
    {
        $this->o_ID = $o_ID;
        $this->c_ID = $c_ID;
        $this->r_ID = $r_ID;
        $this->o_Time = $o_Time;
        $this->o_Delivery_Address = $o_Delivery_Address;
        $this->c_Phone_Number = $c_Phone_Number;
        $this->o_Total_Amount = $o_Total_Amount;
    }
}
?>