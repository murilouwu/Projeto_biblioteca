<?php
	$server = 'localhost';
    $user = '';
    $pass = '';
    $bd = '';
    $con =  new Mysqli($server, $user, $pass, $bd);
    if(!$con){
		echo "Erro na conexão".$con->error;
	}

    function addADM($rm, $nome, $email, $dt_nascimento, $genero, $telefone, $senha, $adm){
        //inserir dados usuario
    	$sql = 'INSERT INTO usuario (rm, nome, email, dt_nascimento, genero, telefone, senha, adm) 
        VALUES ('.$rm.', "'.$nome.'", "'.$email.'", "'.$dt_nascimento.'", "'.$genero.'", "'.$telefone.'", "'.$senha.'", '.$adm.')';
    	
        $destino = 'imgs/perfisImgs/';
    	 
    	$sql = 'INSERT INTO usuario WHERE rm = '.$rm;
    	$res = $GLOBALS['conn']->query($sql);
    	if($res){
    		echo "excluindo com sucesso";
        }
    	else{
    		echo "Erro a excluir";
        }
    }
    function excluirADM($rm){
    	$sql = 'INSERT INTO usuario WHERE rm = '.$rm;
    	$res = $GLOBALS['conn']->query($sql);
    	if($res){
    		echo "excluindo com sucesso";
        }
    	else{
    		echo "Erro a excluir";
        }
    }
    function AtualizarUsuario($rm,$nome,$nasc,$gen,$tel){
    	$sql = 'UPDATE usuario SET nome= "'.$nome.'"",
    			dt_nascimento = "'.$nasc.'", genero = "'.$gen.'",
    			telefone = "'.$tel.'" WHERE rm =' .$rm ; ]
    	$res = $GLOBALS['conn']->query($sql);
    	if($res){
    		echo "Atualizado com sucesso";
        }
    	else{
    		echo "Erro ao atualizar";
        }
    }
    function Login($nome, $senha, $retorno){
    	$sql = 'SELECT * FROM usuario WHERE email = "'.$email.'" AND senha="'.$senha.'"';
    	$res = $GLOBALS['conn']->query($sql);
    	if($res->num_roms > 0){
    		$retorno['erro'] = false;
    		$user = $res-fecth_object();
    		$retorno['dados'] = $user;
    	}else{
    		$retorno['erro'] = true;
    	}
    	if($tipo == "jason"){
    		return jason_encode($retorno);
    	}else{
    		return $retorno;
    	}
    }
	function TrocarFoto($rm,$foto){
		$destino = 'usuario/fotos/'.$rm.'/'.$foto['name'];
		if(move_uploaded_file($foto['tmp_name'], $destino))
			$sql = 'SELECT * FROM usuario WHERE rm = '.$rm;
			$sql = $GLOBALS['conn']->query($sql);
			$user = $res->fetch_array();
			unlink($user['perfil']);
			$sql = 'UPDATE usuario SET perfil = "'.$destino.'" WHERE rm = '.$rm;
			$res = $GLOBALS['coon']->query($sql);
			if($res){
				echo "Atualizado com sucesso"
			else
				echo "erro ao atualizar foto"
			}
		}
	}
	function TrocarSenha($rm){
		$nova_senha = "",
		$sql = 'SELECT * FROM usuario WHERE rm = '.$rm;
		$res = $GLOBALS['conn']->query($sql);
		$user = $res->fetch_array();
		if(mail($user['email'],"Biblioteca [Nova senha]",$msg)){
			$sql = 'UPDATE usuario SET senha = "'.$nova_senha.
    	}
    }
    function CadastrarGenero($nome){
    	$sql = 'INSERT INTO genero VALUES(null, "'.$nome.'")';
    	$res = $GLOBALS['conn']->query($sql);
    	if($res){
    		echo 'Gênero cadastrado';
    	}else{
    		echo 'Erro ao Cadastrar';
    	}
    }
    function excluirGenero($nome){
    	$sql = 'DELETE fROM genero WHERE cd=""';
    	$res = $GLOBALS['conn']->query($sql);
    	if($res){
    		echo 'Gênero cadastrado';
    	}else{
    		echo 'Erro ao Cadastrar';
    	}	
    }
?>