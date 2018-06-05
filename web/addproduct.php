<?php 
session_start();
if(!isset($_SESSION['adminprivilege'])){
    header('location:index.php');
}
?>

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
            <li><a href="index.php" title="Main page">Main</a></li>
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
include('mysqli_connect.php');

//find all categories
$cats = mysqli_query($dbc, "SELECT * FROM category");
$dimensions = mysqli_query($dbc, "SELECT size FROM product");

	echo "<form action='addproductvars.php' method='POST' onsubmit='return validation();'>";
	echo "<p> Upload Photo URL: <input type='text' name='photo' id='photo'/></p>";
	echo "<p> Photo name: <input type='text' name='name' id='name'/></p>";
	echo "<p> Price: <input type='text' pattern='[0-9]+(\.[0-9][0-9]?)?' title='Numbers Only' name='price' id='price'/></p>";

	echo "<p> Dimensions: </p><select name='dimensions' id='dimensions'></p>";
	while($row = mysqli_fetch_array($dimensions)){
		$size = $row['size'];
		echo "<option value='$size'>" . $size . "</option>";
	}
	echo "</select>";

	//print all categories as checkboxes
	echo "<p> Category: </p></p>";
	while($row = mysqli_fetch_array($cats)){
		$cat = $row['name'];
		$id = $row['id'];
		echo "<input type='checkbox' name='catlist[]' value='$id'>" . $cat . "<br>";
	}
	echo "<br>" . "<br>";
	echo "<input type='submit' value='SUBMIT'  />";
	echo "</form>";
	
	//adding a new category
	echo "<form action='addcategory.php' method='POST'>";
	echo "<p> Add a new category: <input type='text' pattern='.*' name='newcategory' id='newcategory'/></p>"; 
	echo "<input type='submit' value='SUBMIT'  />";
	echo "</form>";

?>
<script>
function validation() {
// VALIDATION CODE HERE!
	if(document.getElementById('photo').value == ''){
		alert("You must include a photo");
		return false;
	}
	if(document.getElementById('price').value == ''){
		alert("You must include a product price");
		return false;
	}
	if(document.getElementById('name').value == ''){
		alert("You must include a photoname");
		return false;
	}
}


</script>
<?php
	// This checks if the admin is logged in and allows them to 
    // add products to the database on when the admin is logged in
    // and is disabled when the admin is logged out
    if(isset($_SESSION['adminprivilege'])){
        echo "<script>";
        echo "document.getElementById('addprod').style.visibility = 'visible';";
        echo "</script>";
   
    }
	if(isset($_SESSION['user'])){
	//displays logout and my account only when user is signed in
		echo "<script>";
        echo "document.getElementById('logout').style.visibility = 'visible';";
		echo "document.getElementById('myaccount').style.visibility = 'visible';";
        echo "</script>";
	}

?>
<footer class="footer">Copyright &copy;2018</footer>
</body>
</html>