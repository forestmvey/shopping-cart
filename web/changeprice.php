<html>
<head>
<title>Change Price </title>
</head>
<body>
<?php
ini_set('display_errors',1);
session_start();
$price = $_POST['changeprice'];
$productid = $_POST['id'];

include('connection.php');

//

$update = "update product set price='$price' where id = '$productid'";

if (mysqli_query($link, $update)) {
	echo $update;
}else { //not a match
	echo "Error" . $update . "<br>" . mysqli_error($update);
}
header('location: addproduct.php');
?>
</body>
</html>