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
            <li><a href="cart.php" title="Cart" class="viewing">View Cart</a></li>
            <li><a href="login_register.php" title="LoginRegister">Login/Register</a></li>
            <li><a href="myaccount.php" id="myaccount" style="visibility:hidden;" title="MyAccount">My Account</a></li>
			<li><a href="logout.php" id="logout" style="visibility:hidden;" title="Logout">Logout</a></li>
            <li><a href="addproduct.php" id="addprod" style="visibility:hidden;" title="AddProduct">Add Product</a></li>
        </ul>
    </nav>
    </div>

<?php
  session_start();
  include('includes/header.html');
  require_once('./config.php');
  include ('connection.php');
  ini_set('display_errors',1);

  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];
  
  $totalamt = $_POST['totalamt'];
  
  
  $customer = \Stripe\Customer::create(array(
      'email' => $email,
      'source'  => $token
  ));

  $charge = \Stripe\Charge::create(array(
      'customer' => $customer->id,
      'amount'   => $totalamt,
      'currency' => 'cad'
  ));

$amount = number_format(($totalamt / 100), 2);

  


  //insert order into order history

  $userID = $_SESSION['userid'];

  $order = mysqli_query($link, "SELECT cu.id, cu.address, c.customer_id, product_id, quantity, p.name, p.image, p.price FROM customer cu, cart c, product p WHERE cu.id = c.customer_id AND c.product_id = p.id AND cu.id = '$userID'");
  
  $orderid = mysqli_query($link, "SELECT MAX(order_id) FROM orderhistory");
  $row = mysqli_fetch_assoc($orderid);
  $orderid2 = intval($row['MAX(order_id)']);
  
  if(mysqli_num_rows($orderid) > 0){//incrementing previous order id 
    $orderid2 = $orderid2 + 1;
  }else{ //if no previous order id's, start at 1
    $orderid2 = 1;
  }
  

  $status = "Paid";
  echo $status;
  
  if(!empty($_POST['billingaddress'])){//if user has different billing and shipping addresses
    $billaddr = $_POST['billingaddress'];

    while($row = mysqli_fetch_array($order)){
      $productid = $row['product_id'];
      $image = $row['image'];
      $quantity = $row['quantity'];
      $price = $row['price'];
      $mailaddr = $row['address'];
      $productname = $row['name'];

      $insert = "INSERT INTO orderhistory (order_id, customer_id, product_id, product_name, image, quantity,
      price, date, bill_address, mail_address, status) values ('$orderid2', '$userID', '$productid', '$productname', 
      '$image', '$quantity', '$price', now(), '$billaddr', '$mailaddr', '$status')";


    
      if(mysqli_query($link, $insert)){
        echo "<br>" . $productid . " " . $productname . " " . $price . " " . $quantity;
      }else{
        echo mysqli_error($insert) . " Error recording order history";
      }
      
    }
/*
    echo "<h3>Successfully charged $".$amount." </h3>Thank you for shopping";
    echo "<form action='index.php'>";
                 echo "<input type='submit' value='Return Home'>";
                 echo "<br>";
				 echo "</form>";

 */
header('location:write_receipt.php');
        }else{  //Insert with same billing and mailing addresses

    

    while($row = mysqli_fetch_array($order)){
      $productid = $row['product_id'];
      $image = $row['image'];
      $quantity = $row['quantity'];
      $price = $row['price'];
      $billaddr = $row['address'];
      $mailaddr = $row['address'];
      $productname = $row['name'];

      $insert = "INSERT INTO orderhistory (order_id, customer_id, product_id, product_name, image, quantity,
      price, date, bill_address, mail_address, status) values ('$orderid2', '$userID', '$productid', '$productname', 
      '$image', '$quantity', '$price', now(), '$billaddr', '$mailaddr', '$status')";

      if(mysqli_query($link, $insert)){
        echo "<br>" . $productid . " " . $productname . " " . $price . " " . $quantity;
      }else{
        echo mysqli_error($insert) . " Error recording order history";
      }
    }
 
    header('location:write_receipt.php');
    /*echo "<h3>Successfully charged $".$amount." </h3>Thank you for shopping";
    echo "<form action='index.php'>";
                 echo "<input type='submit' value='Return Home'>";
                 echo "<br>";
				 echo "</form>";
  */
        }

  
	// This checks if the admin is logged in and allows them to 
    // add products to the database on when the admin is logged in
    // and is disabled when the admin is logged out
    if(isset($_SESSION['adminprivilege'])){
        echo "<script>";
        echo "document.getElementById('addprod').style.visibility = 'visible';";
        echo "</script>";
   
    }
	
	if(isset($_SESSION['userid'])){
		echo "<script>";
		echo "document.getElementById('logout').style.visibility = 'visible';";
		echo "document.getElementById('myaccount').style.visibility = 'visible';";
		echo "</script>";
	}
	
//include ('includes/footer.html');
?>


  

</body>

</html>