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
    //Check if user has accepted privacy policy
    include ('connection.php');
    $useremail = $_SESSION['user'];
    $policy = "Select policy from customer where email = '$useremail'";
    $check2 = mysqli_query($link, $policy);
    $policy2 = mysqli_fetch_array($check2);
    $policycheck = $policy2['policy'];

    if($policycheck != 1 && isset($_SESSION['user'])){ // if user has not accepted our policies, they will be redirected to the policy page

        echo "<script>;
        alert('You must accept our policy agreement in order to use the cart!');
        window.location='policy.php';
        </script>";
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
            <li><a href="cart.php" title="Cart" class="viewing">View Cart</a></li>
            <li><a href="login_register.php" title="LoginRegister">Login/Register</a></li>
            <li><a href="myaccount.php" id="myaccount" style="visibility:hidden;" title="MyAccount">My Account</a></li>
			<li><a href="logout.php" id="logout" style="visibility:hidden;" title="Logout">Logout</a></li>
            <li><a href="addproduct.php" id="addprod" style="visibility:hidden;" title="AddProduct">Add Product</a></li>
        </ul>
    </nav>
    </div>
    <article>
        
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
                 echo "<br>";
				 echo "</form>";
				 } else {
				 echo "Your cart is empty!";
                 }
                 if ($row_count >= 1) {
                    echo "<br>";
                    echo "<table border='5px solid' style='width:50%' bordercolor='#313C53'>
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
					 $tax = number_format($tax, 2, ',','');
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
				echo "<table border='5px solid' bordercolor='#313C53'>
				<tr>
				<th style='width:50%'>Total Tax</th>
				</tr>
				<td align='center'>$" . number_format($totalTax, 2) . "</td>
				<tr>
				<th style='width:50%'>Total</th>
				</tr>
				<td align='center' style='width:60%'>$" . number_format($total, 2) . "</td>
				</table>";
            } 
			?>
            <?php require_once('./config.php'); ?>

            <form action="charge.php" method="post" obSubmit="JavaScript:addrExpr()">
            <input type="checkbox" id="billaddr" name="billaddr" onClick="billAddrFunction();"> Billing address different than shipping address. <br>
            <input type='text' id='billingaddress' pattern="[\sa-zA-Z0-9]{4,20}" name="billingaddress" style="visibility:hidden;">
            
            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="<?php echo $stripe['publishable_key']; ?>"
                    data-description="Payment Form"
                    data-amount="<?php echo $total*100; ?>"
                    data-locale="auto"></script>
                    <input type="hidden" name="totalamt" value="<?php echo $total*100; ?>" />
            </form>
    </article>
    </body>

    </article>
<script>

function billAddrFunction() {
    if(document.getElementById('billaddr').checked){
        document.getElementById('billingaddress').style.visibility = 'visible';
    }else{
        document.getElementById('billingaddress').style.visibility = 'hidden';
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
</body>

</html>
