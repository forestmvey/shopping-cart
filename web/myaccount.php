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
    ini_set('display_errors',1);
    include('mysqli_connect.php');
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
			<li><a href="myaccount.php" id="myaccount" style="visibility:hidden;" title="MyAccount">My Account</a></li>
            <li><a href="logout.php" id="logout" style="visibility:hidden;" title="Logout">Logout</a></li>
            <li><a href="addproduct.php" id="addprod" style="visibility:hidden;" title="AddProduct">Add Product</a></li>
        </ul>
    </nav>
    </div>
    <article>
        <h1> Welcome to Blurry Photos 4 You! </h1>
        <p class="paragraph">We provide the best blurry photos the market can provide. Ranging from scenic to industrial, we can guarantee that you can find a photo you will want to hang up in your home.</p>
        <br>
	<?php
        if(isset($_POST['name'])){//update user info
			$name = $_POST['name'];
			$email = $_POST['email'];
			$address = $_POST['address'];
			
            $insertnew ="UPDATE customer SET name='$name', email='$email', address = '$address' WHERE email='$email';";
                if(mysqli_query($link, $insertnew)){
                    echo "<script>";
                    echo "alert('user info updated successfully!')";
                    echo "</script>";
                }else{
                    echo "<script>";
                    echo "alert('error updating user info!')" . mysqli_error($link);
                    echo "<script>";
                }

		}elseif(isset($_POST['newpassword'])){//user changes password
            $oldpass = $_POST['oldpassword'];
            $confirmpassword = $_POST['confirmpassword'];
            $newpassword = $_POST['newpassword'];
            $hasholdpass = sha1($oldpass);
			$hashnewpass = sha1($newpassword);
            $email = $_POST['email'];
            $insertnewpass = "UPDATE customer SET password='$hashnewpass' WHERE email='$email';";
            $passwordcheck = "SELECT password FROM customer WHERE email = '$email';";
            ini_set('display_errors',1);
            $check = mysqli_query($link, $passwordcheck);
            $row = mysqli_fetch_array($check);
            $pwstring = $row['password'];

            if($pwstring == $hasholdpass && $newpassword == $confirmpassword) {//updating new password
                if(mysqli_query($link, $insertnewpass)) {
                   echo "<script>";
                   echo "alert('user password updated successfully!');";
                   echo "</script>";
                 }else {
                    echo "<script>";
                    echo "alert('error updating user password!');" . mysqli_error($link);
                    echo "</script>";
                 }

            }elseif($newpassword != $confirmpassword){//confirmed password does not match
                echo "<script>";
                echo "alert('Both passwords entered were not the same');";
                echo "</script>";
            }else{
              echo "<script>";
              echo "Incorrect previous password";
              echo "</script>";
             }
		}//display old user info
			$useremail = $_SESSION['user'];
			$userinfo = "SELECT name, email, address FROM customer WHERE email = '$useremail'";
            $r = mysqli_query ($link, $userinfo);
            $row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
        ?>
		
		
  	<form action="myaccount.php" method="POST">
    <h1>Account Info: </h1>
    <p>Email: <input type="text" name="email" id="email" value="<?php echo $row['email']; ?>" title="email"></p>
    <p>Name: <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" title="name"></p>
    <p>Address: <input type="text" id="address" name="address" value="<?php echo $row['address']; ?>" title="address"></p>
	<p>Password: <input type="password" name="password" pattern="[a-zA-Z0-9]{4,10}" id="password" title="4 to 10 characters letters and numbers only"></p>
    <input type="submit" value="SUBMIT"  />
    </form>

    <form action="myaccount.php" method="POST">
    <h1>Change password</h1>
    <p>Email: <input type="text" name="email" id="email" value="<?php echo $row['email']; ?>" title="email"></p>
    <p>Previous Password: <input type="password" name="oldpassword" pattern="[a-zA-Z0-9]{4,10}" id="oldpassword" title="4 to 10 characters letters and numbers only"></p>
    <p>New Password: <input type="password" name="newpassword" pattern="[a-zA-Z0-9]{4,10}" id="newpassword" title="4 to 10 characters letters and numbers only"></p>
    <p>Confirm Password: <input type="password" name="confirmpassword" pattern="[a-zA-Z0-9]{4,10}" id="confirmpassword" title="4 to 10 characters letters and numbers only"></p>
    <input type="submit" value="SUBMIT"  />
    </form>
    
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
	//displays logout and my account only when user is signed in
		echo "<script>";
        echo "document.getElementById('logout').style.visibility = 'visible';";
		echo "document.getElementById('myaccount').style.visibility = 'visible';";
        echo "</script>";
	}

?>
         
</body>

</html>