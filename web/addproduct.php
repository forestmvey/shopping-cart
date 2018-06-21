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
			<li><a href="myaccount.php" title="MyAccount" id="myaccount" style="visibility:hidden;">My Account</a></li>
            <li><a href="logout.php" title="Logout" id="logout" style="visibility:hidden;">Logout</a></li>
            <li><a href="orderhistory.php" id="orderhistory" style="visibility:hidden;" title="OrderHistory">Order History</a></li>
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
include('connection.php');

//find all categories
$cats = mysqli_query($link, "SELECT DISTINCT * FROM category");
$dimensions = mysqli_query($link, "SELECT DISTINCT UPPER(size) FROM product ORDER BY UPPER(size) ASC");

	echo "<form action='addproductvars.php' method='POST' onsubmit='return validation();'>";
	echo "<p> Upload Photo URL: <input type='text' name='photo' id='photo'/></p>";
	echo "<p> Photo name: <input type='text' name='name' id='name'/></p>";
	echo "<p> Price: <input type='text' pattern='[0-9]+(\.[0-9][0-9]?)?' title='Numbers Only' name='price' id='price'/></p>";

	echo "<p> Dimensions: </p><select name='dimensions' id='dimensions'></p>";
	while($row = mysqli_fetch_array($dimensions)){
		$size = $row['UPPER(size)'];
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

	//edit price of product
	//echo "<p> Edit Product prices</p>":
	echo "<p> Change Price </p></p>";
	echo "<table align='center' border='5px solid' style='width:100%' bordercolor='#313C53'>
	<tr>
	
	<th style='width:60%'>Name</th>
	<th style='width:60%'>Size</th>
	<th style='width:60%'>Photo</th>
	<th style='width:60%'>Original Price</th>
	<th style='width:60%'>Change Price</th>";
	$result = mysqli_query($link,'select * from product');
    if ($result)   {
        $row_count = mysqli_num_rows($result);

        while ($row = mysqli_fetch_array($result)) {
        
                $img = $row['image'];
                $nm = $row['name'];
				$price = $row['price'];
                echo "<link rel='stylesheet' href='buttons.css'>";
                echo "<tr>";
				//echo "<td style='width:60%'>" . $row['id'] . "</td>";
                echo "<td style='width:60%'>" . $row['name'] . "</td>";
                echo "<td style='width:60%'>" . $row['size'] . "</td>";
                echo "<td style='width:60%'>" . "<img src ='$img' alt='$nm' width='200' height='100'>" . "</td>";
				echo "<td style='width:60%'>" . $row['price'] . "</td>";
				echo "<form action='changeprice.php' method='POST' onsubmit='return validation();'>";
                echo "<td style='width:60%'>" . "<input type='text' pattern='[0-9]+(\.[0-9][0-9]?)?' title='Numbers Only' name='changeprice' id='changeprice' value='$price'/>" . "</td>";
                echo "<td style='width:60%'>" . "<input type='submit' value='Change Price' class='okButton'>" . "</td>";
				echo "</form>";
        }
	}
	
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
	if(document.getElementById('changeprice').value == ''){
		alert("You must include a valid product price");
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
		echo "<script>";
		echo "document.getElementById('myaccount').style.visibility = 'visible';";
		echo "</script>";
   
    }
    if(isset($_SESSION['user'])){
	//displays logout and my account only when user is signed in
		echo "<script>";
        echo "document.getElementById('logout').style.visibility = 'visible';";
		echo "document.getElementById('myaccount').style.visibility = 'visible';";
		echo "document.getElementById('orderhistory').style.visibility = 'visible';";
        echo "</script>";
	}

?>

</body>
</html>