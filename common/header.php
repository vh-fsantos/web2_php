<!DOCTYPE HTML>

<html lang=pt-br>

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
	
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
			<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
			<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</head>

<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="/">Quizzes.com</a>
			<div id="navbarNav">
				<ul class="navbar-nav ml-auto" style="display: flex;
    flex-direction: row;
    gap: 10px;">
					<?php
						include_once "common.php";

						if (is_session_started() === FALSE) 
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
							echo '<a class="nav-link" href="/respondents/new.php">Cadastro</a>';
							echo '</li>';
						}
					?>
				</ul>
			</div>
		</nav>
	</header>
	<div class="container-fluid">
    	<div class="row">
        	<?php include_once("sidebar.php") ?>
        	<div class="col-md-9">