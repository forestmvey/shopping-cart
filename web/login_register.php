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
            <li><a href="login_register.php" title="LoginRegister" class="viewing" id="loginregister">Login/Register</a></li>
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
    <!-- 
    Login form containing 2 inputs for email and password
    Password has a pattern to check if the password is valid or not
     -->
    </article>
    <form action="login.php" method="POST" onsubmit="return loginvalidation();">
    <h1>Login</h1>
    <p>Email: <input type="text" id="email" name="email" title="email"></p>
    <p>Password: <input type="password" name="password" pattern="[a-zA-Z0-9]{4,10}" id="password" title="4 to 10 characters letters and numbers only"></p>
    <input type="submit" value="SUBMIT"  />
    </form>
    <!--  
    Registration form contain 5 inputs for email, name, address, password, and confirm password
    Both password inputs have a pattern match to check if the passwords are valid or not 
    -->
	<form action="register.php" method="POST" onsubmit="return registervalidation();">
    <h1>Register: </h1>
    <p>Email: <input type="text" name="registeremail" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" id="registeremail" title="email"></p>
    <p>Name: <input type="text" id="name" name="name" title="name" pattern="[a-zA-Z]{2,15}"></p>
    <p>Address: <input type="text" id="address" name="address" title="address" pattern="[a-zA-Z0-9]{3,30}"></p>
    <p>Password: <input type="password" name="registerpassword" pattern="[a-zA-Z0-9]{4,10}" id="registerpassword" title="4 to 10 characters letters and numbers only"></p>
    <p>Confirm Password: <input type="password" name="confirmpassword" pattern="[a-zA-Z0-9]{4,10}" id="confirmpassword" title="4 to 10 characters letters and numbers only"></p>
    <input type="submit" value="SUBMIT"  />
    <!-- 
    Validation 
     -->
    <script>
        // Script to validate the login form
        function loginvalidation() {
           if(document.getElementById('email').value == ''){
               alert('You must enter a valid email');
               return false;
           }
           if(document.getElementById('password').value == ''){
               alert('You must enter a valid password');
               return false;
           }

        }
        // Script to validate the registration form
        function registervalidation() {
            if(document.getElementById('registerpassword').value != document.getElementById('confirmpassword').value){
                alert("Passwords are not same characters");
                return false;
            }
            if(document.getElementById('registeremail').value == ''){
               alert('You must enter a valid email');
               return false;
           }
           if(document.getElementById('registerpassword').value == ''){
               alert('You must enter a valid password');
               return false;
           }
           if(document.getElementById('confirmpassword').value == ''){
               alert('You must confirm the password');
               return false;
           }

        }
    </script>

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
	if(isset($_SESSION['user'])){
		echo "<script>";
        echo "document.getElementById('logout').style.visibility = 'visible';";
		echo "document.getElementById('myaccount').style.visibility = 'visible';";
        echo "</script>";
	}

?>
</body>

</html>