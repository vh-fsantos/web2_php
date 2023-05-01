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
		<h1><?=$page_title?></h1>
		<div class="pull-right" id="login_info">
		<?php	
		// include_once "common.php";
		
		// if (is_session_started() === FALSE ) {
		// 	session_start();
		// }	
		
		// if(isset($_SESSION["nome_usuario"])) {
		// 	echo "<span>Você está logado como " . $_SESSION["nome_usuario"];		
		// 	echo "<a href='executa_logout.php'> Logout </a></span>";
		// } else {
		// 	echo "<span><a href='login.php'> Efetuar Login </a></span>";
		// }
		?>	
		</div>
	</header>

