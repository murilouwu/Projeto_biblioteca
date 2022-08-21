<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/css2.css">
	<link rel="shortcut icon" href="imgs/Title.png">
	<title>Recuperar Senha</title>
</head>
<body>
	<a href="index.php" class="return"><img src="imgs/Title.png"></a>
	<div class="espaso">
		<img src="imgs/logo.png" class="logo">
		<form method="get">
			<input type="email" name="email" placeholder="Digite o Email linkado com essa conta">
			<input type="submit" name="env" value="Enviar o Codigo">
		</form>
		<h1 id="mensagem">-Enviamos o Codigo para Seu Email, Pegue e digite o codigo abaixo, para recuperar sua senha-</h1>
		<form method="get">
			<input type="password" name="Codigo" placeholder="Digite o Codigo Recebido">
			<input type="submit" name="env" value="Verificar codigo">
		</form>
		<p id="senha">Sua senha é: 00000</p>
	</div>
</body>
</html>