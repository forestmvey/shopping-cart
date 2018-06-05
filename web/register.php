<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="default.css">
    <meta charset="utf-8">

    <title>Blurry Photos 4 You!</title>
    <style type="text/css"></style>
</head>

<body>
    <header>
        Blurry Photos 4 You!
    </header>
    <div>
    <nav>
        <ul>
            <li><a href="index.php" title="Main page" class="viewing">Main</a></li>
            <li><a href="photos.php" title="Photos">Photos</a></li>
            <li><a href="cart.php" title="Cart">View Cart</a></li>
            <li><a href="login_register.php" title="LoginRegister">Login/Register</a></li>
			<li><a href="myaccount.php" id="myaccount" style="visibility:hidden;" title="MyAccount">My Account</a></li>
			<li><a href="logout.php" id="logout" style="visibility:hidden;" title="Logout">Logout</a></li>
            <li><a href="addproduct.php" id="addprod" style="visibility:hidden;" title="AddProduct">Add Product</a></li>
        </ul>
    </nav>
    </div>
    <article>
        <h1> Welcome to Blurry Photos 4 You! </h1>
        <p class="paragraph">We provide the best blurry photos the market can provide. Ranging from scenic to industrial, we can guarantee that you can find a photo you will want to hang up in your home.</p>
        <br>

    </article>
<?php
ini_set('display_errors',1);
session_start();

$_password = $_POST['registerpassword'];
$_email = $_POST['registeremail'];
$_name = $_POST['name'];
$_address = $_POST['address'];
$hashpass = sha1($_password);

//connection
include('connection.php');

//insert customer registration
$insert = "INSERT INTO customer (name, password, email, address) 
values('$_name', '$hashpass', '$_email', '$_address')";

//validate email already not taken
$emailcheck = "SELECT email FROM customer WHERE email = '$_email'";
$check = mysqli_query($link, $emailcheck);


if(mysqli_num_rows($check) > 0){
    echo 'This email is already taken';
}elseif(mysqli_query($link, $insert)) {
    echo 'account successfully created!';
	echo "<form action = 'login_register.php'>";
	echo "<td style='width:60%'>" . "<input type='submit' value='Click here to login'>" . "</td>";
	echo "</form>";
}else{
    echo 'invalid account info';
}

/*
// checks if user has add to cart session variables set
if (isset($_SESSION['savedQuantity'])){

	// variables from photos.php
	$userid= $_SESSION['userid'];
	$rowid = $_SESSION['savedProduct'];
	$value = $_SESSION['savedQuantity'];

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
		echo "Your product was added to cart!";
	}
	//unset variables
	unset($_SESSION['savedProduct']);
	unset($_SESSION['savedQuantity']);
}
*/

if(isset($_SESSION['adminprivilege'])){
	// This checks if the admin is logged in and allows them to 
    // add products to the database on when the admin is logged in
    // and is disabled when the admin is logged out
        echo "<script>";
        echo "document.getElementById('addprod').style.visibility = 'visible';";
        echo "</script>";
   
}
if(isset($_SESSION['userid'])){
	echo "<script>";
	echo "document.getElementById('logout').style.visibility = 'visible';";
	echo "document.getElementById('myaccount').style.visibility = 'visible';";
	echo "</script>";
	}



?>
    <footer class="footer">Copyright &copy;2018</footer>

</body>

</html>