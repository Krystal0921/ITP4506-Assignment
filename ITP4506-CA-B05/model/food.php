<?php
class food
{
    public $f_ID;
    public $f_Name;
    public $f_Image;
    public $f_Type;
    public $f_Price;
    public $f_descriptions;
    public $r_ID;

    public function __construct($f_ID, $f_Name, $f_Image, $f_Type, $f_Price, $f_descriptions, $r_ID)
    {
        $this->f_ID = $f_ID;
        $this->f_Name = $f_Name;
        $this->f_Image = $f_Image;
        $this->f_Type = $f_Type;
        $this->f_Price = $f_Price;
        $this->f_descriptions = $f_descriptions;
        $this->r_ID = $r_ID;
    }
}
?>