<?php
class restaurant_orders_food_list
{
    public $o_ID;
    public $r_ID;
    public $f_ID;
    public $o_Quantity;
    public $f_Name;
    public $f_Image;

    public function __construct($o_ID, $r_ID, $f_ID, $o_Quantity, $f_Name, $f_Image) 
    {
        $this->o_ID = $o_ID;
        $this->r_ID = $r_ID;
        $this->f_ID = $f_ID;
        $this->o_Quantity = $o_Quantity;
        $this->f_Name = $f_Name;
        $this->f_Image = $f_Image;
    }
}
?>