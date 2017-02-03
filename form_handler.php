<?php

include 'item.php';

/*
Form handler
*/

/*
An array that will hold the items in the current order.
This will be used to list the ordered items at the bottom of the page beneath the form. Items will be added to the array on a button click.
*/
$order = array();

//Create menu array.
//This will hold our basic food items.
$menu = array();
$menu[] = new Item(1, 'Taco', 'A crisp taco filled with Mexican goodness. Muy rico!', 1);
//$menu[] = new Item(2, 'Burrito', 'These burritos are the size of a small donkey!', 5);
//$menu[] = new Item(3, 'Flautas', 'Three long, musical taco rolls fileld with deliciousness.', 3);

//An array of the fillings for the various Mexican items.
$fillings = array();
$fillings[] = 'Chicken';
$fillings[] = 'Beef';
$fillings[] = 'Pork';
$fillings[] = 'Chorizo';
$fillings[] = 'Mole Chicken';
$fillings[] = 'Veggie';


$menu = array();
for($i = 0; $i < sizeof($fillings); $i++) {
    $menu[] = new Item($i, 'Taco', 'A crisp taco filled with Mexican goodness. Muy rico!', 1, $fillings[$i]);
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
$extras = array();
$extras[] = 'sour cream';
$extras[] = 'jalapenos';
$extras[] = 'extra meat';
$extras[] = 'guacamole';
$extras[] = 'queso fresco';
$extras[] = 'cilanto lime sauce';

//Order array
//Holds items that have been added to the order.
$order = array();

$action = $_POST['action'];

//Handle actions from webform
switch ($action) {
    //Create new Item from form data and add to $order array.
    case 'Add to Order':
        $itemID = $_POST['itemID'];             //Dropdown
        $quant = filter_input(INPUT_POST,'qty');//User input  
        $order_extras = $_POST['extras'];       //Checkboxes
        
        $spec_instr = htmlspecialchars($_POST['instructions']);
        
        foreach($menu as $item) {
            if ($item->ID == $itemID) {
                
                $newOrderItem = $item;
                $newOrderItem->addExtra($order_extras);
                $newOrderItem->Quantity = $quant;
                $order[] = $newOrderItem;
            }
        }
        
    //Total the order and apply tax.
    case 'Complete Order':
        
    //Error handling here.
    default:
}


