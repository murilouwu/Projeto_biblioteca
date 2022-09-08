<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/css2.css">
	<link rel="shortcut icon" href="imgs/itens/Title.png">
	<title>Recuperar Senha</title>
</head>
<body>
	<h1 style="color: rgb(253 253 253);z-index: 1;font-size: 5vh;margin-top: 26vh;width: 71vw;text-align: center;background-color: var(--thema);border-radius: 23px;padding: 2vh;">
		Espere amigo estamos fazendo essa parte ainda
	</h1>
	<img src="https://pbs.twimg.com/media/EZDRMTMXQAAi2wW.jpg" style="margin-top: -21vh; height: 55vh; border-radius: 18px; box-shadow: 5px 9px 11px rgb(21 14 28);">
   	<div style="display: none;">
		<a href="index.php" class="return"><img src="imgs/itens/Title.png"></a>
		<div class="espaso">
			<img src="imgs/itens/logo.png" class="logo">
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
	</div>
</body>
</html>