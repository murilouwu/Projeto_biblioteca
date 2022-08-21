<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/css.css">
	<link rel="shortcut icon" href="imgs/Title.png">
	<title>Login</title>
</head>
<body>
	<div class="espaso">
		<img src="imgs/logo.png" class="logo">
		<form id="formA" method="get" class="login">
			<label>Anmeldung</label>
			<input type="email" name="email" placeholder="Digite seu Nome">
			<input type="password" name="senha" placeholder="Digite seu Nome">
			<a href="RecuperarSenha.php">Esqueseu a senha</a>
			<input type="submit" name="env001" placeholder="Digite seu Nome" value="Einloggen">
		</form>
		<button id="bntAba" onclick="mostrar(['#formA','#bntAba','#formB','#bnt1Aba'], 2)">Não tem conta, crie uma agora</button>
		<form id="formB" method="get" class="singup">
			<label>Anmelden</label>
			<input type="number" name="rm" placeholder="Digite seu Rm">
			<input type="text" name="nome" placeholder="Digite seu Nome">
			<input type="email" name="email" placeholder="Digite seu Email">
			<input type="password" name="senha" placeholder="Digite sua Senha">
			<select name="genero">
				<option value="H">Homen</option>
				<option value="F">Mulher</option>
			</select>
			<input type="number" name="telefone" placeholder="Digite seu Telefone">
			<input type="date" name="nacimento" min="<?php dataAtual(1);?>" max="<?php dataAtual(0);?>">
			<input type="submit" name="env002" value="Schaffen">
		</form>
		<button id="bnt1Aba" onclick="mostrar(['#formB','#bnt1Aba','#formA','#bntAba'], 2)">Tem conta, Logue agora</button>
	</div>
	<script src="java.js"></script>
	<script>
		//carregou a pagina
		window.onload = ()=>{
			//mostrar só um form
			mostrar(['#formB','#bnt1Aba','#formA','#bntAba'], 2);
		}
	</script>
</body>
</html>