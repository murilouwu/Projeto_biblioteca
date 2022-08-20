<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/Menu.css">
	<link rel="shortcut icon" href="imgs/Title.png">
	<title>Home</title>
</head>
<body>
	<header>
		<img src="imgs/Largato.png">
		<a href="#">Meine Liste</a>
		<a href="#">Bucher</a>
		<a href="#">Sammlungen</a>
		<button onclick="drop(this, '#barraSearch', 0)"></button>
		<input id="barraSearch" type="text">
		<img src="imgs/Largato.png" class="perfil" onclick="drop(this, '#editarUsuer', 0)">
	</header>
	<main>
		<form id="editarUsuer" method="get" class="formImage" enctype="multipart/form-data">
			<input type="number" name="rm" placeholder="Digite seu Rm">
			<input type="text" name="nome" placeholder="Digite seu Nome">
			<input type="email" name="email" placeholder="Digite seu Email">
			<input type="password" name="senha" placeholder="Digite sua Senha">
			<select name="genero">
				<option value="H">Homen</option>
				<option value="F">Mulher</option>
			</select>
			<label for="fotoenviar">Trocar imagem de perfil</label>
			<input id="fotoenviar" type="file" name="img" accept="image/png, image/jpeg">
			<input type="submit" name="env001" value="Alterar">
		</form>
		<div class="slide">
			<div class="bigcard">
				<div class="text">
					aaaa
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