
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Food Truck</title>

<!--Remy Sharp Shim --> 
<!--[if lte IE 9]> 
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js" >
</script> 
<![endif]-->
<?php
    //require 'item.php';
    require 'form_handler.php';
    //require 'custom.php';
?>
<link href="css/styles.css" rel="stylesheet" type="text/css">
</head>
<header><img src="images/logo.jpg" id="logo" alt="logo"></header>
<body>
<div id="wrapper">
<main>
<h2>Place an Order</h2>
<form action="" method="post">
<fieldset>
    
<!--
<pre>
<?php var_dump($fillings); ?>
</pre>
-->
    
<h4>Taco Filling</h4>
    <select name="filling">
    <?php
        // ' . XXX . '
    
        //If we have an array of menu items
        if (isset($fillings)) {
            //Populate the dropdown from the array.
            foreach($fillings as $filling) {
                //HTML checkboxes.
                echo '<option value="' . $filling . '">';
                echo $filling;
                echo '</option>';
            }
        //Error handling will go here.
        } else {
            
        }
    ?>
    </select>

<h4>Quantity</h4>
<textarea id="qty" rows="1"></textarea>

<h4>Extras</h4>

<?php
    // ' . XXX . '
    
    //If we have an array of menu items
    if (isset($extras)) {
        //Populate the dropdown from the array.
        foreach($extras as $extra) {
            //HTML checkboxes.
            echo '<p><input type="checkbox" name="extras" value="' . $extra . '">' . $extra . '</p>';
        }
    //Error handling will go here.
    } else {
    }
    
?>
<!--
<p><input type="checkbox" name="Guacamole" value="Guacamole">Guacamole</p>
<p><input type="checkbox" name="Sour" value="Sour" >Sour Cream</p>
<p><input type="checkbox" name="Pico" value="Pico" >Pico de Gallo</p>
<p><input type="checkbox" name="Jalapenos" value="Jalapenos">Jalapenos</p>
<p><input type="checkbox" name="Cheese" value="Cheese">Cheese</p>
-->

</fieldset>
<input type="submit" value="Add to Order">
<fieldset>
<legend>Your Order</legend>



<textarea name="instructions" rows="8"></textarea>


</fieldset>
<input type="submit" value="Complete Order">
</form>
</main>
<aside>
<img src="images/veggie.jpg" id="veggie" alt="veggie">
<img src="images/beef.jpg" id="beef" alt="beef">

</aside>
</div>
</body>
</html>
