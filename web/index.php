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
        <?php
        include ('connection.php');
        $rand = rand(1, 9);
        $result = mysqli_query($link,"select * from product where id='$rand'");
        if ($result)   {
            $row_count = mysqli_num_rows($result);
            while ($row = mysqli_fetch_array($result)) {
                $img = $row['image'];
                echo "<strong>Featured Photo</strong>";
                echo "<br>";
                echo "<img src ='$img' alt='$nm' width='1000' height='500'>";
            }
        } 

        ?>
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
        echo "document.getElementById('orderhistory').style.visibility = 'visible';";
        echo "</script>";
	}

?>

</body>

</html>