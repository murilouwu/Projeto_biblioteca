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
				<input type="email" name="email" placeholder="Digite seu email">
				<input type="password" name="senha" placeholder="Digite sua senha">
				<a href="RecuperarSenha.php">Esqueceu a senha</a>
				<input type="submit" name="env001" placeholder="Digite seu Nome" value="Einloggen">
			</form>
			<button id="bntAba" onclick="mostrar(['#formA','#bntAba','#formB','#bnt1Aba'], 2)">Não tem conta, crie uma agora</button>
			<form id="formB" method="post" class="singup">
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
	</body>
</html>
<?php
	//logar
	if(isset($_POST['env001'])){
		//pegar valor dos inputs
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		//var para receber dados
		$retorno = array(
			'erro'=> false,
			'dados' => array()
		);
		//de onde está pegando dados
		$tipo = 'web';
		//pegar dados
		$_SESSION['user'] = Login($email, $senha, $retorno, $tipo);
		//verificar se a conta exite
		if ($_SESSION['user']['erro'] === false){
			//var da decisão
			$dec = $_SESSION['user']['dados']->adm;
			//verificar se a conta é de um adm
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
		//pegar dados
		$rm = $_POST['rm'];
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$dt_nascimento = $_POST['nacimento'];
		$genero = $_POST['genero'];
		$telefone = $_POST['telefone'];
		$senha = $_POST['senha'];
		//enviar
		addUser($rm, $nome, $email, $dt_nascimento, $genero, $telefone, $senha);
	}
?>