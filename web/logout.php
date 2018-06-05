
<script type="text/javascript">
// Popup window which confirms that the session is over
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
// Destroy session data, resets admin privileges
session_start();
session_destroy();
?>
<footer class="footer">Copyright &copy;2018</footer>

</body>
</html>