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
	<?php
		
		if(isset($_POST['id'])){
			$name = $_POST['name'];
			$id = $_POST['id'];
			$email = $_POST['email'];
			$address = $_POST['address'];
			
			insert
		}else{
			$id = $_GET['id'];
			select...
			Then load form
		}
	?>
		
		
  	<form action="register.php" method="POST" onsubmit="return registervalidation();">
    <h1>Account Info: </h1>
    <p>Email: <input type="text" name="registeremail" id="registeremail" title="email"></p>
    <p>Name: <input type="text" id="name" name="name" title="name"></p>
    <p>Address: <input type="text" id="address" name="address" title="address"></p>
	<p>Password: <input type="password" name="oldpassword" pattern="[a-zA-Z0-9]{4,10}" id="oldpassword" title="4 to 10 characters letters and numbers only"></p>
    <p>Password: <input type="password" name="registerpassword" pattern="[a-zA-Z0-9]{4,10}" id="registerpassword" title="4 to 10 characters letters and numbers only"></p>
    <p>Confirm Password: <input type="password" name="confirmpassword" pattern="[a-zA-Z0-9]{4,10}" id="confirmpassword" title="4 to 10 characters letters and numbers only"></p>
    <input type="submit" value="SUBMIT"  />
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

?>
</body>

</html>