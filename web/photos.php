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
    include ('connection.php');
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
           <li><a href="myaccount.php" id="myaccount" style="visibility:hidden;" title="MyAccount">My Account</a></li>
			<li><a href="logout.php" id="logout" style="visibility:hidden;" title="Logout">Logout</a></li>
            <li><a href="addproduct.php" id="addprod" style="visibility:hidden;" title="AddProduct">Add Product</a></li>
        </ul>
    </nav>
    </div>
    <article>
    <?php
    if(isset($_POST['category'])){//Customer selects a new category filter
        $category = $_POST['category'];
        $_SESSION['currentcat'] = $category;
    }elseif(isset($_SESSION['currentcat'])){//Customers category is returned after leaving photos or adding item to cart
        $category = $_SESSION['currentcat'];
    }else{
        $category=0;//displays all items in products
    }

        echo "<form action='photos.php' method='POST'>
        <p align='center'><strong>Category:</strong><select name='category' id='category'></p>
        <option value='0'>All</option>";
       

         
        //search for all categories to display in form

        $cats = mysqli_query($link, "SELECT DISTINCT * FROM category");

        while($row = mysqli_fetch_array($cats)){
            $cat = $row['name'];
            $id = $row['id'];
            echo "<option value='$id'";
            if ($category == $id)
                echo " selected";
    
            echo ">$cat</option>";
        }
        
        ?>
        </select>
        <button value='filter selection' id='filter'>Ok</button> 
        <br>
        </form>
        <br>


<?php
// show all products

echo "<table align='center' border='5px solid' style='width:50%' bordercolor='#313C53'>
<tr>
<th style='width:50%'>Name</th>
<th style='width:50%'>Size</th>
<th style='width:50%'>Photo</th>
<th style='width:50%'>Price</th>
<th style='width:50%'>Quantity</th>
<th style='width:50%'>Add to Cart</th>";

// Display all products when customer moves to the photos.php page
if ($category == "" || $category == "0") {
    $result = mysqli_query($link,'select * from product');
    if ($result)   {
        $row_count = mysqli_num_rows($result);

        while ($row = mysqli_fetch_array($result)) {
        
                $img = $row['image'];
                $nm = $row['name'];
                echo "<tr>";
                echo "<td style='width:60%'>" . $row['name'] . "</td>";
                echo "<td style='width:60%'>" . $row['size'] . "</td>";
                echo "<td style='width:60%'>" . "<img src ='$img' alt='$nm' width='200' height='100'>" . "</td>";
                echo "<td style='width:60%'>" . $row['price'] . "</td>";
                echo "<form action = 'addToCart.php' method = 'POST'>";
                echo "<td style='width:60%'>" . "<input type='text' pattern='^[1-9]\d*$' name='quantity' value='1' size='2' />" . "</td>";
                echo "<td style='width:60%'>" . "<input type='submit' value='Add to cart'>" . "</td>";
        ?>
        <input type='hidden' name='prodid' value="<?php echo $row['id']?>"/>
<?php
        echo "</form>";
        }
    }
}

// show products filtered by category id
else if ($category != "0" && $category != "") {
    $result = mysqli_query($link," select * 
                                    from product p, productcategory pc
                                    where p.prod_id = pc.product_id
                                    and pc.category_id = '$category'");

    if ($result)   {
    $row_count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result)) {
	$img = $row['image'];
    $nm = $row['name'];
    echo "<tr>";
    echo "<td style='width:60%'>" . $row['name'] . "</td>";
    echo "<td style='width:60%'>" . $row['size'] . "</td>";
    echo "<td style='width:60%'>" . "<img src ='$img' alt='$nm' width='200' height='100'>" . "</td>";
    echo "<td style='width:60%'>" . $row['price'] . "</td>";
	echo "<form action = 'addToCart.php' method = 'POST'>";
    echo "<td style='width:60%'>" . "<input type='text' pattern='^[1-9]\d*$' name='quantity' value='1' size='2' />" . "</td>";
    echo "<td style='width:60%'>" . "<input type='submit' value='Add to cart'>" . "</td>";
	?>
	<input type='hidden' name='prodid' value="<?php echo $row['id']?>"/>
	<?php
	echo "</form>";
        }
    }
}

?>
    </article>
    </body>
<?php
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
