<?php

class Item
{
    public $ID = 0;
    public $Name = '';
    public $Description = '';
    public $Price = 0;
    public $Filling = '';
    public $Quantity = 0;
    public $Extras = array();
    
    public function __construct($ID, $Name, $Description = '',$Price = 0, $Filling = '', $Quantity = 0, $Extras = array())
    {
        $this->ID = $ID;
        $this->Name = $Name;
        $this->Description = $Description;
        $this->Price = $Price;
        $this->Quantity = 0;
        
    }#end Item constructor
    
    public function addExtra($extra)
    {
        $this->Extras[] = $extra;
        
    }#end addExtra()
    
    public function addQuantity($quant = 1)
    {
        $this->Quantity += $quant;
    }#End addQuantity()

}#end Item class