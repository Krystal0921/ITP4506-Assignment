<?php
class user
{ 
    public $user_ID;
    public $user_Name;
    public $user_Password;
    public $user_Email_Address;
    public $user_Phone_Number;
    public $user_Address;
    public $user_District;
    public $user_Transportation;
    public $user_Logo;
    public $user_Type;

    public function __construct($user_ID, $user_Name, $user_Password, $user_Email_Address, $user_Phone_Number, $user_Address, $user_District, $user_Transportation, $user_Logo, $user_Type) 
    {
        $this->user_ID = $user_ID;
        $this->user_Name = $user_Name;
        $this->user_Password = $user_Password;
        $this->user_Email_Address = $user_Email_Address;
        $this->user_Phone_Number = $user_Phone_Number;
        $this->user_Address = $user_Address;
        $this->user_District = $user_District;
        $this->user_Transportation = $user_Transportation;
        $this->user_Logo = $user_Logo;
        $this->user_Type = $user_Type;
    }
}
?>