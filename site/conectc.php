<?php
	/*$server = 'localhost:3306';
    $user = 'leizveoc@localhost';
    $pass = 'senha@forte';
    $bd = 'leizveoc_biblioteca';*/
	$server = 'localhost';
    $user = 'root';
    $pass = '';
    $bd = 'biblioteca';
    $con =  new Mysqli($server, $user, $pass, $bd);
    if(!$con){
		echo "<script>alert('Erro na conexão');".$con->error;
	}
	
	//adiministração de usuarios
		//listar users
		function listUser($cd){
			$retorno = null;
	    	if($cd !== null){
	    		$sql = 'SELECT * FROM usuario WHERE cd = '.$cd;
		    	$res = $GLOBALS['con']->query($sql);
		    	if($res->num_rows > 0){
		    		$retorno = $res->fetch_object();
		    	};
	    	}else{
	    		$sql0 = 'SELECT COUNT(cd) AS vl FROM usuario';
	    		$res0 = $GLOBALS['con']->query($sql0);
	    		$chave = $res0->fetch_object()->vl;
	    		if ($chave > 0){
	    			$cont = 0;
		    		for($i=0; $i>-1; $i++){
		    			$sql='SELECT * FROM usuario WHERE cd='.$i;
		    			$res = $GLOBALS['con']->query($sql);
		    			if ($res->num_rows>0){
		    				$retorno[$cont] = $res->fetch_object();
		    				$cont = $cont+1;
		    				if(count($retorno) == $chave){
		    					break;
		    				}
		    			}
		    		}	
	    		};
	    	};
	    	return $retorno;
		}
		
		//tornar um usuario adm
	    function addAdm($cd, $adm){
	    	$sql = 'UPDATE usuario SET adm = '.$adm.', status = "ADM" WHERE cd = '.$cd;
	    	$res = $GLOBALS['con']->query($sql);
	    	if(!$res){
	    		echo "<script>alert('Erro a ADMificar user');</script>";
	        }
	    }

		//criar usuario
	    function addUser($rm, $nome, $email, $dt_nascimento, $genero, $telefone, $senha){
	    	$sql = 'INSERT INTO usuario (rm, nome, email, dt_nascimento, genero, telefone, senha, bio, status, adm, img) VALUES ('.$rm.', "'.$nome.'", "'.$email.'", "'.$dt_nascimento.'", "'.$genero.'", "'.$telefone.'", "'.$senha.'", "...", "novato", 0, "imgs/itens/user.png")';
	    	$res = $GLOBALS['con']->query($sql);
	    	if(!$res){
	    		echo "<script>alert('Erro a Cadastrar');</script>";
	        };
	    }
	    
	    //excluir usuario
	    function deleteUser($cd){
	    	$sql = 'DELETE FROM usuario WHERE cd = '.$cd;
	    	$res = $GLOBALS['con']->query($sql);
	    	if(!$res){
	    		echo "<script>alert('Erro ao Excluir');</script>";
	        }
	    }

	    //atulizar informações do usuario
	    function updateUser($cd, $nome, $email, $dt_nascimento, $genero, $telefone, $senha, $bio, $status, $img){
	    	$sql = 'UPDATE usuario SET nome = "'.$nome.'", email = "'.$email.'", dt_nascimento = "'.$dt_nascimento.'", genero = "'.$genero.'", telefone = "'.$telefone.'", senha = "'.$senha.'", bio = "'.$bio.'", status = "'.$status.'", img='.$img.' WHERE cd = '.$cd;
	    	$res = $GLOBALS['con']->query($sql);
	    	if(!$res){
	    		echo "<script>alert('Erro a Atualizar');</script>";
	        }
	    }

	   	//logar
	    function Login($email, $senha, $retorno, $tipo){
	    	$sql = 'SELECT * FROM usuario WHERE email = "'.$email.'" AND senha="'.$senha.'"';
	    	$res = $GLOBALS['con']->query($sql);
	    	if($res->num_rows > 0){
	    		$retorno['erro'] = false;
	    		$retorno['dados'] = $res->fetch_object();
	    	}else{
	    		$retorno['erro'] = true;
	    	}
	    	if($tipo == "jason"){
	    		return jason_encode($retorno);
	    	}else{
	    		return $retorno;
	    	}
	    }

	    //atualizar foto
		function TrocarFoto($cd, $link){
	    	$sql = 'UPDATE usuario SET img = "'.$link.'" WHERE cd = '.$cd;
	    	$res = $GLOBALS['con']->query($sql);

	    	if(!$res){
	    		echo "<script>alert('Erro a trocar foto');</script>";
	        }
		}

	//adicionar items
		//adicionar genero
	    function addGenero($nome){
	    	$sql = 'INSERT INTO genero (nome) VALUES ("'.$nome.'")';
	    	$res = $GLOBALS['con']->query($sql);
	    	if(!$res){
	    		echo '<script>alert("erro");</script>';
	    	};
	    }

	    //adicionar autor
	    function addAutor($nome, $img){
        	$sql = 'INSERT INTO autor (nome, img) VALUES ("'.$nome.'", "'.$img.'")';
	    	$res = $GLOBALS['con']->query($sql);
	    	if(!$res){
	    		echo '<script>alert("erro");</script>';
	    	};
	    }

	    //adicionar editora
	    function addEditora($nome){
        	$sql = 'INSERT INTO editora (nome) VALUES ("'.$nome.'")';
	    	$res = $GLOBALS['con']->query($sql);
	    	if(!$res){
	    		echo '<script>alert("erro");</script>';
	    	};
	    }

		//criar livro
		function addLivro($nome, $ano, $qtd, $sinopse, $id_editora, $id_genero, $capa){
			$sql0 = 'SELECT COUNT(cd) AS vl FROM livro';
			$res0 = $GLOBALS['con']->query($sql); 
			$rank = $res0->fetch_object()->vl;

        	$sql = 'INSERT INTO livro (nota, titulo, ano, qtd, sinopse, capa, rank, leitores, id_editora, id_genero) VALUES (0, "'.$nome.'", '.$ano.', '.$qtd.', "'.$sinopse.'", "'.$capa.'", '.$cd.', '.$rank.', '.$id_editora.', '.$id_genero.')';
	    	$res = $GLOBALS['con']->query($sql);
	    	if(!$res){
	    		echo '<script>alert("erro");</script>';
	    	};
		}

		//criar autoria de um livro
		function addAutoria($livro, $autor){
	    	$sql = 'INSERT INTO autor_livro (id_autor, id_livro) VALUES ('.$autor.', '.$livro.')';
	    	$res = $GLOBALS['con']->query($sql);
	    	if(!$res){
	    		echo '<script>alert("erro");</script>';
	    	};
		}
	
	//excluir items
	    //excluir genero
	    function deleteGenero($cd){
	    	$sql0 = 'SELECT * FROM livro WHERE id_editora ='.$cd;
	    	$res0 = $GLOBALS['con']->query($sql);
	    	if ($res0){
	    		$sq = 'UPDATE autor_livro SET id_editora = 0 WHERE id_editora ='.$cd;
	    		$rs = $GLOBALS['con']->query($sql);
	    		if (!$rs){
	    			echo '<script>alert("erro");</script>';	
	    		}
	    	}

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
	    	$sql0 = 'SELECT * FROM autor_livro WHERE id_autor ='.$cd;
	    	$res0 = $GLOBALS['con']->query($sql);
	    	if ($res0){
	    		$sq = 'DELETE FROM autor_livro WHERE id_autor ='.$cd;
	    		$rs = $GLOBALS['con']->query($sql);
	    		if (!$rs){
	    			echo '<script>alert("erro");</script>';	
	    		}
	    	}

	    	$sql = 'DELETE FROM autor WHERE cd='.$cd;
	    	$res = $GLOBALS['con']->query($sql);
	    	if($res){
	    		echo '<script>alert("sucesso");</script>';
	    	}else{
	    		echo '<script>alert("erro");</script>';
	    	};
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
	
	//update items
	    //autor
	    //editora
	    //livro
	    //autoria
	
	//listar items
	    //listar autores
	    function listAutor($nome){
	    	$retorno = null;
	    	if($nome !== null){
	    		$sql = 'SELECT * FROM autor WHERE nome = "'.$nome.'"';
		    	$res = $GLOBALS['con']->query($sql);
		    	if($res->num_rows > 0){
		    		$retorno = $res->fetch_object();
		    	};
	    	}else{
	    		$sql0 = 'SELECT COUNT(cd) AS vl FROM autor';
		    	$res0 = $GLOBALS['con']->query($sql0);
		    	$chave = $res0->fetch_object()->vl;
		    	if ($chave > 0){
	    			$cont = 0;
		    		for($i=0; $i>-1; $i++){
		    			$sql='SELECT * FROM autor WHERE cd='.$i;
		    			$res = $GLOBALS['con']->query($sql);
		    			if ($res->num_rows>0){
		    				$retorno[$cont] = $res->fetch_object();
		    				$cont = $cont+1;
		    				if(count($retorno) == $chave){
		    					break;
		    				}
		    			}
		    		}
		        };
	    	};
	    	return $retorno;
	    }

	    //listar editora
	    function listEditora($cd){
	    	$retorno = null;
	    	if($cd !== null){
	    		$sql = 'SELECT * FROM editora WHERE cd = "'.$cd.'"';
		    	$res = $GLOBALS['con']->query($sql);
		    	if($res->num_rows > 0){
		    		$retorno = $res->fetch_object();
		    	};
	    	}else{
	    		$sql0 = 'SELECT COUNT(cd) AS vl FROM editora';
		    	$res0 = $GLOBALS['con']->query($sql0);
		    	$chave = $res0->fetch_object()->vl;
		    	if ($chave > 0){
	    			$cont = 0;
		    		for($i=0; $i>-1; $i++){
		    			$sql='SELECT * FROM editora WHERE cd='.$i;
		    			$res = $GLOBALS['con']->query($sql);
		    			if ($res->num_rows>0){
		    				$retorno[$cont] = $res->fetch_object();
		    				$cont = $cont+1;
		    				if(count($retorno) == $chave){
		    					break;
		    				}
		    			}
		    		}
		        };
		    };
	    	return $retorno;
	    }

		//listar genero
	    function listGenero($nome){
	    	$retorno = null;
	    	if($nome !== null){
	    		$sql = 'SELECT * FROM genero WHERE nome = "'.$nome.'"';
		    	$res = $GLOBALS['con']->query($sql);
		    	if($res->num_rows > 0){
		    		$retorno = $res->fetch_object();
		    	};
	    	}else{
	    		$sql0 = 'SELECT COUNT(cd) AS vl from genero';
		    	$res0 = $GLOBALS['con']->query($sql0);
		    	$chave = $res0->fetch_object()->vl;
		    	if ($chave > 0){
	    			$cont = 0;
		    		for($i=0; $i>-1; $i++){
		    			$sql='SELECT * FROM genero WHERE cd='.$i;
		    			$res = $GLOBALS['con']->query($sql);
		    			if ($res->num_rows>0){
		    				$retorno[$cont] = $res->fetch_object();
		    				$cont = $cont+1;
		    				if(count($retorno) == $chave){
		    					break;
		    				}
		    			}
		    		}
		        };
	    	};
	    	return $retorno;
	    }

		//listar livro
	    function listLivro($nome){
	    	$retorno = null;
	    	if($nome !== null){
	    		$sql = 'SELECT * FROM livro WHERE titulo = "'.$nome.'"';
		    	$res = $GLOBALS['con']->query($sql);
		    	if($res->num_rows > 0){
		    		$retorno = $res->fetch_object();
		    	};
	    	}else{
	    		$sql0 = 'SELECT COUNT(cd) AS vl from livro';
		    	$res0 = $GLOBALS['con']->query($sql0);
		    	$chave = $res0->fetch_object()->vl;
		    	if ($chave > 0){
	    			$cont = 0;
	    			for($i=0; $i>-1; $i++){
		    			$sql='SELECT * FROM livro WHERE cd='.$i;
		    			$res = $GLOBALS['con']->query($sql);
		    			if ($res->num_rows>0){
		    				$retorno[$cont] = $res->fetch_object();
		    				$cont = $cont+1;
		    				if(count($retorno) == $chave){
		    					break;
		    				}
		    			}
		    		}
		        };
	    	};
	    	return $retorno;
	    }
	    //autoria autor
	    function listAutoral($cd){
	    	$retorno = null;
	    	if($nome !== null){
	    		$sql = 'SELECT * FROM autor_livro WHERE id_livro = "'.$cd.'"';
		    	$res = $GLOBALS['con']->query($sql);
		    	if($res->num_rows > 0){
		    		$retorno = $res->fetch_object();
		    	};
	    	}else{
	    		$sql0 = 'SELECT COUNT(cd) AS vl from autor_livro';
		    	$res0 = $GLOBALS['con']->query($sql0);
		    	$chave = $res0->fetch_object()->vl;
		    	if ($chave > 0){
	    			$cont = 0;
	    			for($i=0; $i>-1; $i++){
		    			$sql='SELECT * FROM autor_livro WHERE id_livro='.$i;
		    			$res = $GLOBALS['con']->query($sql);
		    			if ($res->num_rows>0){
		    				$retorno[$cont] = $res->fetch_object();
		    				$cont = $cont+1;
		    				if(count($retorno) == $chave){
		    					break;
		    				}
		    			}
		    		}
		        };
	    	};
	    	return $retorno;
	    }
	
	//função extras
	    //mudar de pagina
	    function mover($page)
	    {

	    	echo '<script> window.location = "'.$page.'" </script>';
	    }
	 	//sexo definicion
	 	function sexo($vl){
	 		if($vl==='H'){
	 			return 'Homen';
	 		}else{
	 			return 'Mulher';
	 		};
	 	}
	 	//verificar link
	 	function linkExe($url) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
        
            return ($code == 200);
        }
        //verificar se é imagem
        function verImg($imgLink){
            $ext = substr($imgLink, -3);
            if($ext == "png" || $ext == "jpg" || $ext == "gif"){
                return true;
            }else{ return false; }
        }
?>