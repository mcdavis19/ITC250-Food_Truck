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
    
    define('EXTRAS_FEE', 0.25);
    
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
        //If array
        if (is_array($extras)) {
            //If only one item.
            //Add that one item from array.
            if (count($extras) == 1) {
                $this->Extras[] = extras[0];
            } else {
                //Otherwise add each item in array
                foreach($extra as $item) {
                $this->Extras[] = $extra;
                }
            }
        //If it's not an array, just add the single item.
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
    
    public function toString() {
        $output = "$this->Quantity $this->Filling tacos with";
        foreach($this->Extras as $extra) {
            $output .= " " . $extra;
        }
        $output .= ": ";
        $output .= "$";
        $output .= $this::calculateBasePrice() + $this::calculateExtrasCost();
        return $output;
    }
// Calculates the base price for the number of the tacos ordered
    
    public function calculateBasePrice()
    {
        $basePrice = $this->Price * $this->Quantity;
        return number_format($basePrice, 2);
    }
   
   //Calculates the cost of the added extras
   
    public function calculateExtrasCost()
    {
        $extrasCost = count($this->Extras) * self->EXTRAS_FEE;
        return number_format($extrasCost, 2);
    }
    
    //Calculates the total cost of all the selected extras
   
    public function calculateExtrasCostTotal()
    {
        $extrasCostTotal = $this->calculateExtrasCost() * $this->Quantity;
        return number_format($extrasCostTotal, 2);
    }
   
   //Calculates the total of each taco price with extras before tax.
   
    
    public function calculateSubtotalBeforeTax() 
    {
        $subtotalBefore = ($this->Price + $this->calculateExtrasCost())* $this->Quantity;
        return number_format($subtotalBefore, 2);
    }
    
    //Calculates the price of a taco with tax
    
    public function calculateTax() 
    {
        //$taxTotal = ($this->price + $this->CalculateExtrasCost()) * self::$TAX;
        $taxTotal = $this->calculateSubtotalBeforeTax() * self::$TAX;
        return number_format($taxTotal, 2);
    }
    
    // Calculates the cost of ordering a taco
   
    public function calculatePerItemSubtotal()
    {
       
        $subtotal = ($this->Price  + $this->CalculateExtrasCost())  * (self::$TAX + 1);
        $subtotal = $this->calculateSubtotalBeforeTax()  * (self::$TAX + 1);
        return number_format($subtotal, 2);
    }
}#end Item class