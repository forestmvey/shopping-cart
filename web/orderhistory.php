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
    ini_set('display_errors',1);
	include('connection.php');
	if(isset($_POST['search'])){
		$search = $_POST['search'];
	}
?>
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
            <li><a href="orderhistory.php" id="orderhistory" style="visibility:hidden;" title="OrderHistory" class="viewing">Order History</a></li>
            <li><a href="addproduct.php" id="addprod" style="visibility:hidden;" title="AddProduct">Add Product</a></li>
        </ul>
    </nav>
    </div>

	<h2>Order History</h2>
	<form action="orderhistory.php" method="POST">
	<input type="text" title="search" id="search" name="search" value="<?php if(isset($_POST['search']) && $search != ''){ echo "$search";} ?>">
	<input type="submit" value="Search">
	</form>

    <?php
	// Display order history
	$userid = $_SESSION['userid'];

	$orderscheck = "SELECT order_id AS 'Order', quantity, price FROM orderhistory WHERE customer_id = '$userid'";
	$orders = mysqli_query($link, $orderscheck);


	echo "<form action='orderhistory.php' method='POST'>";
	while($row = mysqli_fetch_array($orders)){
		echo "<input type='submit' value='$row['order_id']'>";
	}
	echo "</form>";


	if(isset($_POST['search']) && $search != ''){
		$orderhist = "SELECT * from orderhistory where customer_id = '$userid' AND (SOUNDEX('$search') = SOUNDEX(product_name) OR product_name LIKE '%$search%') order by order_id AND product_name";
		$result =  mysqli_query($link, $orderhist);
		$row_count = mysqli_num_rows($result);
		// if nothing has been ordered yet, dont display anything!
		if ($row_count == 0){
			echo "<p>Nothing matches your search!</p>";
		
		}else{
			echo "<table align='center' border='5px solid' style='width:50%' bordercolor='#313C53'>
			<tr>
			<th style='width:20%'>Order #</th>
			<th style='width:20%'>Name</th>
			<th style='width:20%'>Blurry Photo</th>
			<th style='width:20%'>Quantity</th>
			<th style='width:20%'>Price</th>
			<th style='width:50%'>Billing Address</th>
			<th style='width:50%'>Shipping Address</th>
			<th style='width:20%'>Date of Purchase</th>
			<th style='width:20%'>Status</th>";
		
			while ($row = mysqli_fetch_array($result)){
			$img = $row['image'];
			echo "<tr>";
			echo "<td style='width:30%'>" . $row['order_id'] . "</td>";
			echo "<td style='width:30%'>" . $row['product_name'] . "</td>";
			echo "<td style='width:30%'>" . "<img src ='$img' alt '$img' width='200' height='100'>" . "</td>";
			echo "<td style='width:30%'>" . $row['quantity'] . "</td>";
			echo "<td style='width:30%'>" . $row['price'] . "</td>";
			echo "<td style='width:50%'>" . $row['bill_address'] . "</td>";
			echo "<td style='width:50%'>" . $row['mail_address'] . "</td>";
			echo "<td style='width:30%'>" . $row['date'] . "</td>";
			echo "<td style='width:30%'>" . $row['status'] . "</td>";
		}
		}
	}else{
	
	$orderhist = "SELECT * from orderhistory where customer_id = '$userid' order by order_id AND product_name";
	$result =  mysqli_query($link, $orderhist);
	$row_count = mysqli_num_rows($result);
	// if nothing has been ordered yet, dont display anything!
	if ($row_count == 0){
		echo "<p>Nothing ordered yet!</p>";
	
	}else{
		echo "<table align='center' border='5px solid' style='width:50%' bordercolor='#313C53'>
		<tr>
		<th style='width:20%'>Order #</th>
		<th style='width:20%'>Blurry Photo</th>
		<th style='width:20%'>Quantity</th>
		<th style='width:20%'>Price</th>
		<th style='width:50%'>Billing Address</th>
		<th style='width:50%'>Shipping Address</th>
		<th style='width:20%'>Date of Purchase</th>
		<th style='width:20%'>Status</th>";
	
		while ($row = mysqli_fetch_array($result)){
		$img = $row['image'];
		echo "<tr>";
		echo "<td style='width:30%'>" . $row['order_id'] . "</td>";
		echo "<td style='width:30%'>" . "<img src ='$img' alt '$img' width='200' height='100'>" . "</td>";
		echo "<td style='width:30%'>" . $row['quantity'] . "</td>";
		echo "<td style='width:30%'>" . $row['price'] . "</td>";
		echo "<td style='width:50%'>" . $row['bill_address'] . "</td>";
		echo "<td style='width:50%'>" . $row['mail_address'] . "</td>";
		echo "<td style='width:30%'>" . $row['date'] . "</td>";
		echo "<td style='width:30%'>" . $row['status'] . "</td>";
    }
	}
}
    
		 

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
        echo "document.getElementById('orderhistory').style.visibility = 'visible';";
        echo "</script>";
	}

?>
         
</body>

</html>