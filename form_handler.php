<?php

include 'item.php';
session_set_cookie_params(3600,"/");
session_start();
/*
Form handler
*/



//An array of the fillings for the various Mexican items.
if(!isset($fillings)) {
    $fillings = array();
    $fillings['Chicken'] = 3;
    $fillings['Beef'] = 4;
    $fillings['Pork'] = 4;
    $fillings['Chorizo'] = 5;
    $fillings['Mole Chicken'] = 5;
    $fillings['Veggie'] = 2;
}

//Create menu array.
//This will hold our basic item items.
if(!isset($menu)) {
    $menu = array();
    $i = 0;
    foreach($fillings as $filling => $price) {
        //Item constructor for reference.
        //__construct($ID, $Name, $Description = '',$Price = 0, $Filling = '', $Quantity = 0, $Extras = array())
        $menu[] = new Item($i, 'Taco', 'A crisp taco filled with Mexican goodness. Muy rico!', $price, $filling);
        $i++;
    }
}
/*
Create extras array
This will be used to populate our list of extras 
in the HTML form using a PHP for loop.

Because the Item class we made in class simply used strings, I'm using strings here. 

Lowercase is used for simplicity. This can be changed in the HTML form if we need.

Feel free to add to this if you come up with any ideas for 
other extras!
*/
if (!isset($extras)) {
    $extras = array();
    $extras[] = 'Sour Cream';
    $extras[] = 'Jalapenos';
    $extras[] = 'Extra Meat';
    $extras[] = 'Guacamole';
    $extras[] = 'Queso Fresco';
    $extras[] = 'Cilanto Lime Sauce';
}

//Order array
//Holds items that have been added to the order.
if (!isset($_SESSION['order'])) {
  $_SESSION['order'] = array();  
}

$action = $_POST['action'];

//Handle actions from webform
switch ($action) {
    //Create new Item from form data and add to $order array.
    case 'Add to Order':
        $quant = filter_input(INPUT_POST,'qty');//User input 
        
        //Validate Quantity
        if (!is_numeric($quant) || $quant < 1) {
            $_POST['error'] = 'Please enter a valid quantity.';
            break;
        }
        
        $itemID = $_POST['itemID'];             //Dropdown
        $order_extras = $_POST['extras'];       //Checkboxes
        
        foreach($menu as $item) {
            if ($item->ID == $itemID) {
                $newOrderItem = clone $item;
                $newOrderItem->addExtra($order_extras);
                $newOrderItem->Quantity = $quant;
                array_push($_SESSION['order'], $newOrderItem);
                //Post gets item from Session, but it doesn't persist.
                $_POST['newitem'] = $_SESSION['order'];
            }
        }
        break;
    //Restart session
    case 'Start Over':
        unset($_SESSION['order']);
        $action = '';
//        $_SESSION['order'] = array(); 
//        session_abort();
//        session_start();
        break;
        
    //Total the order and apply tax.
    case 'Complete Order':
         //create the order summary showing all the items and Extra ordered,
        //the subtotal for each item, and a cumulative total cost due.
    $total = 0;
    foreach ($_SESSION['order'] as $item) {
        echo '  <h4>' . $item->toString() . '</h4>
                <p>Base Price: ($' . $item->Price . ' /per item)</p>
                <p class="cost">$' . $item->calculateBasePrice() . ' </p> 
                <p>Extras Price: ($0.25 /per extra) </p>';
        
        //display extra price as 0.00 if there is no extra added
        if (!empty($item->extras)){
                echo '<p class="cost">$0.00 </p>';
        }else{
                echo'<p class="cost">$' . $item->calculateExtrasCostTotal() . ' </p>';}//end of if statment
        
        echo '  <p>Subtotal Before Tax: </p>
                <p class="cost">$' . $item->calculateSubtotalBeforeTax() . ' </p>-->
                <p>Tax (9.6%)</p>
            <p class="cost">$' . $item->calculateTax() . ' </p>
            <hr>
            <p>Subtotal:</p>
            <p class="cost">$' . $item->calculatePerItemSubtotal() . ' </p>
            <br>
            <br>';
    
        //calculate total
        $total += $item->calculatePerItemSubtotal();
    }//end of foreach loop
    //display total
    echo '<h5 class="total">Total price:</h5>
        <p class="total">$' . number_format($total, 2) . ' </p>';
       break;
    //Error handling here.
    default:
        break;
}


