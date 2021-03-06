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
if(isset($_POST['acceptpolicy'])){
    $_SESSION['policy'] = 1;
    include('mysqli_connect.php');
    $id = $_SESSION['userid'];
    $policyupdate = "UPDATE customer SET policy = '1' WHERE id = $id;";
    
    if(mysqli_query($link, $policyupdate)){
        echo "<script>
        alert('Thank you for accepting our privacy policy.');
        window.location='index.php';
        </script>";
        if (isset($_SESSION['savedQuantity'])){//if user added items to cart before accepting our policy!
            echo "<script>
            alert('Your item will now be added to your cart!');
            window.location='addToCart.php';
            </script>";
}
    }else{
        echo "<script>";
        echo "alert('error of accepting our privacy policy');";
        echo "</script>";
    }
} elseif(isset($_POST['declinedpolicy'])){
    session_destroy();
    echo "<script>
    alert('You have been logged out for not accepting our policy! Please accept in order to use our services');
    window.location='index.php';
    </script>";
}   

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
            <li><a href="addproduct.php" id="addprod" style="visibility:hidden;" title="AddProduct">Add Product</a></li>
        </ul>
    </nav>
    </div>
    <form action="policy.php" method="POST">
    <article>
        <h1> Welcome to Blurry Photos 4 You! </h1>
        <h2>This is our privacy agreement, you better accept it!</h2>
        <p class="paragraph">By accepting this privacy agreement you will be accepting
         any recourse given to you by Blur Corp. This includes but not limited to hot 
         coffee burns, data selling, outdated barney advertisements, stolen credit cards, 
         and stolen lunch. We take no responsibility for anything, ANYTHING AT ALL!. If you 
         don't like it don't accept. Though we won't let you log in so ACCEPT! And don't use
          this account for any creation or use of nucleur weapons. Unless you're making money, 
          then we want the money.</p>
        <br>

        <button name="acceptpolicy" value="SUBMIT">Accept</button><button name="declinedpolicy" value="SUBMIT">Decline</button>
        </form>

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
    <footer class="footer">Copyright &copy;2018</footer>

</body>

</html>