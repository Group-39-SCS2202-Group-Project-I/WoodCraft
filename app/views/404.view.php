<?php

$data['title'] = "404";
		$data['user'] = 'customer';
		$data['url'] = ROOT . '/';
		$data['mzg'] = "Return to Home";

		if (Auth::logged_in()) {
			if (Auth::is_admin()) {
				$data['user'] = 'admin';
				$data['url'] = ROOT . '/admin';
				$data['mzg'] = "Return to Dashboard";
			} else if (Auth::is_osr()) {
				$data['user'] = 'osr';
				$data['url'] = ROOT . '/osr';
				$data['mzg'] = "Return to Dashboard";
			} else if (Auth::is_gm()) {
				$data['user'] = 'gm';
				$data['url'] = ROOT . '/gm';
				$data['mzg'] = "Return to Dashboard";
			}
			else if (Auth::is_pm()) {
				$data['user'] = 'pm';
				$data['url'] = ROOT . '/pm';
				$data['mzg'] = "Return to Dashboard";
			}
			else if (Auth::is_sk()) {
				$data['user'] = 'sk';
				$data['url'] = ROOT . '/sk';
				$data['mzg'] = "Return to Dashboard";
			}
		}

?>
<style>
	* {
		transition: all 0.6s;
	}

	html {
		height: 100%;
	}

	body {
		font-family: 'Lato', sans-serif;
		color: #6D9886;
		margin: 0;
	}

	#main {
		display: table;
		width: 100%;
		height: 100vh;
		text-align: center;
	}

	.fof {
		display: table-cell;
		vertical-align: middle;
	}

	.fof h1 {
		font-size: 50px;
		display: inline-block;
		padding-right: 12px;
		animation: type .5s alternate infinite;
	}

	a{
		text-decoration: none;
		color: #6D9886;
		padding: 10px 20px;
		border-radius: 10px;
		background-color: #f2f2f2;
	}

	a:hover{
		background-color: #6D9886;
		color: #f2f2f2;
	}

	@keyframes type {
		from {
			box-shadow: inset -3px 0px 0px #6D9886;
		}

		to {
			box-shadow: inset -3px 0px 0px transparent;
		}
	}
</style>
<div id="main">
	<div class="fof">
		<h1>Error 404!</h1>
		<br>
		<a href="<?= $data['url'] ?> "> <?= $data['mzg'] ?> </a>
	</div>
</div>