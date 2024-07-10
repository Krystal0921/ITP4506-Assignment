<?php
class restaurant_delivery_list
{
    public $d_ID;
    public $r_ID;
    public $d_Name;
    public $d_Phone_Number;
    public $d_District;
    public $d_Transportation;

    public function __construct($d_ID, $r_ID, $d_Name, $d_Phone_Number, $d_District, $d_Transportation) 
    {
        $this->d_ID = $d_ID;
        $this->r_ID = $r_ID;
        $this->d_Name = $d_Name;
        $this->d_Phone_Number = $d_Phone_Number;
        $this->d_District = $d_District;
        $this->d_Transportation = $d_Transportation;
    }
}
?>