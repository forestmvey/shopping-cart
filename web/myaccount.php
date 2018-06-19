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
		
		
  	<form action="myaccount.php" method="POST">
    <h1>Account Info: </h1>
    <p>Email: <input type="text" name="email" id="email" value="<?php echo $row['email']; ?>" title="email"></p>
    <p>Name: <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" title="name"></p>
    <p>Address: <input type="text" id="address" name="address" value="<?php echo $row['address']; ?>" title="address"></p>
	<p>Password: <input type="password" name="password" pattern="[a-zA-Z0-9]{4,10}" id="password" title="4 to 10 characters letters and numbers only"></p>
    <input type="checkbox" id="policybox" name="policybox" value="1"> Accept Terms and Services! <br>
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
	<h2>Order History</h2>
    <?php
	// Display order history
	$userid = $_SESSION['userid'];
	
	
	
	$orderhist = "SELECT * from orderhistory where customer_id = '$userid' order by order_id AND product_name";
	$result =  mysqli_query($link, $orderhist);
	$row_count = mysqli_num_rows($result);
	// if nothing has been ordered yet, dont display anything!
	if ($row_count == 0){
		echo "<p>Nothing ordered yet!</p>";
	
	}else{
		echo "<table align='center' border='5px solid' style='width:50%' bordercolor='#313C53'>
		<tr>
		<th style='width:20%'>Order #</th>
		<th style='width:20%'>Blurry Photo</th>
		<th style='width:20%'>Quantity</th>
		<th style='width:20%'>Price</th>
		<th style='width:50%'>Billing Address</th>
		<th style='width:50%'>Shipping Address</th>
		<th style='width:20%'>Date of Purchase</th>
		<th style='width:20%'>Status</th>";
	
		while ($row = mysqli_fetch_array($result)){
		$img = $row['image'];
		echo "<tr>";
		echo "<td style='width:30%'>" . $row['order_id'] . "</td>";
		echo "<td style='width:30%'>" . "<img src ='$img' alt '$img' width='200' height='100'>" . "</td>";
		echo "<td style='width:30%'>" . $row['quantity'] . "</td>";
		echo "<td style='width:30%'>" . $row['price'] . "</td>";
		echo "<td style='width:50%'>" . $row['bill_address'] . "</td>";
		echo "<td style='width:50%'>" . $row['mail_address'] . "</td>";
		echo "<td style='width:30%'>" . $row['date'] . "</td>";
		echo "<td style='width:30%'>" . $row['status'] . "</td>";
    }
	}
	?>
    
		 
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
        echo "</script>";
	}

?>
         
</body>

</html>