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
    ini_set('display_errors',1);
    include('connection.php');
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
            <li><a href="login_register.php" title="LoginRegister">Login/Register</a></li>
			<li><a href="myaccount.php" id="myaccount" style="visibility:hidden;" title="MyAccount"  class="viewing">My Account</a></li>
            <li><a href="logout.php" id="logout" style="visibility:hidden;" title="Logout">Logout</a></li>
            <li><a href="orderhistory.php" id="orderhistory" style="visibility:hidden;" title="OrderHistory">Order History</a></li>
            <li><a href="addproduct.php" id="addprod" style="visibility:hidden;" title="AddProduct">Add Product</a></li>
        </ul>
    </nav>
    </div>
    <article>
        
	<?php
        if(isset($_POST['name'])){//update user info
			$name = $_POST['name'];
			$email = $_POST['email'];
            $address = $_POST['address'];
            if(isset($_POST['policybox'])){
                $updatepolicy = $_POST['policybox'];
            }else{
                $updatepolicy = 0;
            }
			
            $insertnew ="UPDATE customer SET name='$name', email='$email',policy='$updatepolicy', address = '$address' WHERE email='$email';";
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
		
	<div class="formDiv">
  	<form action="myaccount.php" method="POST" class="form center">
    <h1>Account Info: </h1>
    <label>Email:</label>
    <br>
        <input type="text" name="email" id="email" value="<?php echo $row['email']; ?>" title="email">
    <br>
    <label>Name:</label>
    <br> 
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" title="name">
    </br>
    <label>Address:</label>
    <br>
        <input type="text" id="address" name="address" value="<?php echo $row['address']; ?>" title="address">
	</br>
    <label>Password:</label>
    <br>    
        <input type="password" name="password" pattern="[a-zA-Z0-9]{4,10}" id="password" title="4 to 10 characters letters and numbers only">
    <br>
    <input type="checkbox" id="policybox" name="policybox" value="1"> Accept Terms and Services! 
    <br>
    <input type="submit" value="SUBMIT"  />
    </form>
    </div>

    <div class="formDiv">
    <form action="myaccount.php" method="POST" class="form center">
    <h1>Change password</h1>
    <label>Email:</label>
    <br>
        <input type="text" name="email" id="email" value="<?php echo $row['email']; ?>" title="email">
    <br>
    <label>Previous Password:</label>
    <br>
        <input type="password" name="oldpassword" pattern="[a-zA-Z0-9]{4,10}" id="oldpassword" title="4 to 10 characters letters and numbers only">
    <br>
    <label>New Password:</label>
    <br>
        <input type="password" name="newpassword" pattern="[a-zA-Z0-9]{4,10}" id="newpassword" title="4 to 10 characters letters and numbers only">
    <br>
    <label>Confirm Password:</label>
    <br>
        <input type="password" name="confirmpassword" pattern="[a-zA-Z0-9]{4,10}" id="confirmpassword" title="4 to 10 characters letters and numbers only">
        <input type="submit" value="SUBMIT"  />
    </form>
    </div>
	
<?php
//Check if user has accepted privacy policy
$policy = "Select policy from customer where email = '$useremail'";
$check2 = mysqli_query($link, $policy);
$policy2 = mysqli_fetch_array($check2);
$policycheck = $policy2['policy'];

if($policycheck == 1){//check box if already accepted policy
    echo "<script>";
    echo "document.getElementById('policybox').checked = true;";
    echo "document.getElementById('policybox').value = 1;";
    echo "</script>";
}else{
    echo "<script>";
    echo "document.getElementById('polixybox').checked = false;";
    echo "</script>";
}


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