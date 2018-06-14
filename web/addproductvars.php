<html>
<head>
<title>Retrieve Variables Test </title>
</head>
<body>
<?php
ini_set('display_errors',1);
session_start();
$price = $_POST['price'];
$dimensions = $_POST['dimensions'];
$photo = $_POST['photo'];
$name = $_POST['name'];


include('connection.php');
//CREATE QUERY

$insert1 = "INSERT INTO product (name, size, image, price) 
values('$name', '$dimensions', '$photo', '$price')";


// Check the result
if (mysqli_query($link, $insert1)) {
	$last_id = mysqli_insert_id($link);
	if(!empty($_POST['catlist'])){
		foreach($_POST['catlist'] as $cat){
			$insert2 = "INSERT INTO productcategory (product_id, category_id) 
			values('$last_id','$cat')";
			mysqli_query($link, $insert2);
		}
	}
	echo "alert('Insert successful');";
	echo "<script>
	window.location="addproduct.php";
	</script>";
}else { //not a match
	echo "Error" . $insert1 . "<br>" . mysqli_error($insert1) . mysqli_error($insert2);
}


?>
<br><a href="index.php">Return to main page</a>
</body>
</html>
