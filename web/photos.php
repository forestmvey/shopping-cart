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
        </ul>
    </nav>
    </div>
    <article>
        <h1> Welcome to Blurry Photos 4 You! </h1>
        <!-- s<form name="Category"> -->
        <p> Category:</p><select name="category" id="category"></p>
        <option value="1">Scenic</option>
        <option value="2">Transportation</option>
        <option value="3">Industrial</option>
        </select>
        <br>
        <button value="filter selection" id="filter">Ok</button> 
        <br>

        <!-- <script> 
            filter.onclick = function filter() {
            var cat = document.getElementById("category");
            var val = cat.options[cat.selectedIndex].value;
            if (val == "scenic") {
                console.log(val);
            }
            else if (val == "transportation"){
                console.log(val);
            }
            else if (val == "industrial") {
                console.log(val);
            }
        }
        </script> -->
        <?php

        session_start();

        include ('connection.php');
        if () {

        }
        else if () {

        }
        else if () {

        }

        $result = mysqli_query($link,'select * from product where productcategory.category_id = ');
        if ($result)   {
        $row_count = mysqli_num_rows($result);
        print 'Retreived '. $row_count . ' rows from the <b> product </b> table<BR><BR>';
     
        while ($row = mysqli_fetch_array($result)) {
            print $row['id'] . ', ' . $row['name'] . ', ' . $row['description'] .', ' . $row['image'] .', ' . $row['price'] .  '<br>';
        }
     
    }

        ?>
    </article>

    <footer class="footer">Copyright &copy;2018</footer>
</body>
</html>

