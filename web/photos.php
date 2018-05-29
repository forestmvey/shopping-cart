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
            <li><a href="photos.php" title="Photos" class="viewing">Photos</a></li>
            <li><a href="login.php" title="Login">Login</a></li>
            <li><a href="cart.php" title="Cart">View Cart</a></li>
            <li><a href="addproduct.php" title="AddProduct">Add Product</a></li>
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
        print $row['id'] . ', ' . $row['name'] . ', ' . $row['description'] .', ' . $row['image'] .', ' . $row['price'] .  '<br>';
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
        print $row['id'] . ', ' . $row['name'] . ', ' . $row['description'] .', ' . $row['image'] .', ' . $row['price'] .  '<br>';
        }
    }
}

?>
    </article>

    <footer class="footer">Copyright &copy;2018</footer>
</body>
</html>

