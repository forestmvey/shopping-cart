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
            <li><a href="index.php" title="Main page" class="viewing">Main</a></li>
            <li><a href="photos.php" title="Photos">Photos</a></li>
            <li><a href="cart.php" title="Cart">View Cart</a></li>
            <li><a href="login_register.php" title="LoginRegister">Login/Register</a></li>
            <li><a href="myaccount.php" title="MyAccount">My Account</a></li>
            <li><a href="logout.php" title="Logout">Logout</a></li>
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
//post password (hashed) and email
$password = $_POST['password'];
$email = $_POST['email'];
$hashpass = sha1($password);

include('connection.php');
//check whether email/password combo matches
$passwordcheck = "SELECT password FROM customer WHERE email = '$email'";

//get user ID
$getid = "Select id from customer where email = '$email'";

//check if they have accepted the user policy
$policy = "Select policy from customer where email = '$email'";

// check if the user is an admin
$admin= "Select admin from customer where email = '$email'";

//update privacy policy acceptance
$policyupdate = "UPDATE customer SET policy = '$accept' where email = '$email'";

$check = mysqli_query($link, $passwordcheck);
$row = mysqli_fetch_array($check);
$pwstring = $row['password'];
//get userID from database
$id = mysqli_query($link, $getid);
$userid = mysqli_fetch_array($id);
//Check policy acceptance from database
$check2 = mysqli_query($link, $policy);
$policycheck = mysqli_fetch_array($check2);
//Check if admin
$check3 = mysqli_query($link, $admin)
$admincheck = mysqli_fetch_array($check3);



if (isset($_SESSION['acceptpolicy'])){
		$accept = $_SESSION['acceptpolicy'];
		if ($accept == 1){
			//update privacy policy setting
			$set1 = mysqli_query($link, $policyupdate);
			echo "Please login to confirm you;ve read the privacy policy";
		}
		elseif($accept == 0){
			//update privacy policy setting
			$set1 = mysqli_query($link, $policyupdate);
			echo "You must accept the privacy policy before logging in";
			//redirect to policy.php
		}
}
if($pwstring == $hashpass){
	if ($admincheck['admin'] == 1){
		if ($policycheck['policy'] == 1){
			$_SESSION['user'] = $_POST['email'];
			$_SESSION['userid'] = $userid['id'];
			//set admin privileges to true to add products etc.
			$_SESSION['adminprivilege'] = true;
			//set login time
		echo 'login successful!';
		}  elseif ($policycheck['policy'] == 2) {
			// alert then redirect go policy.php 
			
		}
	}elseif($admincheck['admin'] == 0) {
		if ($policycheck['policy'] == 1){
			echo 'login successful!';
			$_SESSION['user'] = $_POST['email'];
			$_SESSION['userid'] = $userid['id'];
			// set login time 
		} elseif ($policycheck['policy'] == 2 {
			// alert then redirect go policy.php 
		}
			
	}
}
else{
	echo 'invalid password';
}





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
		echo "<br>" . "Added product to cart!";
		mysqli_query($link, $insertNew);
	} else if ($rowcount != 0){
		echo "<br>" . "Updated existing product quantity!";
		mysqli_query($link, $insertExisting);
	} else {
		echo "Error" . $insertExisting . "<br>" . mysqli_error($insertExisting) . "<br>" . $insertNew . "<br>" . mysqli_error($insertNew);
	}
	}
	
	//unset variables
	unset($_SESSION['savedProduct']);
	unset($_SESSION['savedQuantity']);
}


?>

    <footer class="footer">Copyright &copy;2018</footer>
<?php
	// This checks if the admin is logged in and allows them to 
    // add products to the database on when the admin is logged in
    // and is disabled when the admin is logged out
    if(isset($_SESSION['adminprivilege'])){
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
</body>

</html>