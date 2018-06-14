<?php
require_once('vendor/autoload.php');

$stripe = array(
  "secret_key"      => "sk_test_wFhw6fEKcKlvCWXLNah47riY",
  "publishable_key" => "pk_test_88QbvdSv47iCGXCFtdY2pUdB"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>