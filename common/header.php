<!DOCTYPE HTML>

<html lang=pt-br>

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="/">Meu Site</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ml-auto">
					<?php
						include_once "common.php";

						if (is_session_started() === FALSE ) 
						session_start();

						if(isset($_SESSION['username'])) {
							echo '<li class="nav-item active">';
							echo '<a class="nav-link">Bem-vindo, ' . $_SESSION['username'] . '</a>';
							echo '</li>';
							echo '<li class="nav-item">';
							echo '<a class="nav-link" href="/login/logout.php">Logout</a>';
							echo '</li>';
						} else {
							echo '<li class="nav-item">';
							echo '<a class="nav-link" href="/login/">Login</a>';
							echo '</li>';
							echo '<li class="nav-item">';
							echo '<a class="nav-link" href="/respondents/">Cadastro</a>';
							echo '</li>';
						}
					?>
				</ul>
			</div>
		</nav>
	</header>