<?php
class delivery_personel
{
    public $d_ID;
    public $d_Name;
    public $d_Password;
    public $d_Phone_Number;
    public $d_District;
    public $d_Transportation;

    public function __construct($d_ID, $d_Name, $d_Password, $d_Phone_Number, $d_District, $d_Transportation) 
    {
        $this->d_ID = $d_ID;
        $this->d_Name = $d_Name;
        $this->d_Password = $d_Password;
        $this->d_Phone_Number = $d_Phone_Number;
        $this->d_District = $d_District;
        $this->d_Transportation = $d_Transportation;
    }
}
?>