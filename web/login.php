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
        Blurry Photos 42 You!
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

$password = $_POST['password'];
$email = $_POST['email'];
$hashpass = sha1($password);

include('mysqli_connect.php');
$passwordcheck = "SELECT password FROM customer WHERE email = '$email'";

$check = mysqli_query($dbc, $passwordcheck);
$row = mysqli_fetch_array($check);
$pwstring = $row['password'];

if($pwstring == $hashpass && $email == 'admin@gmail.com'){
    $_SESSION['user'] = $_POST['email'];
    $_SESSION['adminprivilege'] = true;
    echo 'login successful!';
}elseif($pwstring == $hashpass) {
    echo 'login successful!';
	$_SESSION['user'] = $_POST['email'];
}else{
    echo 'invalid password';
}


?>

    <footer class="footer">Copyright &copy;2018</footer>
<?php
    if(isset($_SESSION['adminprivilege'])){
        echo "<script>";
        echo "document.getElementById('addprod').style.visibility = 'visible';";
        echo "</script>";
   
    }

?>
</body>

</html>