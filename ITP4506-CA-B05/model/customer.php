<?php
class customer
{
    public $c_ID;
    public $c_Name;
    public $c_Password;
    public $c_Email_Address;
    public $c_Phone_Number;
    public $c_Address;

    public function __construct($c_ID, $c_Name, $c_Password, $c_Email_Address, $c_Phone_Number, $c_Address)
    {
        $this->c_ID = $c_ID;
        $this->c_Name = $c_Name;
        $this->c_Password = $c_Password;
        $this->c_Email_Address = $c_Email_Address;
        $this->c_Phone_Number = $c_Phone_Number;
        $this->c_Address = $c_Address;
    }
}
?>