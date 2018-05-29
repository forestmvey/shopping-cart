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
            <li><a href="index.php" title="Main page">Main</a></li>
            <li><a href="photos.php" title="Photos">Photos</a></li>
            <li><a href="login.php" title="Login">Login</a></li>
            <li><a href="cart.php" title="Cart">View Cart</a></li>
            <li><a href="addproduct.php" title="Add Product" class="viewing">Add Product</a></li>
        </ul>
    </nav>
    </div>
    <article>
        <h1> Welcome to Blurry Photos 4 You! </h1>
        <p class="paragraph">We provide the best blurry photos the market can provide. Ranging from scenic to industrial, we can guarantee that you can find a photo you will want to hang up in your home.</p>
        <br>

    </article>

	
    

<form action="addproductvars.php" method="POST" onsubmit="return validation();">
<p> Upload Photo URL: <input type="text" name="photo" id="photo"/></p>
<p> Photo name: <input type="text" name="name" id="name"/></p>
<<<<<<< HEAD
<p> Price: <input type="text" pattern="[0-9]+(\.[0-9][0-9]?)?" title="Numbers Only" name="price" id="price"/></p>
=======
<p> Price: <input type="text" name="price" id="price" pattern="[0-9]+(\.[0-9][0-9]?)?" title="numbers only"/></p>
>>>>>>> origin
<p> Dimensions:</p><select name="dimensions" id="dimensions"></p>
<option value="5 x 7">5"x7"</option>
<option value="8 x 10">8"x10"</option>
<option value="11 x 14">11"x10"</option>
<option value="16 x 20">16"x20"</option>
</select>
<p> Category: <select name="category" id="category"></p>
<option value="1">scenic</option>
<option value="2">transportation</option>
<option value="3">industrial</option>
</select>
<input type="submit" value="SUBMIT"  />
</form>
<script>

function validation() {
// VALIDATION CODE HERE!
if(document.getElementById('photo').value == ''){
	alert("You must include a photo");
	return false;
}
if(document.getElementById('price').value == ''){
	alert("You must include a product price");
	return false;
}
if(document.getElementById('name').value == ''){
	alert("You must include a photoname");
	return false;
}

}

</script>
<footer class="footer">Copyright &copy;2018</footer>
</body>
</html>