<?php


function show($stuff)
{
	echo "<pre>";
	print_r($stuff);
	echo "</pre>";
}


function set_value($key)
{

	if(!empty($_POST[$key]))
	{
		return $_POST[$key];
	}

	return '';
}

function redirect($link)
{
	header("Location: ". ROOT."/".$link);
	die;
}

function message($msg = '',$erase = false)
{

	if(!empty($msg))
	{
		$_SESSION['message'] = $msg;
	}else{

		if(!empty($_SESSION['message']))
		{
			$msg = $_SESSION['message'];
			if($erase){
				unset($_SESSION['message']);
			}
			return $msg;
		}
	}

	return false;
}

function isInURL($link)
{
	
	if('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] == ROOT.$link)
	{
		return true;
	}

	return false;
}


// create star rating with filled and outlined star icons

function createStarRating($rating) {
	$output = '';

	for ($i = 1; $i <= 5; $i++) {
		if ($i <= $rating) {
			$output .= '<ion-icon name="star"></ion-icon>';
		} else {
			$output .= '<ion-icon name="star-outline"></ion-icon>';
		}
	}

	return $output;
}

function averageStarRating($reviews) {
	$sumRating = 0;

	for ($i = sizeof($reviews); $i > 0; $i--) {
		$sumRating += $reviews[sizeof($reviews)-$i]['rating'];
	}

	return $sumRating/sizeof($reviews);
}

// ...
// function esc($str){
//     return nl2br(htmlspecialchars($str));
// }