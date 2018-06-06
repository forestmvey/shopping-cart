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
                  <li><a href="myaccount.php" id="myaccount" style="visibility:hidden; title="MyAccount">My Account</a></li>
            <li><a href="logout.php" id="logout" style="visibility:hidden; title="Logout">Logout</a></li>
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
	
	//insert new category
		include('mysqli_connect.php');
		$cat = $_POST['newcategory'];
		$insertcat = "INSERT INTO category (name) VALUES ('$cat')";
		$catcheck = "SELECT name FROM category WHERE name = '$cat'";
		$check = mysqli_query($link, $catcheck);
		
		
		if(mysqli_num_rows($check) > 0){
			echo "<script>";
			echo "alert('This category name is already taken!')";
			echo "window.location='addproduct.php';";
			echo "</script>";
		}elseif(mysqli_query($link, $insertcat)){
			echo "<script>";
			echo "alert('Category successfully entered!');";
			echo "window.location='addproduct.php';";
			echo "</script>";
		}else{
			echo "<script>";
			echo "alert('Category not entered successfully!');";
			echo "window.location='addproduct.php';";
			echo "</script>";
		}
	

?>
    <footer class="footer">Copyright &copy;2018</footer>

</body>

</html>