<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/Menu.css">
	<link rel="shortcut icon" href="imgs/Title.png">
	<title>Home</title>
</head>
<body>
	<header>
		<img src="imgs/Largato.png">
		<a href="#">Bucher</a><!--livros-->
		<a href="#">Sammlungen</a><!--Coleção-->
		<a href="#">Profil</a><!--Perfil-->
		<button onclick="drop(this, '#barraSearch', 0)"></button>
		<input id="barraSearch" type="text">
		<img src="imgs/Largato.png" class="perfil" onclick="red('PageUser.php')">
	</header>
	<main>
		<div class="slide">
			<div class="bigcard">
				<div class="text">
					<h1>Titulo</h1>
					<p>Sinopse</p>
					<h6>ano: 2020/ rank: #1/ autor: Felipe Neto/ editora: Pedro Edições</h6>
					<h3>*****</h3>
					<button>Ver Mais</button>
				</div>
				<img src="imgs/logo.png">
			</div>
		</div>
		<div class="espaso">
			<h2>Categoria</h2>
			<div class="listH">
				<div class="card">
					
				</div>
			</div>
		</div>
	</main>
	<script src="java.js"></script>
</body>
</html>