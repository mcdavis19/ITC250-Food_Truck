
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
    
<!--
<pre>
<?php var_dump($menu); ?>
</pre>
-->

<form action="." method="post">
<fieldset>
<h4>Taco Filling</h4>
    <select name="itemID">
    <?php
        // ' . XXX . '
    
        //If we have an array of menu items
        if (isset($menu)) {
            //Populate the dropdown from the array.
            foreach($menu as $item) {
                //HTML checkboxes.
                echo '<option value="' . $item->ID . '">';
                echo $item->Filling;
                echo '</option>';
            }
        //Error handling will go here.
        } else {
            
        }
    ?>
    </select>

<h4>Quantity</h4>
<input type="text" name="qty">

<h4>Extras</h4>
<?php
    // ' . XXX . '
    
    //If we have an array of menu items
    if (isset($extras)) {
        //Populate the dropdown from the array.
        foreach($extras as $extra) {
            //HTML checkboxes.
            echo '<p><input type="checkbox" name="extras[]" value="' . $extra . '">' . $extra . '</p>';
        }
    //Error handling will go here.
    } else {
    }
    
?>
</fieldset>

<!--Special Instructions-->
<fieldset>
<textarea name="instructions" rows="8"></textarea>
</fieldset>
    
<!--Submit-->
<fieldset>
<input type="submit" name="action" value="Add to Order">
</fieldset>
</form>

<legend>Your Order</legend>
<pre>
<?php echo "Debug: ".$debug.'<br>'; ?>
<?php var_dump($_POST); ?>
<?php var_dump($order); ?>
<?php var_dump($menu); ?>
</pre>    
<!--Order will be displayed here-->
<form action="." method="post">
    <input type="submit" name="action" value="Complete Order">
</form>
</main>
<aside>
<img src="images/veggie.jpg" id="veggie" alt="veggie">
<img src="images/beef.jpg" id="beef" alt="beef">

</aside>
</div>
</body>
</html>
