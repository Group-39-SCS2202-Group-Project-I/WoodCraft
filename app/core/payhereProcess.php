<?php
// require ROOT.'app/core/credentials.php';


$amount = 8010;
$merchant_id = "1225820";
$order_id = uniqid();
$merchant_secret = "MzY2NDYwODUwNjQ1MzYxNDU4NjE3NTgwNDk2Nzc3NzM1OTU1MjQ=";
$currency = "LKR";

$hash = strtoupper(
    md5(
        $merchant_id . 
        $order_id . 
        number_format($amount, 2, '.', '') . 
        $currency .  
        strtoupper(md5($merchant_secret)) 
    ) 
);

$array = [];

$array["amount"] = $amount;
$array["merchant_id"] = $merchant_id;
$array["order_id"] = $order_id;
$array["merchant_secret"] = $merchant_secret;
$array["currency"] =$currency;
$array["hash"] =$hash;

$jsonObj = json_encode($array);

echo $jsonObj;