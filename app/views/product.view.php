<?php

$product_id = $data['id'];

$url = ROOT . "/fetch/product/$product_id";
$response = file_get_contents($url);
$data = json_decode($response, true);

$url2 = ROOT . "/fetch/product_images/" . $product_id;
$response = file_get_contents($url2);
$images = json_decode($response, true);

show($data);
show($images);
