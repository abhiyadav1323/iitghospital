<?php

$name_of_medicine = $_REQUEST["medname"];
$quantity_of_medicine = $_REQUEST["quantity"];
//check if it is valid and echo appropriate response 
echo $name_of_medicine . "<br>" . $quantity_of_medicine;
?>