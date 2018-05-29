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
            <li><a href="addproduct.php" title="AddProduct">Add Product</a></li>
        </ul>
    </nav>
    </div>
    <article>
        <h1> Welcome to Blurry Photos 4 You! </h1>
        <p class="paragraph">We provide the best blurry photos the market can provide. Ranging from scenic to industrial, we can guarantee that you can find a photo you will want to hang up in your home.</p>
        <br>

    </article>
    <form action="login.php" method="POST" onsubmit="return loginvalidation();">
    <h1>Login</h1>
    <p>Email<input type="text" id="email" title="email"></p>
    <p>Password<input type="password" pattern="[a-zA-Z0-9]{4,10}" id="password" title="4 to 10 characters letters and numbers only"></p>
    <input type="submit" value="SUBMIT"  />
    </form>
	<form action="register.php" method="POST" onsubmit="return registervalidation();">
    <h1>Register</h1>
    <p>Email<input type="text" id="registeremail" title="email"></p>
    <p>Password<input type="password" pattern="[a-zA-Z0-9]{4,10}" id="registerpassword" title="4 to 10 characters letters and numbers only"></p>
    <p>Confirm Password<input type="password" pattern="[a-zA-Z0-9]{4,10}" id="confirmpassword" title="4 to 10 characters letters and numbers only"></p>
    <input type="submit" value="SUBMIT"  />

    <script>
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
        function registervalidation() {
            if(document.getElementById('password').value != document.getElementById('confirmpassword').value){
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

</body>

</html>