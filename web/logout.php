
<script type="text/javascript">
alert ('You are now logged out');
window.location="index.php";
</script>
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
session_destroy();
unset($_SESSION['userid'];
unset($_SESSION['user'];
$_SESSION['adminprivilege'] = false;
echo "You have successfully logged out";
echo "<h3>To log back in: <a href='login_register.php'>Login</a></h3>";
?>
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

?>
</body>
</html>