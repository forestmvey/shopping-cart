<html>
<head>
<title>Retrieve Variables Test </title>
</head>
<body>
<?php
ini_set('display_errors',1);
session_start();
$price = $_POST['price'];
$category = $_POST['category'];
$dimensions = $_POST['dimensions'];
$photo = $_POST['photo'];
$name = $_POST['name'];


//echo "$price $category $dimensions $photo $photoname";
// connect to database

include('mysqli_connect.php');
//CREATE QUERY

$insert1 = "INSERT INTO product (name, size, image, price) 
values('$name', '$dimensions', '$photo', '$price')";

// run the query???
//$row = @mysqli_query ($dbc, $insert)
// Check the result
if (mysqli_query($dbc, $insert1)) {
	$last_id = mysqli_insert_id($dbc);
	$insert2 = "INSERT INTO productcategory (product_id, category_id) 
	values('$last_id','$category')";
	mysqli_query($dbc, $insert2);
	echo "Insert successful";
}else { //not a match
	echo "Error" . $insert1 . "<br>" . mysqli_error($insert1) . mysqli_error($insert2);
}


?>
<br><a href="index.php">Return to main page</a>
</body>
