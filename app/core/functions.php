<?php


function show($stuff)
{
	echo "<pre>";
	print_r($stuff);
	echo "</pre>";
}

function set_value($field)
{
	if(isset($_POST[$field]))
	{
		echo $_POST[$field];
	}

	return '';
}