<?php

class Item
{
    public $ID = 0;
    public $Name = '';
    public $Description = '';
    public $Price = 0;
    public $Filling = '';
    public $Quantity = 0;
    //Object - mutable field.
    public $Extras = array();
    
    public function __construct($ID, $Name, $Description = '',$Price = 0, $Filling = '', $Quantity = 0, $Extras = array())
    {
        $this->ID = $ID;
        $this->Name = $Name;
        $this->Description = $Description;
        $this->Filling = $Filling;
        $this->Price = $Price;
        $this->Quantity = 0;
        
    }#end Item constructor
    
    /*
    Adds a single item or an array of items to the extras array.
    @param $extra array or single item.
    */
    public function addExtra($extra)
    {
        
        if (is_array(extras)) {
            foreach($extra as $item) {
                $this->Extras[] = $extra;
            }
        } else {
            $this->Extras[] = $extra;
        }
        
        
    }#end addExtra()
    
    public function addQuantity($quant = 1)
    {
        $this->Quantity += $quant;
    }#End addQuantity()
    
    //Creates a deep copy of the Item.
    //A reference to $Extras will not be shared between the objects.
    public function __clone() {
    
        $copy = new Item($this->ID, $this->Name);
        $copy->Description = $this->Description;
        $copy->Filling = $this->Filling;
        $copy->Price = $this->Price;
        $copy->Quantity = $this->Quantity;
        
        foreach($this->Extras as $item) {
            $copy::addExtra($item);
        }
        return $copy;
    }

}#end Item class