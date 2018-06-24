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
			<li><a href="addproduct.php" id="addprod" style="visibility:hidden;" title="AddProduct" class="viewing">Add Product</a></li>
        </ul>
	</nav>

    </div>
	<br>

<?php
include('connection.php');

//find all categories
$cats = mysqli_query($link, "SELECT DISTINCT * FROM category order by id");
$dimensions = mysqli_query($link, "SELECT DISTINCT UPPER(size) FROM product ORDER BY UPPER(size) ASC");
	echo "<link rel='stylesheet' href='addproduct.css'>";
	echo "<link rel='stylesheet' href='default.css'>";
	echo "<div class='form divContainer'>";
	echo "<form action='addproductvars.php' method='POST' onsubmit='return validation();'>";
	echo "<label><strong> Upload Photo URL: </strong><input type='text' name='photo' id='photo'/></label>";
	echo "<label><strong> Photo name: </strong><input type='text' name='name' id='name'/></label>";
	echo "<label><strong> Price: </strong><input type='text' pattern='[0-9]+(\.[0-9][0-9]?)?' title='Numbers Only' name='price' id='price'/></label>";
	echo "<br>" . "<br>";
	echo "<label><strong> Dimensions: </strong><select name='dimensions' id='dimensions'></label>";
	while($row = mysqli_fetch_array($dimensions)){
		$size = $row['UPPER(size)'];
		echo "<option value='$size'>" . $size . "</option>";
	}
	echo "</select>";
	echo "<br>" . "<br>";
	//print all categories as checkboxes
	echo "<label><strong> Category: </strong></label>";
	echo "<br>" . "<br>";
	while($row = mysqli_fetch_array($cats)){
		$cat = $row['name'];
		$id = $row['id'];
		echo "<input type='checkbox' name='catlist[]' value='$id'>" . $cat . "<br>";
	}
	echo "<input type='submit' value='Submit'/>";
	echo "</form>";
	echo "</div>";
	//adding a new category
	echo "<div class='form divContainer'>";
	echo "<form action='addcategory.php' method='POST'>";
	echo "<label><strong> Add a new category: </strong><input type='text' pattern='.*' name='newcategory' id='newcategory'/></label>";
	echo "<input type='submit' value='Submit'/>";
	echo "</form>";
	echo "</div>";
	//edit price of product
	?>
	<?php
	
	echo "<p><strong> Change Price: </strong></p>";
	echo "<table align='center' border='5px solid' style='width:100%' bordercolor='#313C53'>
	<tr>
	
	<th style='width:60%'>Name</th>
	<th style='width:60%'>Size</th>
	<th style='width:60%'>Photo</th>
	<th style='width:60%'>Original Price</th>
	<th style='width:60%'>Change Price</th>";
	$result = mysqli_query($link,'select * from product order by id');
    if ($result)   { 
        $row_count = mysqli_num_rows($result);

        while ($row = mysqli_fetch_array($result)) {
        
                $img = $row['image'];
                $nm = $row['name'];
				$price = $row['price'];
                echo "<link rel='stylesheet' href='buttons.css'>";
                echo "<tr>";
				
                echo "<td style='width:60%'>" . $row['name'] . "</td>";
                echo "<td style='width:60%'>" . $row['size'] . "</td>";
                echo "<td style='width:60%'>" . "<img src ='$img' alt='$nm' width='200' height='100'>" . "</td>";
				echo "<td style='width:60%'>" . $row['price'] . "</td>";
				echo "<form action='changeprice.php' method='POST' onsubmit='return validation2();'>";
				echo "<td style='width:60%'>" 
					. "<input type='text' pattern='[0-9]+(\.[0-9][0-9]?)?' title='Numbers Only' name='changeprice' id='changeprice' value='$price'/>" 
					. "<input type='submit' value='Change Price' class='okButton'>" 
					. "</td>";
				?>
				<input type='hidden' name='id' value="<?php echo $row['id']?>"/>
				<?php echo "</form>";
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
	
	if(document.getElementById('name').value == ''){
		alert("You must include a photoname");
		return false;
	}
}
function validation2(){
	if(document.getElementById('changeprice').value == ''){
		alert("You must include a valid product price");
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