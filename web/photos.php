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
?>
    <header>
        Blurry Photos 4 You!
    </header>
    <div>
    <nav>
        <ul>
            <li><a href="index.php" title="Main page">Main</a></li>
            <li><a href="photos.php" title="Photos" class="viewing">Photos</a></li>
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
        <form action="photos.php" method="POST">
        <p> Category:</p><select name="category" id="category"></p>
        <option value="4">All</option>
        <option value="1">Scenic</option>
        <option value="2">Transportation</option>
        <option value="3">Industrial</option>
        </select>
        <br>
        <button value="filter selection" id="filter">Ok</button> 
        </form>
        <br>


        <?php
session_start();

include ('connection.php');
// show all products
$category = $_POST['category'];
if ($category == "4") {
    $result = mysqli_query($link,'select * from product');
    if ($result)   {
    $row_count = mysqli_num_rows($result);
    print 'Retreived '. $row_count . ' rows from the <b> product </b> table<BR><BR>';


    while ($row = mysqli_fetch_array($result)) {
        echo "<table border='1' style='width:50%'>
        <tr>
        <th style='width:50%'>Name</th>
        <th style='width:50%'>Size</th>
        <th style='width:50%'>Photo</th>
        <th style='width:50%'>Price</th>
        <th style='width:50%'>Quantity</th>
        <th style='width:50%'>Add to Cart</th>";

		$img = $row['image'];
        $nm = $row['name'];
        echo "<tr>";
        echo "<td style='width:60%'>" . $row['name'] . "</td>";
        echo "<td style='width:60%'>" . $row['size'] . "</td>";
        echo "<td style='width:60%'>" . "<img src ='$img' alt='$nm' width='200' height='100'>" . "</td>";
        echo "<td style='width:60%'>" . $row['price'] . "</td>";
        echo "<td style='width:60%'>" . "<input type='text' name='quantity' value='1' size='2' />" . "</td>";
        echo "<td style='width:60%'>" . "<input type='submit' value='Add to cart'>" . "</td>";

        // print $row['id'] . ', ' . $row['name'] . ', ' . $row['size'] . "<img src ='$img' alt='$nm' width='200' height='100'>" . $row['price'] .
		// "<input type='text' name='quantity' value='1' size='2' />" .
		// "<input type='submit' value='Add to cart'>" .
		// '<br>';
        }
    }
}
// show products filtered by category id
else if ($category != "4") {
    $result = mysqli_query($link," select * 
                                    from product p, productcategory pc
                                    where p.id = pc.product_id
                                    and pc.category_id = '$category'");

    if ($result)   {
    $row_count = mysqli_num_rows($result);
    print 'Retreived '. $row_count . ' rows from the <b> product </b> table<BR><BR>';

    while ($row = mysqli_fetch_array($result)) {
    echo "<table border='1' style='width:50%'>
    <tr>
    <th style='width:50%'>Name</th>
    <th style='width:50%'>Size</th>
    <th style='width:50%'>Photo</th>
    <th style='width:50%'>Price</th>
    <th style='width:50%'>Quantity</th>
    <th style='width:50%'>Add to Cart</th>";

	$img = $row['image'];
    $nm = $row['name'];
    echo "<tr>";
    echo "<td style='width:60%'>" . $row['name'] . "</td>";
    echo "<td style='width:60%'>" . $row['size'] . "</td>";
    echo "<td style='width:60%'>" . "<img src ='$img' alt='$nm' width='200' height='100'>" . "</td>";
    echo "<td style='width:60%'>" . $row['price'] . "</td>";
    echo "<td style='width:60%'>" . "<input type='text' name='quantity' value='1' size='2' />" . "</td>";
    echo "<td style='width:60%'>" . "<input type='submit' value='Add to cart'>" . "</td>";

	// print $row['id'] . ', ' . $row['name'] . ', ' . $row['size'] . "<img src ='$img' alt='$nm' width='200' height='100'>" . $row['price'] .
	// 	"<input type='text' name='quantity' value='1' size='2' />" .
	// 	"<input type='submit' value='Add to cart'>" .
	// 	'<br>';
        }
    }
}

?>
    </article>
    </body>
    <!-- <footer class="footer">Copyright &copy;2018</footer> -->
<?php
    if(isset($_SESSION['adminprivilege'])){
        echo "<script>";
        echo "document.getElementById('addprod').style.visibility = 'visible';";
        echo "</script>";
   
    }

?>
</body>
</html>

