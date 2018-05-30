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
if(isset($_SESSION['user'])){
	echo 'logged in';
}

ini_set('display_errors',1);

$password = $_POST['password'];
$email = $_POST['email'];
$hashpass = sha1($password);

include('mysqli_connect.php');
$passwordcheck = "SELECT password FROM customer WHERE email = '$email'";

$check = mysqli_query($dbc, $passwordcheck);
$row = mysqli_fetch_array($check);
$pwstring = $row['password'];

if($pwstring == $hashpass) {
    echo 'login successful!';
	$_SESSION['user'] = $_POST['email'];
}else{
    echo 'invalid password';
}


?>

    <footer class="footer">Copyright &copy;2018</footer>

</body>

</html>