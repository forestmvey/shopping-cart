<?php
  session_start();
  include('includes/header.html');
  require_once('./config.php');
  include ('connection.php');
  ini_set('display_errors',1);

  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];
  
  $totalamt = $_POST['totalamt'];
  
  echo "Total amt: $totalamt";
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
  echo '<h3>Successfully charged $'.$amount.' </h3>Thank you for shopping at Tuk Tuk Heaven';
  


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
      price, date, bill_address, mail_address, status) values ('$orderid2', '$userID', '$productid', '$productname' 
      '$image', '$quantity', '$price', now(), '$billaddr', '$mailaddr', '$status')";

      if(mysqli_query($link, $insert)){
        echo "worked";
      }else{
        echo "nope";
      }
    }

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
        echo "worked";
      }else{
        echo "nope";
      }
    }

  }




  //include ('includes/footer.html');
?>