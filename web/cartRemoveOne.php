<?php
session_start();
include ('connection.php');

$userid = $_SESSION['userid'];
$rowid = $_POST['prodid2'];
$quantity = $_POST['removeQuantity'];

$removeOne = "UPDATE cart SET quantity = quantity-1 WHERE customer_id = '$userid' AND product_id = '$rowid'";
$deleteItem = "DELETE FROM cart WHERE customer_id = '$userid' AND product_id = '$rowid'";

mysqli_query($link, $removeOne);
$quantity = $quantity-1;
if ($quantity == 0){
	mysqli_query($link, $deleteItem);
}


header('location:cart.php');
?>