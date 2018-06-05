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
            <li><a href="myaccount.php" title="MyAccount">My Account</a></li>
            <li><a href="logout.php" title="Logout">Logout</a></li>
            <li><a href="addproduct.php" id="addprod" style="visibility:hidden;" title="AddProduct">Add Product</a></li>
        </ul>
    </nav>
    </div>
    <article>
        <h1> Welcome to Blurry Photos 4 You! </h1>
        <p class="paragraph">We provide the best blurry photos the market can provide. Ranging from scenic to industrial, we can guarantee that you can find a photo you will want to hang up in your home.</p>
        <br>
        <?php
        session_start();
         include ('connection.php');
        // show all products
        $result = mysqli_query($link," select p.name, p.image, p.size, c.quantity, p.price
             from product p, cart c, customer cu
             where cu.id = c.customer_id
             and c.product_id = p.id
             and cu.id = '$userID'");
             if ($result)   {
                 $row_count = mysqli_num_rows($result);
                 print 'Retreived '. $row_count . ' rows from the <b> product </b> table<BR><BR>';

                 while ($row = mysqli_fetch_array($result)) {
                     echo "<table border='1' style='width:50%'>
                     <tr>
                     <th style='width:50%'>Name</th>
                     <th style='width:50%'>Photo</th>
                     <th style='width:50%'>Size</th>
                     <th style='width:50%'>Quantity</th>
                     <th style='width:50%'>Price</th>";

		             $img = $row['image'];
                     $nm = $row['name'];
                     echo "<tr>";
                     echo "<td style='width:60%'>" . $row['name'] . "</td>";
                     echo "<td style='width:60%'>" . "<img src ='$img' alt='$nm' width='200' height='100'>" . "</td>";
                     echo "<td style='width:60%'>" . $row['size'] . "</td>";
                     echo "<td style='width:60%'>" . $row['quantity'] . "</td>";
                     echo "<td style='width:60%'>" . $row['price'] . "</td>";

        //             // add to cart button, POSTs to database 
        //             // echo "<form action = 'addToCart.php' method = 'POST'>";
        //             // echo "<td style='width:60%'>" . "<input type='text' name='quantity' value='1' size='2' />" . "</td>";
        //             // echo "<td style='width:60%'>" . "<input type='submit' value='Add to cart'>" . "</td>";
        //             // echo "<input type='hidden' name='prodID' value='" . $row['id'] . "'";
        //             // echo "</form>";
		        }
            }
?>
    </article>
    </body>

	 

    </article>

	
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
    if(!isset($_SESSION['user'])){//if user is not signed in, redirect to login page!
        echo "<script>";
        echo "alert(You must sign in or register to continue to your cart!);";
        echo "</script>";
        header('location:login_register.php');
    }else{//display cart items
        $userid = $_SESSION['userid'];
        $query = "SELECT customer_id, product_id, image, name, price, quantity FROM cart c JOIN product p WHERE c.product_id = p.id AND customer_id = '$userid'";
        include('mysqli_connect.php');
        $cart = mysqli_query($dbc, $query);
        echo "<tr>";
        echo "<td style='width:60%'>" . $_SESSION['user'] . "</td>";
        while($row = mysqli_fetch_array($cart)){
            $img = $row['image'];
            $nm = $row['name'];
            echo "<tr>";
            echo "<p>Product ID: .<td style='width:60%'>" . $row['product_id'] . "</td>" . "</p>";
            echo "<p>Image Name: <td style='width:60%'>" . $row['name'] . "</td>";
            echo "<p><td style='width:60%'>" . "<img src ='$img' alt='$nm' width='200' height='100'>" . "</td>" . "</p>";
            echo "<p>Price: <td style='width:60%'>" . $row['price'] . "</td>" . "</p>";
            echo "<p>Quantity: <td style='width:60%'>" . $row['quantity'] . "</td>" . "</p>";
       }
       
    }
?>
</body>

</html>