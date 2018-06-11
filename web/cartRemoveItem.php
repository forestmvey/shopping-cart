<?php
session_start();
include ('connection.php');

$userid = $_SESSION['userid'];
$rowid = $_POST['prodid2'];

$deleteItem = "DELETE FROM cart WHERE customer_id = '$userid' AND product_id = '$rowid'";

mysqli_query($link, $deleteItem);


header('location:cart.php');
?>