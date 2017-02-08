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
    
    const EXTRAS_FEE = 0.25;
    const TAX = 0.096;
  
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
    public function addExtra($newExtra)
    {
        //If array
        if (is_array($newExtra)) {
            //Loop through array and add extras.
            foreach($newExtra as $extra) {
                $this->Extras[] = $extra;
            }
        //If it's not an array, just add the single item.
        } else {
            $this->Extras[] = $newExtra;
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
        $copy::addExtra($this->Extras);
        
//        foreach($this->Extras as $item) {
//            $copy::addExtra($item);//            //array_push($copy->Extras, $item);
//        }
        return $copy;
    }
    
    public function toString() {
        //2 Pork tacos with jalapenos extra meat: $3.00
        $format = '%d %6s tacos with ';
        $output = sprintf($format, $this->Quantity, $this->Filling);
        
        //Fencepost comma problem
        $output .= " " . $this->Extras[0];
        for($i = 1; $i < count($this->Extras); $i++) {
            $output .= ', ';
            $output .= ' ' . $this->Extras[$i];
        }
        //Number format once right before output.
        $price = number_format($this::calculateBasePrice() + $this::calculateExtrasCostTotal(), 2);
        $output .= sprintf(' $%s', (string)$price);
        return $output;
    }
// Calculates the base price for the number of the tacos ordered
    
    public function calculateBasePrice()
    {
        return $basePrice = $this->Price * $this->Quantity;
    }
   
   //Calculates the cost of the added extras
   
    public function calculateExtrasCost()
    {
        $extrasCost = count($this->Extras) * self::EXTRAS_FEE;
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
        $taxTotal = $this->calculateSubtotalBeforeTax() * self::TAX;
        return number_format($taxTotal, 2);
    }
    
    // Calculates the cost of ordering a taco
   
    public function calculatePerItemSubtotal()
    {
       
        $subtotal = ($this->Price  + $this->CalculateExtrasCost())  * (self::TAX + 1);
        $subtotal = $this->calculateSubtotalBeforeTax()  * (self::TAX + 1);
        return number_format($subtotal, 2);
    }
}#end Item class