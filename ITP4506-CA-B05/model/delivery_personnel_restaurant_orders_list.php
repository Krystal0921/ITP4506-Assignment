<?php
class delivery_personnel_restaurant_orders_list
{
    public $o_ID;
    public $r_ID;
    public $r_Name;
    public $r_Address;
    public $o_Delivery_Address;
    public $c_Name;
    public $c_Phone_Number;

    public function __construct($o_ID, $r_ID, $r_Name, $r_Address, $o_Delivery_Address, $c_Name, $c_Phone_Number) 
    {
        $this->o_ID = $o_ID;
        $this->r_ID = $r_ID;
        $this->r_Name = $r_Name;
        $this->r_Address = $r_Address;
        $this->o_Delivery_Address = $o_Delivery_Address;
        $this->c_Name = $c_Name;
        $this->c_Phone_Number = $c_Phone_Number;
    }
}
?>