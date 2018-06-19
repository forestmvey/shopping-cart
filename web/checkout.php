
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
            <li><a href="photos.php" title="Photos">Photos</a></li>
            <li><a href="cart.php" title="Cart">View Cart</a></li>
            <li><a href="login_register.php" title="LoginRegister">Login/Register</a></li>
            <li><a href="myaccount.php" title="MyAccount" id="myaccount" style="visibility:hidden;">My Account</a></li>
            <li><a href="logout.php" title="Logout" id="logout" style="visibility:hidden;">Logout</a></li>
            <li><a href="addproduct.php" id="addprod" style="visibility:hidden;" title="AddProduct">Add Product</a></li>
        </ul>
    </nav>
    </div>
    <article>
        <?php require_once('./config.php'); ?>
        
        <form action="charge.php" method="post">
        <input type="checkbox" id="billaddr" name="billaddr" onClick="billAddrFunction();"> Billing address different than shipping address. <br>
        <input type='text' id='billingaddress' pattern="[\sa-zA-Z0-9]{4,20}" name="billingaddress" style="visibility:hidden;">
        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="<?php echo $stripe['publishable_key']; ?>"
                data-description="Payment Form"
                data-amount="<?php echo $total*100; ?>"
                data-locale="auto"></script>
                <input type="hidden" name="totalamt" value="<?php echo $total*100; ?>" />
        </form>
        
        <script>
        function billAddrFunction() {
            if(document.getElementById('billaddr').checked){
                document.getElementById('billingaddress').style.visibility = 'visible';
            }else{
                document.getElementById('billingaddress').style.visibility = 'hidden';
            }
        }
        </script>
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