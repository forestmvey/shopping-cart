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
    // if (isset($_SESSION['user'])) {
    //     echo "logged in";
    //     echo $_SESSION['user'];
    //     echo $_SESSION['userid'];
?>
    <header>
        Blurry Photos 4 You!
    </header>
    <div>
    <nav>
        <ul>
            <li><a href="index.php" title="Main page">Main</a></li>
            <li><a href="photos.php" title="Photos">Photos</a></li>
            <li><a href="cart.php" title="Cart" class="viewing">View Cart</a></li>
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
        <?php
        include ('connection.php');
        // show all products
        $userID = $_SESSION['userid'];
        // echo $userID;
        $result = mysqli_query($link," select p.name, p.image, p.size, c.quantity, p.price, p.id
             from product p, cart c, customer cu
             where cu.id = c.customer_id
             and c.product_id = p.id
             and cu.id = '$userID'");
             if ($result)   {
                 $row_count = mysqli_num_rows($result);
                // print 'Retreived '. $row_count . ' rows from the <b> product </b> table<BR><BR>';
				 //checkout button here
				 if ($row_count != 0){
				 echo "<form action='deleteAllItems.php'>";
				 echo "<input type='submit' value='Delete all items from cart'>";
				 echo "</form>";
				 } else {
				 echo "Your cart is empty!";
                 }
                 if ($row_count >= 1) {
                    echo "<table border='1' style='width:50%'>
                    <tr>
                    <th style='width:50%'>Name</th>
                    <th style='width:50%'>Photo</th>
                    <th style='width:50%'>Size</th>
                    <th style='width:50%'>Quantity</th>
                    <th style='width:50%'>Price</th>
                    <th style='width:50%'>Tax</th>
                    <th style='width:50%'>Sub-total</th>
                    <th style='width:50%'>+1 Product</th>
                    <th style='width:50%'>-1 Product</th>
                    <th style='width:50%'>Remove Product</th>
                    </tr>";
                 }
                 while ($row = mysqli_fetch_array($result)) {
					 
		             $img = $row['image'];
                     $nm = $row['name'];
					 $tax = (($row['quantity']*$row['price'])*.1);
					 $subTotal = (($row['price']*$row['quantity'])+$tax);
					 $rowQuantity = $row['quantity'];
					 $total += $subTotal;
					 $totalTax += $tax;
                     echo "<tr>";
                     echo "<td align='center'>" . $row['name'] . "</td>";
                     echo "<td align='center'>" . "<img src ='$img' alt='$nm' width='200' height='100'>" . "</td>";
                     echo "<td align='center'>" . $row['size'] . "</td>";
					 echo "<td align='center'>" . $row['quantity'] . "</td>";
					 echo "<td align='center'>" . "$" . $row['price'] . "</td>";
					 echo "<td align='center'>" . "$" . number_format($tax, 2) . "</td>";
					 echo "<td align='center'>" . "$" . number_format($subTotal, 2) . "</td>";
					 echo "<form action='cartAddOne.php' method='POST'>";
					 echo "<td align='center'>" . "<input type='image' src='http://icongal.com/gallery/image/268146/add_button_new_edit_car_plus_green_equal.png' alt='Submit' width='40' height='40'>" . "</td>";
					 ?>
					 <input type='hidden' name='prodid2' value="<?php echo $row['id'];?>"/>
					 <?php
					 echo "</form>";
					 echo "<form action='cartRemoveOne.php' method = 'POST'>";
					 echo "<td align='center'>" . "<input type='image' src='http://www.sciencekids.co.nz/images/pictures/math/minussymbol.jpg' alt='Submit' width='48' height='48'>" . "</td>";
					 ?>
					 <input type='hidden' name='prodid2' value="<?php echo $row['id'];?>"/>
					 <input type='hidden' name='removeQuantity' value="<?php echo $row['quantity'];?>"/>
					 <?php
					 echo "</form>";					 
					 echo "<form action='cartRemoveItem.php' method = 'POST'>";
					 echo "<td align='center'>" . "<input type='image' src='http://www.clker.com/cliparts/D/2/b/U/X/Q/remove-all-button-png-hi.png' alt='submit' width='76' height='40'>" . "</td>";
					 ?>
					 <input type='hidden' name='prodid2' value="<?php echo $row['id'];?>"/>
					 <?php
					 echo "</form>";					 
                }
				echo "<table border='1'>
				<tr>
				<th style='width:50%'>Total Tax</th>
				</tr>
				<td align='center'>$" . number_format($totalTax, 2) . "</td>
				<tr>
				<th style='width:50%'>Total</th>
				</tr>
				<td align='center' style='width:60%'>$" . number_format($total, 2) . "</td>
				</table>";
				echo "<input type='image' src='https://t3.ftcdn.net/jpg/00/30/30/64/240_F_30306492_54Fq37acp3NBQHlfSkQ1WQrpBS2yyOyt.jpg' alt='Checkout' height='48' width='96'>";
            } 
			?>
    </article>
    </body>

	 

    </article>

	
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
</body>

</html>