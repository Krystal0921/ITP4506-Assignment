<?php
class restaurant
{
    public $r_ID;
    public $r_Name;
    public $r_Password;
    public $r_Address;
    public $r_Telephone_Number;
    public $r_Image;

    public function __construct($r_ID, $r_Name, $r_Password, $r_Address, $r_Telephone_Number, $r_Image)
    {
        $this->r_ID = $r_ID;
        $this->r_Name = $r_Name;
        $this->r_Password = $r_Password;
        $this->r_Address = $r_Address;
        $this->r_Telephone_Number = $r_Telephone_Number;
        $this->r_Image = $r_Image;
    }
}
?>