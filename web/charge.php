<?php
  session_start();
  include('includes/header.html');
  require_once('./config.php');

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
  echo $userID . "userid";

  $order = mysqli_query($link, "SELECT * FROM customer cu, cart c, product p WHERE cu.id = c.customer_id AND c.product_id = p.id AND cu.id = '$userID'");
  echo $order . "order query";
  $orderid = mysqli_query($link, "SELECT MAX(order_id) FROM orderhistory");
  echo $orderid . "orderid";

  if(mysqli_num_rows($orderid) > 0){//incrementing previous order id 
    $orderid = orderid + 1;
  }else{ //if no previous order id's, start at 1
    $orderid = 1;
  }
  $status = 'Paid';
  
  if(!empty($_POST['billingaddress'])){//if user has different billing and shipping addresses
    $address = $_POST['billingaddress'];

   

    while($row = mysqli_fetch_array($order)){
      $productid = $row['product_id'];
      $image = $row['image'];
      $quantity = $row['quantity'];
      $price = $row['price'];
      $billaddr = $row['bill_address'];
      $mailaddr = $row['mail_address'];

      $insert = "INSERT INTO orderhistory (order_id, customer_id, product_id, image, quantity,
      price, date, bill_address, mail_address, status) values ('$orderid', '$userID', '$productid', 
      '$image', '$quantity', '$price', now(), '$billaddr', '$mailaddr', '$status')";

      echo $insert;

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
      $billaddr = $row['bill_address'];
      $mailaddr = $row['mail_address'];

      $insert = "INSERT INTO orderhistory (order_id, customer_id, product_id, image, quantity,
      price, date, bill_address, mail_address, status) values ('$orderid', '$userID', '$productid', 
      '$image', '$quantity', '$price', now(), '$billaddr', '$mailaddr', '$status')";

      echo $insert;

      if(mysqli_query($link, $insert)){
        echo "worked";
      }else{
        echo "nope";
      }
    }

  }




  include ('includes/footer.html');
?>