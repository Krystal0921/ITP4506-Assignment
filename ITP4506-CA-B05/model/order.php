<?php
class order
{
    public $o_ID;
    public $c_ID;
    public $r_ID;
    public $d_ID;
    public $o_Time;
    public $o_Delivery_Address;
    public $o_Payment_Method;
    public $o_Status;
    public $o_Estimated_Time;
    public $o_Delivery_Time;
    public $o_Food_Rate;
    public $o_Service_Rate;
    public $o_Comment;
    public $o_Total_Amount;
    public $o_Delivery_Fee;

    public function __construct($o_ID, $c_ID, $r_ID, $d_ID, $o_Time, $o_Delivery_Address, $o_Payment_Method, $o_Status, $o_Estimated_Time, $o_Delivery_Time, $o_Food_Rate, $o_Service_Rate, $o_Comment, $o_Total_Amount, $o_Delivery_Fee) 
    {
        $this->o_ID = $o_ID;
        $this->c_ID = $c_ID;
        $this->r_ID = $r_ID;
        $this->d_ID = $d_ID;
        $this->o_Time = $o_Time;
        $this->o_Delivery_Address = $o_Delivery_Address;
        $this->o_Payment_Method = $o_Payment_Method;
        $this->o_Status = $o_Status;
        $this->o_Estimated_Time = $o_Estimated_Time;
        $this->o_Delivery_Time = $o_Delivery_Time;
        $this->o_Food_Rate = $o_Food_Rate;
        $this->o_Service_Rate = $o_Service_Rate;
        $this->o_Comment = $o_Comment;
        $this->o_Total_Amount = $o_Total_Amount;
        $this->o_Delivery_Fee = $o_Delivery_Fee;
    }
}
?>