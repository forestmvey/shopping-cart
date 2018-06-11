<?php
session_start();
include ('connection.php');

$userid = $_SESSION['userid'];
$rowid = $_POST['prodid2'];

$addOne = "UPDATE cart SET quantity = quantity+1 WHERE customer_id = '$userid' AND product_id = '$rowid'";

mysqli_query($link, $addOne);
header('location:cart.php');
?>