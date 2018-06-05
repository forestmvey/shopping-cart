<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="default.css">
    <meta charset="utf-8">

    <title>Blurry Photos 4 You!</title>
    <style type="text/css"></style>
</head>

<body>
<?php
    session_start();
?>
    <header>
        Blurry Photos 4 You!
    </header>
    <div>
    <nav>
        <ul>
            <li><a href="index.php" title="Main page">Main</a></li>
            <li><a href="photos.php" title="Photos" class="viewing">Photos</a></li>
            <li><a href="cart.php" title="Cart">View Cart</a></li>
			<li><a href="login_register.php" title="LoginRegister">Login/Register</a></li>
			<li><a href="myaccount.php" id="myaccount" style="visibility:hidden;" title="MyAccount">My Account</a></li>
			<li><a href="logout.php" id="logout" style="visibility:hidden;" title="Logout">Logout</a></li>
            <li><a href="addproduct.php" id="addprod" style="visibility:hidden;" title="AddProduct">Add Product</a></li>
        </ul>
    </nav>
    </div>
    <article>



<?php
session_start();
include ('connection.php');

// variables from photos.php
$userid= $_SESSION['userid'];
$rowid = $_POST['prodid'];
$value = $_POST['quantity'];

// select quantity of chosen item from current users cart
$prodQuantity = "SELECT quantity FROM cart WHERE product_id = '$rowid' AND customer_id = '$userid'";
// run query
$result2 = mysqli_query($link, $prodQuantity);
// retrieve result as array
$prodQuantityInt = mysqli_fetch_assoc($result2);
// select quantity from array as int and add it to value from add to cart button
$combinedQuantity = $prodQuantityInt['quantity'] + $value;
// update cart quantity with existing item
$insertExisting = "UPDATE cart SET quantity = '$combinedQuantity' WHERE customer_id = '$userid' AND product_id = '$rowid'";
// insert new item and quantity to cart
$insertNew = "INSERT INTO cart (customer_id, product_id, quantity) VALUES ('$userid', '$rowid', '$value')";

// check if item exists in cart, then either add a new item or update an existing one
if (isset($userid)){
if ($result=mysqli_query($link,$prodQuantity)){
	$rowcount=mysqli_num_rows($result);
	if ($rowcount == 0){
		echo "Added product to cart!";
		mysqli_query($link, $insertNew);
	} else if ($rowcount != 0){
		echo "Updated existing product quantity!";
		mysqli_query($link, $insertExisting);
	} else {
		echo "Error" . $insertExisting . "<br>" . mysqli_error($insertExisting) . "<br>" . $insertNew . "<br>" . mysqli_error($insertNew);
	}
}
echo "<form action = 'photos.php'>";
echo "<td style='width:60%'>" . "<input type='submit' value='Return to homepage'>" . "</td>";
echo "</form>";
echo "<form action = 'cart.php'>";
echo "<td style='width:60%'>" . "<input type='submit' value='View cart'>" . "</td>";
echo "</form>";
} else {
	$_SESSION['savedQuantity'] = $value;
	$_SESSION['savedProduct'] = $rowid;
	echo "Please log in or register to add this item to your cart.";
	echo "<form action = 'login_register.php'>";
	echo "<td style='width:60%'>" . "<input type='submit' value='Login/Register'>" . "</td>";
	echo "</form>";
}
?>





<?php
    if(isset($_SESSION['adminprivilege'])){
        echo "<script>";
        echo "document.getElementById('addprod').style.visibility = 'visible';";
        echo "</script>";
   
    }
	if(isset($_SESSION['user'])){
	echo "<script>";
	echo "document.getElementById('logout').style.visibility = 'visible';";
	echo "document.getElementById('myaccount').style.visibility = 'visible';";
	echo "</script>";
	}

?>
</article>
</body>
</html>


