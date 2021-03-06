<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="default.css">
    <link rel="stylesheet" href="form.css">
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
            <li><a href="login_register.php" title="LoginRegister" class="viewing">Login/Register</a></li>
			<li><a href="myaccount.php" title="MyAccount" id="myaccount"style="visibility:hidden;">My Account</a></li>
            <li><a href="logout.php" title="Logout" id="logout" style="visibility:hidden;">Logout</a></li>
            <li><a href="orderhistory.php" id="orderhistory" style="visibility:hidden;" title="OrderHistory">Order History</a></li>
            <li><a href="addproduct.php" id="addprod" style="visibility:hidden;" title="AddProduct">Add Product</a></li>
        </ul>
    </nav>
    </div>
    <article>
        <br>
    <!-- 
    Login form containing 2 inputs for email and password
    Password has a pattern to check if the password is valid or not
     -->
    </article>
    <div class="formDiv">
    <form action="login.php" method="POST" onsubmit="return loginvalidation();" class="form center">
    <h1>Login:</h1>
    <label>Email:</label>
    <br>
        <input type="text" id="email" name="email" title="email">
    <br> 
    <label>Password:</label>
    <br>
        <input type="password" name="password" pattern="[a-zA-Z0-9]{4,10}" id="password" title="4 to 10 characters letters and numbers only">
    <br>
    <input type="submit" value="SUBMIT"  />
    </form>
    </div>
    <!--  
    Registration form contain 5 inputs for email, name, address, password, and confirm password
    Both password inputs have a pattern match to check if the passwords are valid or not 
    -->
	<div class="formDiv">
	<form action="register.php" method="POST" onsubmit="return registervalidation();" class="form center">
    <h1>Register: </h1>
    <label>Email:</label>
    <br> 
        <input type="text" name="registeremail" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" id="registeremail" title="email">
    <br>
    <label>Name:</label>
    <br> 
        <input type="text" id="name" name="name" title="name" pattern="[\sa-zA-Z]{2,15}">
    <br>
    <label>Address:</label>
    <br> 
        <input type="text" id="address" name="address" title="address" pattern="[\sa-zA-Z0-9]{4,20}">
    <br>
    <label>Password:</label> 
    <br>    
        <input type="password" name="registerpassword" pattern="[a-zA-Z0-9]{4,10}" id="registerpassword" title="4 to 10 characters letters and numbers only">
    <br>
    <label>Confirm Password:</label>
    <br> 
        <input type="password" name="confirmpassword" pattern="[a-zA-Z0-9]{4,10}" id="confirmpassword" title="4 to 10 characters letters and numbers only">
	<?php if(isset($_SESSION['adminprivilege'])){
		echo "<p>Adding Admin Account?<input type='checkbox' name='newadmin' value='yes'/></p>";
	}
        ?>
    <br>    
    <input type="submit" value="SUBMIT"  />
    </form>
    </div>
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