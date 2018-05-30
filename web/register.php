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
            <li><a href="login.php" title="Login">Login</a></li>
            <li><a href="cart.php" title="Cart">View Cart</a></li>
            <li><a href="login_register.php" title="LoginRegister">Login/Register</a></li>
            <li><a href="addproduct.php" title="AddProduct">Add Product</a></li>
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
$hashpass = password_hash($_password, PASSWORD_DEFAULT);

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

?>
    <footer class="footer">Copyright &copy;2018</footer>

</body>

</html>