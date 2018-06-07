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

    </article>
<?php
ini_set('display_errors',1);
session_start();

$_password = $_POST['registerpassword'];
$_email = $_POST['registeremail'];
$_name = $_POST['name'];
$_address = $_POST['address'];
$hashpass = sha1($_password);

//connection
include('mysqli_connect.php');

//insert customer registration
$insert = "INSERT INTO customer (name, password, email, address) 
values('$_name', '$hashpass', '$_email', '$_address')";

//validate email already not taken
$emailcheck = "SELECT email FROM customer WHERE email = '$_email'";
$check = mysqli_query($dbc, $emailcheck);


if(mysqli_num_rows($check) > 0){
    echo 'This email is already taken';
}elseif(mysqli_query($dbc, $insert)) {
    echo 'account successfully created!';
}else{
    echo 'invalid account info';
}

if(isset($_SESSION['adminprivilege'])){
	// This checks if the admin is logged in and allows them to 
    // add products to the database on when the admin is logged in
    // and is disabled when the admin is logged out
        echo "<script>";
        echo "document.getElementById('addprod').style.visibility = 'visible';";
        echo "</script>";
   
}


?>
    <footer class="footer">Copyright &copy;2018</footer>

</body>

</html>