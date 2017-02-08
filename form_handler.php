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
    $fillings[] = 'Chicken';
    $fillings[] = 'Beef';
    $fillings[] = 'Pork';
    $fillings[] = 'Chorizo';
    $fillings[] = 'Mole Chicken';
    $fillings[] = 'Veggie';
}

//Create menu array.
//This will hold our basic food items.
if(!isset($menu)) {
    $menu = array();
    for($i = 0; $i < sizeof($fillings); $i++) {
        $menu[] = new Item($i, 'Taco', 'A crisp taco filled with Mexican goodness. Muy rico!', 1, $fillings[$i]);
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
    $extras[] = 'sour cream';
    $extras[] = 'jalapenos';
    $extras[] = 'extra meat';
    $extras[] = 'guacamole';
    $extras[] = 'queso fresco';
    $extras[] = 'cilanto lime sauce';
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
        $itemID = $_POST['itemID'];             //Dropdown
        $quant = filter_input(INPUT_POST,'qty');//User input  
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
        $_SESSION['order'] = array(); 
        session_abort();
        session_start();
        break;
        
    //Total the order and apply tax.
    case 'Complete Order':
       break;
    //Error handling here.
    default:
        break;
}


