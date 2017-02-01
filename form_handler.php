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
$menu[] = new Item(2, 'Burrito', 'These burritos are the size of a small donkey!', 5);
$menu[] = new Item(3, 'Flautas', 'Three long, musical taco rolls fileld with deliciousness.', 3);

//An array of the fillings for the various Mexican items.
$fillings = array();
$fillings[] = 'Chicken';
$fillings[] = 'Beef';
$fillings[] = 'Pork';
$fillings[] = 'Chorizo';
$fillings[] = 'Mole Chicken';
$fillings[] = 'Veggie';

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



