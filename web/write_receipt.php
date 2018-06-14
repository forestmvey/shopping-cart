<?php 
session_start();
include ('connection.php');

date_default_timezone_set("America/Vancouver");
$userid= $_SESSION['userid'];
$user= $_SESSION['user'];
$date = date("Y-m-d");
$time = date("h:i:sa");
$title = $userid . "_" . $user . "_" . $date . "_" . $time;


$receiptInfo = "SELECT * FROM cart c, product p WHERE p.id = c.product_id AND c.customer_id = '$userid'";
$receiptQuery = mysqli_query($link, $receiptInfo);

$myfile = fopen("/home/student/cst127/Receipts/$title.txt", "w");

while($row = mysqli_fetch_array($receiptQuery)){
	$receiptProductId = $row['product_id'];
	$receiptQuantity = $row['quantity'];
	$receiptProduct = $row['name'];
	$tax = (($row['quantity']*$row['price'])*.1);
	$subTotal = (($row['price']*$row['quantity'])+$tax);
	$total += $subTotal;
	$totalTax += $tax;
	
	$receiptText = "Product: " . $receiptProduct . ", Product ID: " . $receiptProductId .", Quantity: " . $receiptQuantity . ", Subtotal: $" . number_format($subTotal, 2) . "\n";
	fwrite($myfile, $receiptText);

}
$totalTaxText = "Total tax: $" . number_format($totalTax, 2) . "\n";
$totalText = "Total: $" . number_format($total, 2);
fwrite($myfile, $totalTaxText);
fwrite($myfile, $totalText);
fclose($myfile);

/*
$myfile = fopen("/home/student/cst127/Receipts/$title.txt", "w");
fclose($myfile);
*/
?>