<?php
	include('conectc.php');
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/css.css">
		<link rel="shortcut icon" href="imgs/itens/Title.png">
		<title>Login</title>
	</head>
	<body>
		<div class="espaso">
			<img src="imgs/itens/logo.png" class="logo">
			<form id="formA" method="post" class="login">
				<label>Anmeldung</label>
				<input type="email" name="email" placeholder="Digite seu email" maxlength="120">
				<input type="password" name="senha" placeholder="Digite sua senha" maxlength="20">
				<a href="RecuperarSenha.php">Esqueceu a senha</a>
				<input type="submit" name="env001" placeholder="Digite seu Nome" value="Einloggen">
			</form>
			<button id="bntAba" onclick="mostrar(['#formA','#bntAba','#formB','#bnt1Aba'], 2)">Não tem conta, crie uma agora</button>
			<form id="formB" method="post" class="singup">
				<label>Anmelden</label>
				<input type="number" name="rm" placeholder="Digite seu Rm">
				<input type="text" name="nome" placeholder="Digite seu Nome" maxlength="60">
				<input type="email" name="email" placeholder="Digite seu Email" maxlength="120">
				<input type="password" name="senha" placeholder="Digite sua Senha" maxlength="20">
				<select name="genero">
					<option value="H">Homen</option>
					<option value="F">Mulher</option>
				</select>
				<input type="number" name="telefone" placeholder="Digite seu Telefone" maxlength="45">
				<input type="date" name="nacimento">
				<input type="submit" name="env002" value="Schaffen">
			</form>
			<button id="bnt1Aba" onclick="mostrar(['#formB','#bnt1Aba','#formA','#bntAba'], 2)">Tem conta, Logue agora</button>
		</div>
		<script src="java.js"></script>
	</body>
</html>
<?php
	//logar
	if(isset($_POST['env001'])){
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		$retorno = array(
			'erro'=> false,
			'dados' => array()
		);
		$tipo = 'web';
		$_SESSION['user'] = Login($email, $senha, $retorno, $tipo);
		if ($_SESSION['user']['erro'] === false){
			$dec = $_SESSION['user']['dados']->adm;
			if($dec == 0){
				mover('PageHome.php');	
			}
			else{
				mover('adm.php');
			}
		}else{
			echo "<script>alert('Usuario inesitente ou dados da conta estão erradas');</script>";
		}
	}
	//Criar conta
	if(isset($_POST['env002'])){
		$rm = $_POST['rm'];
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$dt_nascimento = $_POST['nacimento'];
		$genero = $_POST['genero'];
		$telefone = $_POST['telefone'];
		$senha = $_POST['senha'];
		addUser($rm, $nome, $email, $dt_nascimento, $genero, $telefone, $senha);
		mover('index.php');
	}
?>