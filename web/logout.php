<?php
session_start();
session_destroy();
?>
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
<footer class="footer">Copyright &copy;2018</footer>
<?php
    if(isset($_SESSION['adminprivilege'])){
        echo "<script>";
        echo "document.getElementById('addprod').style.visibility = 'visible';";
        echo "</script>";
   
    }

?>
</body>
</html>