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
		//listar users
		function listUser($cd){
			$retorno = null;
	    	if($cd !== null){
	    		$sql = 'SELECT * FROM usuario WHERE cd = '.$cd;
		    	//enviar para o banco
		    	$res = $GLOBALS['con']->query($sql);
		    	//confirir se deu erro
		    	if($res->num_rows > 0){
		    		//retornar user
		    		$retorno = $res->fetch_object();;
		    	};
	    	}else{
	    		//quantos autores tem
	    		$sql = 'SELECT COUNT(cd) AS vl from usuario';
		    	//enviar para o banco
		    	$res = $GLOBALS['con']->query($sql);
		    	//confirir se deu erro
		    	if ($res){
		    		$retorno = array();
		        	//amarzenado valor
		        	$valores = $res->fetch_object();
		        	//criando o chave para o loop
		        	$chave = $valores->vl;
			        //loop de items
			        for ($i=0; $i<$chave; $i++) { 
			        	//cd
			        	$cd = $i+1;
				    	$sql = 'SELECT * FROM usuario WHERE cd = '.$cd;
				    	//enviar para o banco
				    	$res = $GLOBALS['con']->query($sql);

				    	//confirir se deu erro
				    	if($res->num_rows > 0){
				    		//retornar user
				    		$retorno[$i] = $res->fetch_object();;
				    	}else{
				    		//deu erro
				    		echo "<script>alert('Erro');</script>";
				    	}
			        }
		        }else{
		    		echo "<script>alert('Erro');</script>";
		        };
	    	};
	    	return $retorno;
		}
		
		//tornar um usuario adm
	    function addAdm($cd, $adm){
	    	//var atualizar sql
	    	$sql = 'UPDATE usuario SET adm = '.$adm.', status = "ADM" WHERE cd = '.$cd;
	    	
	    	//enviar para o banco
	    	$res = $GLOBALS['con']->query($sql);

	    	//verificar erro
	    	if(!$res){
	    		echo "<script>alert('Erro a ADMificar user');</script>";
	        }
	    }

		//criar usuario
	    function addUser($rm, $nome, $email, $dt_nascimento, $genero, $telefone, $senha){
	        for ($i=1; $i>0; $i++){
	        	//ver quantos users há
		        $sql = 'SELECT * FROM usuario WHERE cd ='.$i;
		        //pesquisar no banco
		        $res = $GLOBALS['con']->query($sql);
		        //verificar se deu erro
		        if ($res){
		        	//amarzenado valor
		        	$valores = $res->fetch_object();
		        	//criando o cd perfeito
		        	$cd = $valores->vl + 1;
			        //variavel para inserir dados usuario
			    	$sql = 'INSERT INTO usuario (cd, rm, nome, email, dt_nascimento, genero, telefone, senha, bio, status, adm) VALUES ('.$cd.','.$rm.', "'.$nome.'", "'.$email.'", "'.$dt_nascimento.'", "'.$genero.'", "'.$telefone.'", "'.$senha.'", "...", "novato", 0)';
			        
			        //usar banco
			    	$res = $GLOBALS['con']->query($sql);
			    	
			    	//verificar se deu erro
			    	if($res){
			    		//criar imagem de perfil inicial
			    		copy('imgs/user/base.png', 'imgs/user/'.$cd.'.png');
			    	}else{
			    		echo "<script>alert('Erro a Cadastrar');</script>";
			        };
		        }else{
		    		echo "<script>alert('Erro');</script>";
		        }; 
	        }
	    }
	    
	    //excluir usuario
	    function deleteUser($cd){
	    	//delete user
	    	$sql = 'DELETE FROM usuario WHERE cd = '.$cd;
	    	$res = $GLOBALS['con']->query($sql);
	    	
	    	//verificar se deu erro
	    	if(!$res){
	    		echo "<script>alert('Erro ao Excluir');</script>";
	        }
	        $img = "imgs/user/".$cd.".png";
	        unlink($img); 
	    }

	    //atulizar informações do usuario
	    function updateUser($cd, $nome, $email, $dt_nascimento, $genero, $telefone, $senha, $bio, $status, $adm){
	    	//var atualizar sql
	    	$sql = 'UPDATE usuario SET nome = "'.$nome.'", email = "'.$email.'", dt_nascimento = "'.$dt_nascimento.'", genero = "'.$genero.'", telefone = "'.$telefone.'", senha = "'.$senha.'", bio = "'.$bio.'", status = "'.$status.'", adm = '.$adm.' WHERE cd = '.$cd;
	    	
	    	//enviar para o banco
	    	$res = $GLOBALS['con']->query($sql);

	    	//verificar erro
	    	if(!$res){
	    		echo "<script>alert('Erro a Atualizar');</script>";
	        }
	    }

	   	//logar
	    function Login($email, $senha, $retorno, $tipo){
	    	//var para verificar exitencia do user
	    	$sql = 'SELECT * FROM usuario WHERE email = "'.$email.'" AND senha="'.$senha.'"';
	    	//enviar para o banco
	    	$res = $GLOBALS['con']->query($sql);
	    	//confirir se deu erro
	    	if($res->num_rows > 0){
	    		//não deu erro
	    		$retorno['erro'] = false;
	    		//retornar user
	    		$retorno['dados'] = $res->fetch_object();
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
		function TrocarFoto($cd, $foto){
			//destino da imagem
			$destino = 'imgs/user/'.$cd;
			//verificar se enviou
			if (move_uploaded_file($foto['tmp_name'], $destino)){ 
			    echo "<script>alert('Imagem enviada');</script>"; 
			} else{ 
			    //não enviou
			    echo "<script>alert('Imagem não pode ser enviada');</script>"; 
			} 
		}

	//adicionar items
		//adicionar genero
	    function addGenero($nome){
	    	//quantos generos tem
    		$sql = 'SELECT COUNT(cd) AS vl from genero';
	    	//enviar para o banco
	    	$res = $GLOBALS['con']->query($sql);
	    	if ($res){
	    		//amarzenado valor
	        	$valores = $res->fetch_object();
	        	//criando o cd perfeito
	        	$cd = $valores->vl + 1;
	        	//var para enviar para o banco
		    	$sql = 'INSERT INTO genero (cd, nome) VALUES ('.$cd.',"'.$nome.'")';
		    	//enviar para o banco
		    	$res = $GLOBALS['con']->query($sql);
		    	//verificando se deu erro
		    	if(!$res){
		    		echo '<script>alert("erro");</script>';
		    	};
		    }else{
		    	echo '<script>alert("erro");</script>';
		    };
	    }

	    //adicionar autor
	    function addAutor($nome){
	    	//quantos autores tem
    		$sql = 'SELECT COUNT(cd) AS vl from autor';
	    	//enviar para o banco
	    	$res = $GLOBALS['con']->query($sql);
	    	if ($res){
	    		//amarzenado valor
	        	$valores = $res->fetch_object();
	        	//criando o cd perfeito
	        	$cd = $valores->vl + 1;
	        	//var para enviar para o banco
		    	$sql = 'INSERT INTO autor (cd, nome) VALUES ('.$cd.',"'.$nome.'")';
		    	//enviar para o banco
		    	$res = $GLOBALS['con']->query($sql);
		    	//verificando se deu erro
		    	if(!$res){
		    		echo '<script>alert("erro");</script>';
		    	};
		    }else{
		    	echo '<script>alert("erro");</script>';
		    };
	    }

	    //adicionar editora
	    function addEditora($nome){
	    	//quantos editoras tem
    		$sql = 'SELECT COUNT(cd) AS vl from editora';
	    	//enviar para o banco
	    	$res = $GLOBALS['con']->query($sql);
	    	if ($res){
	    		//amarzenado valor
	        	$valores = $res->fetch_object();
	        	//criando o cd perfeito
	        	$cd = $valores->vl + 1;
	        	//var para enviar para o banco
		    	$sql = 'INSERT INTO editora (cd, nome) VALUES ('.$cd.',"'.$nome.'")';
		    	//enviar para o banco
		    	$res = $GLOBALS['con']->query($sql);
		    	//verificando se deu erro
		    	if(!$res){
		    		echo '<script>alert("erro");</script>';
		    	};
		    }else{
		    	echo '<script>alert("erro");</script>';
		    };
	    }

		//criar livro
		function addLivro($nome, $ano, $qtd, $sinopse, $id_editora, $id_genero, $capa){
			//quantos livros tem
    		$sql = 'SELECT COUNT(cd) AS vl from livro';
	    	//enviar para o banco
	    	$res = $GLOBALS['con']->query($sql);
	    	if ($res){
	    		//amarzenado valor
	        	$valores = $res->fetch_object();
	        	//criando o cd perfeito
	        	$cd = $valores->vl + 1;
	        	//var para enviar para o banco
		    	$sql = 'INSERT INTO livro (cd, nota, titulo, ano, qtd, sinopse, capa, rank, leitores, id_editora, id_genero) VALUES ('.$cd.', 0, "'.$nome.'", '.$ano.', '.$qtd.', "'.$sinopse.'", "'.$capa.'", '.$cd.', 0, '.$id_editora.', '.$id_genero.')';
		    	//enviar para o banco
		    	$res = $GLOBALS['con']->query($sql);
		    	//verificando se deu erro
		    	if(!$res){
		    		echo '<script>alert("erro");</script>';
		    	};
		    }else{
		    	echo '<script>alert("erro");</script>';
		    };
		}

		//criar autoria de um livro
		function addAutoria($livro, $autor){
	    	$sql = 'INSERT INTO autor_livro (id_autor, id_livro) VALUES ('.$autor.', '.$livro.')';
	    	//enviar para o banco
	    	$res = $GLOBALS['con']->query($sql);
	    	//verificando se deu erro
	    	if(!$res){
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
	    	$sql = 'DELETE FROM autor WHERE cd='.$cd;
	    	$res = $GLOBALS['con']->query($sql);
	    	if($res){
	    		echo '<script>alert("sucesso");</script>';
	    	}else{
	    		echo '<script>alert("erro");</script>';
	    	};
	    	$img = "imgs/autores/".$cd.".png";
	        unlink($img);
	    }
	    //excluir editora
	    function deleteEditora($cd){
	    	$sql = 'DELETE FROM editora WHERE cd='.$cd;
	    	$res = $GLOBALS['con']->query($sql);
	    	if($res){
	    		echo '<script>alert("sucesso");</script>';
	    	}else{
	    		echo '<script>alert("erro");</script>';
	    	};	
	    }
	
	//listar items
	    //listar autores
	    function listAutor($nome){
	    	$retorno = null;
	    	if($nome !== null){
	    		$sql = 'SELECT * FROM autor WHERE nome = "'.$nome.'"';
		    	//enviar para o banco
		    	$res = $GLOBALS['con']->query($sql);
		    	//confirir se deu erro
		    	if($res->num_rows > 0){
		    		//retornar autor
		    		$retorno = $res->fetch_object();
		    	};
	    	}else{
	    		//quantos autores tem
	    		$sql = 'SELECT COUNT(cd) AS vl from autor';
		    	//enviar para o banco
		    	$res = $GLOBALS['con']->query($sql);
		    	//confirir se deu erro
		    	if ($res){
		    		$retorno = array();
		        	//amarzenado valor
		        	$valores = $res->fetch_object();
		        	//criando o chave para o loop
		        	$chave = $valores->vl;
			        //loop de items
			        for ($i=0; $i<$chave; $i++) { 
			        	//cd
			        	$cd = $i+1;
				    	$sql = 'SELECT * FROM autor WHERE cd = '.$cd;
				    	//enviar para o banco
				    	$res = $GLOBALS['con']->query($sql);

				    	//confirir se deu erro
				    	if($res->num_rows > 0){
				    		//retornar user
				    		$retorno[$i] = $res->fetch_object();;
				    	}else{
				    		//deu erro
				    		echo "<script>alert('Erro');</script>";
				    	}
			        }
		        }else{
		    		echo "<script>alert('Erro');</script>";
		        };
	    	};
	    	return $retorno;
	    }

	    //listar editora
	    function listEditora($nome){
	    	$retorno = null;
	    	if($nome !== null){
	    		$sql = 'SELECT * FROM editora WHERE nome = "'.$nome.'"';
		    	//enviar para o banco
		    	$res = $GLOBALS['con']->query($sql);
		    	//confirir se deu erro
		    	if($res->num_rows > 0){
		    		//retornar autor
		    		$retorno = $res->fetch_object();
		    	};
	    	}else{
	    		//quantos autores tem
	    		$sql = 'SELECT COUNT(cd) AS vl from editora';
		    	//enviar para o banco
		    	$res = $GLOBALS['con']->query($sql);
		    	//confirir se deu erro
		    	if ($res){
		    		$retorno = array();
		        	//amarzenado valor
		        	$valores = $res->fetch_object();
		        	//criando o chave para o loop
		        	$chave = $valores->vl;
			        //loop de items
			        for ($i=0; $i<$chave; $i++) { 
			        	//cd
			        	$cd = $i+1;
				    	$sql = 'SELECT * FROM editora WHERE cd = '.$cd;
				    	//enviar para o banco
				    	$res = $GLOBALS['con']->query($sql);

				    	//confirir se deu erro
				    	if($res->num_rows > 0){
				    		//retornar user
				    		$retorno[$i] = $res->fetch_object();;
				    	}else{
				    		//deu erro
				    		echo "<script>alert('Erro');</script>";
				    	}
			        }
		        }else{
		    		echo "<script>alert('Erro');</script>";
		        };
	    	};
	    	return $retorno;
	    }

		//listar genero
	    function listGenero($nome){
	    	$retorno = null;
	    	if($nome !== null){
	    		$sql = 'SELECT * FROM genero WHERE nome = "'.$nome.'"';
		    	//enviar para o banco
		    	$res = $GLOBALS['con']->query($sql);
		    	//confirir se deu erro
		    	if($res->num_rows > 0){
		    		//retornar autor
		    		$retorno = $res->fetch_object();
		    	};
	    	}else{
	    		//quantos autores tem
	    		$sql = 'SELECT COUNT(cd) AS vl from genero';
		    	//enviar para o banco
		    	$res = $GLOBALS['con']->query($sql);
		    	//confirir se deu erro
		    	if ($res){
		    		$retorno = array();
		        	//amarzenado valor
		        	$valores = $res->fetch_object();
		        	//criando o chave para o loop
		        	$chave = $valores->vl;
			        //loop de items
			        for ($i=0; $i<$chave; $i++) { 
			        	//cd
			        	$cd = $i+1;
				    	$sql = 'SELECT * FROM genero WHERE cd = '.$cd;
				    	//enviar para o banco
				    	$res = $GLOBALS['con']->query($sql);

				    	//confirir se deu erro
				    	if($res->num_rows > 0){
				    		//retornar user
				    		$retorno[$i] = $res->fetch_object();;
				    	}else{
				    		//deu erro
				    		echo "<script>alert('Erro');</script>";
				    	}
			        }
		        }else{
		    		echo "<script>alert('Erro');</script>";
		        };
	    	};
	    	return $retorno;
	    }

		//listar livro
	    function listLivro($nome){
	    	$retorno = null;
	    	if($nome !== null){
	    		$sql = 'SELECT * FROM livro WHERE titulo = "'.$nome.'"';
		    	//enviar para o banco
		    	$res = $GLOBALS['con']->query($sql);
		    	//confirir se deu erro
		    	if($res->num_rows > 0){
		    		//retornar autor
		    		$retorno = $res->fetch_object();
		    	};
	    	}else{
	    		//quantos autores tem
	    		$sql = 'SELECT COUNT(cd) AS vl from livro';
		    	//enviar para o banco
		    	$res = $GLOBALS['con']->query($sql);
		    	//confirir se deu erro
		    	if ($res){
		    		$retorno = array();
		        	//amarzenado valor
		        	$valores = $res->fetch_object();
		        	//criando o chave para o loop
		        	$chave = $valores->vl;
			        //loop de items
			        for ($i=0; $i<$chave; $i++) { 
			        	//cd
			        	$cd = $i+1;
				    	$sql = 'SELECT * FROM livro WHERE cd = '.$cd;
				    	//enviar para o banco
				    	$res = $GLOBALS['con']->query($sql);

				    	//confirir se deu erro
				    	if($res->num_rows > 0){
				    		//retornar user
				    		$retorno[$i] = $res->fetch_object();;
				    	}else{
				    		//deu erro
				    		echo "<script>alert('Erro');</script>";
				    	}
			        }
		        }else{
		    		echo "<script>alert('Erro');</script>";
		        };
	    	};
	    	return $retorno;
	    }
	//função extras
	    //mudar de pagina
	    function mover($page)
	    {
	    	//mudar pagina
	    	echo '<script> window.location = "'.$page.'" </script>';
	    }
		//data atualisada
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
	 	//adicionar foto
	 	function addFoto($foto, $local)
	 	{
	 		//mover arquivo
	 		move_uploaded_file($foto['tmp_name'], $local);
	 	}
	 	//sexo definicion
	 	function sexo($vl){
	 		if($vl==='H'){
	 			return 'Homen';
	 		}else{
	 			return 'Mulher';
	 		};
	 	}
?>