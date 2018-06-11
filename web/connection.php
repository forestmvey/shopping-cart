<?php


$server = 'localhost';
$user = 'cst146';
$pswd = '453692';
$db='ICS199Group06_dev';

$link = mysqli_connect($server,$user,$pswd,$db);

if (!$link) {
    die ('MySQL Error:' . mysqli_connect_error());
}
//  else {
//      print "Connecting to database <BR>" ;
//  }

?>

