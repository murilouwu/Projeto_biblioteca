<?php
	$server = 'localhost';
	//$porta = '3306'
    $user = 'root';
    $pass = '';
    $bd = 'biblioteca';
    $con =  new Mysqli($server, $user, $pass, $bd);
    //verificar exitencia do banco
    if(!$con){

		echo "Erro na conexão".$con->error;
	}
	
	//adiministração de usuarios
		//tornar um usuario adm
	    function addAdm($rm){
	    	//var atualizar sql
	    	$sql = 'UPDATE usuario SET adm = '.$adm.' WHERE rm = '.$rm;
	    	
	    	//enviar para o banco
	    	$res = $GLOBALS['conn']->query($sql);

	    	//verificar erro
	    	if(!$res){
	    		echo "<script>alert('Erro a ADMificar user');</script>";
	        }
	    }

		//criar usuario
	    function addUser($rm, $nome, $email, $dt_nascimento, $genero, $telefone, $senha){
	        //variavel para inserir dados usuario
	    	$sql = 'INSERT INTO usuario (rm, nome, email, dt_nascimento, genero, telefone, senha, bio, status, adm) VALUES ('.$rm.', "'.$nome.'", "'.$email.'", "'.$dt_nascimento.'", "'.$genero.'", "'.$telefone.'", "'.$senha.'", "...", "basico", false)';
	        
	        //usar banco
	    	$res = $GLOBALS['con']->query($sql);
	    	
	    	//verificar se deu erro
	    	if(!$res){
	    		echo "<script>alert('Erro a Cadastrar');</script>";
	        };
	    }
	    
	    //excluir usuario
	    function deleteUser($rm){
	    	//delete user e rm
	    	$sql = 'DELETE FROM usuario WHERE rm = '.$rm;
	    	$res = $GLOBALS['con']->query($sql);
	    	
	    	//verificar se deu erro
	    	if(!$res){
	    		echo "<script>alert('Erro ao Excluir');</script>";
	        }
	    }

	    //atulizar informações do usuario
	    function updateUser($rm, $nome, $email, $dt_nascimento, $genero, $telefone, $senha, $bio, $status, $adm){
	    	//var atualizar sql
	    	$sql = 'UPDATE usuario SET nome = "'.$nome.'", email = "'.$email.'", dt_nascimento = "'.$dt_nascimento.'", genero = "'.$genero.'", telefone = "'.$telefone.'", senha = "'.$senha.'", bio = "'.$bio.'", status = "'.$status.'", adm = '.$adm.' WHERE rm = '.$rm;
	    	
	    	//enviar para o banco
	    	$res = $GLOBALS['con']->query($sql);

	    	//verificar erro
	    	if(!$res){
	    		echo "<script>alert('Erro a Atualizar');</script>";
	        }
	    }

	   	//logar
	    function Login($nome, $senha, $retorno, $tipo){
	    	//var para verificar exitencia do user
	    	$sql = 'SELECT * FROM usuario WHERE email = "'.$email.'" AND senha="'.$senha.'"';
	    	//enviar para o banco
	    	$res = $GLOBALS['con']->query($sql);
	    	//confirir se deu erro
	    	if($res->num_roms > 0){
	    		//não deu erro
	    		$retorno['erro'] = false;
	    		//user obj
	    		$user = $res-fecth_object();
	    		//retornar user
	    		$retorno['dados'] = $user;
	    	}else{
	    		//deu erro
	    		$retorno['erro'] = true;
	    	}
	    	//verificar se quem está logando no app ou no site
	    	if($tipo == "jason"){
	    		//pelo app
	    		return jason_encode($retorno);
	    	}else{
	    		//pelo site
	    		return $retorno;
	    	}
	    }

	    //atualizar foto
		function TrocarFoto($rm,$foto){
			//destino da imagem
			$destino = 'imgs/users/'.$rm;
			//verificar se enviou
			if (move_uploaded_file($foto['tmp_name'], $destino)){ 
			    echo "<script>alert('Imagem enviada');</script>"; 
			} 
			else { 
			    //não enviou
			    echo "<script>alert('Imagem não pode ser enviada');</script>"; 
			} 
		}

	//adicionar items
		//adicionar genero
	    function addGenero($nome){
	    	$sql = 'INSERT INTO genero (nome) VALUES ("'.$nome.'")';
	    	$res = $GLOBALS['con']->query($sql);
	    	if($res){
	    		echo '<script>alert("sucesso");</script>';
	    	}else{
	    		echo '<script>alert("erro");</script>';
	    	};
	    }
	    //adicionar autor
	    function addAutor($nome){
	    	$sql = 'INSERT INTO autor (nome) VALUES ("'.$nome.'")';
	    	$res = $GLOBALS['con']->query($sql);
	    	if($res){
	    		echo '<script>alert("sucesso");</script>';
	    	}else{
	    		echo '<script>alert("erro");</script>';
	    	};
	    }
	    //adicionar editora
	    function addEditora($nome){
	    	$sql = 'INSERT INTO editora (nome) VALUES ("'.$nome.'")';
	    	$res = $GLOBALS['con']->query($sql);
	    	if($res){
	    		echo '<script>alert("sucesso");</script>';
	    	}else{
	    		echo '<script>alert("erro");</script>';
	    	};
	    }
	//excluir items
	    //excluir genero
	    function deleteGenero($cd){
	    	$sql = 'DELETE FROM genero WHERE cd='.$cd;
	    	$res = $GLOBALS['con']->query($sql);
	    	if($res){
	    		echo '<script>alert("sucesso");</script>';
	    	}else{
	    		echo '<script>alert("erro");</script>';
	    	};	
	    }
	    //excluir autor
	    function deleteAutor($cd){
	    	$sql = 'DELETE FROM genero WHERE cd='.$cd;
	    	$res = $GLOBALS['con']->query($sql);
	    	if($res){
	    		echo '<script>alert("sucesso");</script>';
	    	}else{
	    		echo '<script>alert("erro");</script>';
	    	};	
	    }
	    //excluir editora
	    function deleteEditora($cd){
	    	$sql = 'DELETE FROM genero WHERE cd='.$cd;
	    	$res = $GLOBALS['con']->query($sql);
	    	if($res){
	    		echo '<script>alert("sucesso");</script>';
	    	}else{
	    		echo '<script>alert("erro");</script>';
	    	};	
	    }

	//função para data
	function dataAtual($fun)
 	{
 		if ($fun === 0) {
 			$data = date('d-m-Y');
 			echo $data;
 		}else{
 			$data = date('d-m');
 			$ano = date('Y');
 			$anoCalc = $ano - 70;
 			$res = $data."-".$anoCalc;
 			echo $res;
 		}
 	}
?>