<?php
    session_start();
	$server = 'localhost:3306';
    $user = 'leizveoc_user';
    $pass = 'senha@forte';
    $bd = 'leizveoc_biblioteca';
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
	    	$sql = 'UPDATE usuario SET adm = '.$adm.' WHERE cd = '.$cd;
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
	    function updateUser($cd, $nome, $dt_nascimento, $genero, $telefone, $senha, $bio, $status, $img){
	    	$sql = 'UPDATE usuario SET nome ="'.$nome.'", dt_nascimento ="'.$dt_nascimento.'", genero="'.$genero.'", telefone ="'.$telefone.'", senha ="'.$senha.'", status ="'.$status.'" WHERE cd ='.$cd;
	    	$res = $GLOBALS['con']->query($sql);
	    	if(!$res){
	    		echo "<script>alert('Erro a Atualizar');</script>";
	        }else{
	            $sql1 = 'UPDATE usuario SET bio ="'.$bio.'" WHERE cd ='.$cd;
	            $res1 = $GLOBALS['con']->query($sql1);
	            if(!$res1){
	                echo "<script>alert('Erro a Atualizaar');</script>";
	            }
	            if($img != "0"){
	                TrocarFoto($cd, $img);
	            }
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
			$res0 = $GLOBALS['con']->query($sql0); 
			$rank = $res0->fetch_object()->vl+1;

        	$sql = 'INSERT INTO livro (nota, titulo, ano, qtd, sinopse, capa, rank, leitores, id_editora, id_genero) VALUES (0, "'.$nome.'", '.$ano.', '.$qtd.', "'.$sinopse.'", "'.$capa.'", '.$rank.', 0, '.$id_editora.', '.$id_genero.')';
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
	    		echo '<script>alert("erro2");</script>';
	    	};
		}
		
		//adicionar emprestimo
		function addEmpre($dt_minpegar,$dt_maxpegar,$dt_devolucao,$status,$id_usuario){
	    	$sql = 'INSERT INTO emprestimo(dt_minpegar, dt_maxpegar, dt_devolucao, status, id_usuario) VALUES ("'.$dt_minpegar.'", "'.$dt_maxpegar.'","'.$dt_devolucao.'","criado", '.$id_usuario.')';
	    	$res = $GLOBALS['con']->query($sql);
	    	if(!$res){
	    		echo '<script>alert("erro");</script>';
	    	}else{
	    	    
	    	};
	    }
	    //adicionar livro emprestimo
	    function addEmprePt2($id_livro, $id_emprestimo){
	    	$sql = 'INSERT INTO livro_emprestimo(id_emprestimo, id_livro) VALUES ('.$id_usuario.', '.$id_emprestimo.')';
	    	$res = $GLOBALS['con']->query($sql);
	    	if(!$res){
	    		echo '<script>alert("erro");</script>';
	    	}else{
	    	    
	    	};
	    }
	//excluir items
	    //excluir genero
	    function deleteGenero($cd){
	    	$sql0 = 'SELECT * FROM livro WHERE id_genero = '.$cd;
	        $res0 = $GLOBALS['con']->query($sql0);
	        if ($res0->num_rows > 0){
	            if($res0->num_rows < 2){
	                $pes = $res0->fetch_object()->cd;
	                $sql1 = 'UPDATE livro SET id_genero = 0 WHERE cd ='.$pes;
	                $res1 = $GLOBALS['con']->query($sql1);
	                if($res1){
	                    $sql = 'DELETE FROM genero WHERE cd='.$cd;
                        $res = $GLOBALS['con']->query($sql);
	                    if(!$res){
	                        echo '<script>alert("erro");</script>';   
	                    }
	                }else{
	                    echo '<script>alert("erro");</script>';
	                }
	            }else{
            		while($rows = mysqli_fetch_array($res0)){
            		    $pes = $res0->fetch_object()->cd;
            			$sql1 = 'UPDATE livro SET id_genero = 0, cd = '.$pes;
                        $res1 = $GLOBALS['con']->query($sql1);
            		}
            		$sql = 'DELETE FROM genero WHERE cd='.$cd;
    	    	    $res = $GLOBALS['con']->query($sql);
    	    	    if(!$res){
    	    		    echo '<script>alert("erro");</script>';
    	    	    };
	            }
	        }else{
                $sql = 'DELETE FROM genero WHERE cd='.$cd;
                $res = $GLOBALS['con']->query($sql);
                if(!$res){
                    echo '<script>alert("erro");</script>';
                };  
	        }
	    }
	    //excluir autor
	    function deleteAutor($cd){
	    	$sql0 = 'SELECT * FROM autor_livro WHERE id_autor ='.$cd;
	    	$res0 = $GLOBALS['con']->query($sql0);
	    	if ($res0->num_rows > 0){
	    		if ($res0->num_rows < 2){
	    		    $pes = $res0->fetch_object()->id_livro;
	    		    $sql1 = 'UPDATE autor_livro SET id_autor = 0 WHERE id_livro ='.$pes;
	    		    $res1 = $GLOBALS['con']->query($sql1);
	    		    if($res1){
	    		        $sql = 'DELETE FROM autor WHERE cd='.$cd;
            	    	$res = $GLOBALS['con']->query($sql);
            	    	if(!$res){
            	    		echo '<script>alert("erro");</script>';
            	    	};
	    		    }else{
	    		        echo '<script>alert("erro");</script>';
	    		    }
	    		}else{
	    		    $a = 0;
            		while($rows = mysqli_fetch_array($res0)){
            		    $pes = $res0->fetch_object()->id_autor;
            			$sql1 = 'SELECT * FROM autor_livro WHERE id_autor = '.$pes.', id_livro = '.$a;
                        $res1 = $GLOBALS['con']->query($sql1);
                        
                        if($res1->num_rows > 0){
                            $pes2 = $res1->fetch_object()->id_livro;
                            $sql2 = 'UPDATE autor_livro SET id_autor = 0 WHERE id_livro='.$pes2;
        	    		    $res2 = $GLOBALS['con']->query($sql1);
                        }
                        $a++;
            		}
            		$sql = 'DELETE FROM autor WHERE cd='.$cd;
    	    	    $res = $GLOBALS['con']->query($sql);
    	    	    if(!$res){
    	    		    echo '<script>alert("erro");</script>';
    	    	    };
	    		}
	    	}else{
    	        $sql = 'DELETE FROM autor WHERE cd='.$cd;
	    	    $res = $GLOBALS['con']->query($sql);
	    	    if(!$res){
	    		    echo '<script>alert("erro");</script>';
	    	    };
    	    }
	    }
	    //excluir editora
	    function deleteEditora($cd){
	        $sql0 = 'SELECT * FROM livro WHERE id_editora = '.$cd;
	        $res0 = $GLOBALS['con']->query($sql0);
	        if ($res0->num_rows > 0){
	            if($res0->num_rows < 2){
	                $pes = $res0->fetch_object()->cd;
	                $sql1 = 'UPDATE livro SET id_editora = 0 WHERE cd ='.$pes;
	                $res1 = $GLOBALS['con']->query($sql1);
	                if($res1){
	                    $sql = 'DELETE FROM editora WHERE cd='.$cd;
                        $res = $GLOBALS['con']->query($sql);
	                    if(!$res){
	                        echo '<script>alert("erro");</script>';   
	                    }
	                }else{
	                    echo '<script>alert("erro");</script>';
	                }
	            }else{
            		while($rows = mysqli_fetch_array($res0)){
            		    $pes = $res0->fetch_object()->cd;
            			$sql1 = 'UPDATE livro SET id_editora = 0, cd = '.$pes;
                        $res1 = $GLOBALS['con']->query($sql1);
            		}
            		$sql = 'DELETE FROM editora WHERE cd='.$cd;
    	    	    $res = $GLOBALS['con']->query($sql);
    	    	    if(!$res){
    	    		    echo '<script>alert("erro");</script>';
    	    	    };
	            }
	        }else{
                $sql = 'DELETE FROM editora WHERE cd='.$cd;
                $res = $GLOBALS['con']->query($sql);
                if(!$res){
                    echo '<script>alert("erro");</script>';
                };  
	        }	
	    }
	    //excluir livro
	    function deleteBook($cd){
	    	$sql0 = 'UPDATE autor_livro SET id_autor = null, id_livro = null WHERE id_livro ='.$cd;
	    	$res0 = $GLOBALS['con']->query($sql0);
	    	if ($res0){
    		    $sql1 = 'UPDATE livro SET id_genero = null, id_editora = null WHERE cd ='.$cd;
    		    $res1 = $GLOBALS['con']->query($sql1);
    		    if($res1){
    		        $sql = 'DELETE FROM livro WHERE cd='.$cd;
        	    	$res = $GLOBALS['con']->query($sql);
        	    	if(!$res){
        	    		echo '<script>alert("erro");</script>';
        	    	};
    		    }
	    	}else{
    	        echo '<script>alert("erro");</script>';
    	    }
	    }
	//update items
	    //autor
    	    //foto
    	    function updateAutor($cd, $foto){
    	    	$sql = 'UPDATE autor SET img = "'.$foto.'" WHERE cd = '.$cd;
    	    	$res = $GLOBALS['con']->query($sql);
    	    	if(!$res){
    	    		echo "<script>alert('Erro a mudar a Foto');</script>";
    	        }
    	    }
    	    //nome
    	    function updateAutorN($cd, $nome){
    	        $sql = 'UPDATE autor SET nome = "'.$nome.'" WHERE cd = '.$cd;
    	    	$res = $GLOBALS['con']->query($sql);
    	    	if(!$res){
    	    		echo "<script>alert('Erro a mudar o Nome');</script>";
    	        }
    	    }
	    //editora
	        //nome
	        function updateEdit($cd, $nome){
	            $sql = 'UPDATE editora SET nome = "'.$nome.'" WHERE cd = '.$cd;
    	    	$res = $GLOBALS['con']->query($sql);
    	    	if(!$res){
    	    		echo "<script>alert('Erro a mudar o Nome');</script>";
    	        }
	        }
	    //livro
	        //info
	        function updateBook($cd, $obj){
    	    	$sql = 'UPDATE livro SET titulo ="'.$obj->titulo.'", ano ='.$obj->ano.', qtd ='.$obj->qtd.', id_genero ='.$obj->id_genero.', id_editora ='.$obj->id_editora.' WHERE cd ='.$cd;
    	    	$res = $GLOBALS['con']->query($sql);
    	    	if(!$res){
    	    		echo "<script>alert('Erro');</script>";
    	        }else{
    	            bookSinop($cd, $obj);
    	        }
    	    }
	   //autor
	        function bookAutor($cd, $autor){
	            $sql = 'UPDATE autor_livro SET id_autor ='.$autor.' WHERE id_livro ='.$cd;
    	    	$res = $GLOBALS['con']->query($sql);
    	    	if(!$res){
    	    		echo "<script>alert('Erro');</script>";
    	        }
	        }
	        //foto
	        function bookPhoto($cd, $obj){
	            $sql = 'UPDATE livro SET capa ="'.$obj->capa.'" WHERE cd = '.$cd;
    	    	$res = $GLOBALS['con']->query($sql);
    	    	if(!$res){
    	    		echo "<script>alert('Erro');</script>";
    	        }
	        }
	        //sinopse
	        function bookSinop($cd, $obj){
	            $sql = 'UPDATE livro SET sinopse ="'.$obj->sinopse.'" WHERE cd = '.$cd;
    	    	$res = $GLOBALS['con']->query($sql);
    	    	if(!$res){
    	    		echo "<script>alert('Erro');</script>";
    	        }else{
    	            bookPhoto($cd, $obj);
    	        }
	        }
	    //genero
	        //nome
	        function updateGener($cd, $nome){
	            $sql = 'UPDATE genero SET nome = "'.$nome.'" WHERE cd = '.$cd;
    	    	$res = $GLOBALS['con']->query($sql);
    	    	if(!$res){
    	    		echo "<script>alert('Erro a mudar o Nome');</script>";
    	        }
	        }
    //pesquisar itens
        //por titulo
            function LivroSearchTitle($text){
                $sql = 'SELECT cd FROM livro WHERE titulo like "%'.$text.'%";';
                $res = $GLOBALS['con']->query($sql);
                if($res->num_rows > 0){
                	if ($res->num_rows < 2){
                		$val = $res->fetch_object();
                		$result[0] = $val->cd;
                	}else{
                		$a = 0;
                		while($rows = mysqli_fetch_array($res)){
                			$result[$a] = $rows['cd'];
                			$a++;
                		}
                	}
                }else{
                	$result[0] = "ERRO";
                };
                return $result;
            }
        //sinopse
            function LivroSearchSinop($text){
                $sql = 'SELECT cd FROM livro WHERE sinopse like "%'.$text.'%";';
                $res = $GLOBALS['con']->query($sql);
                if($res->num_rows > 0){
                	if ($res->num_rows < 2){
                		$val = $res->fetch_object();
                		$result[0] = $val->cd;
                	}else{
                		$a = 0;
                		while($rows = mysqli_fetch_array($res)){
                			$result[$a] = $rows['cd'];
                			$a++;
                		}
                	}
                }else{
                	$result[0] = "ERRO";
                };
                return $result;
            }
        //categoria
            function LivroSearchCate($text){
                $sql = 'SELECT cd FROM genero WHERE nome like "%'.$text.'%";';
                $res = $GLOBALS['con']->query($sql);
                if($res->num_rows > 0){
                	if ($res->num_rows < 2){
                		$pes = $res->fetch_object()->cd;
                		
                		$sql1 = 'SELECT cd FROM livro WHERE id_genero = '.$pes;
                        $res1 = $GLOBALS['con']->query($sql1);
                        if($res1->num_rows > 0){
                            $result[0] = $res1->fetch_object()->cd;
                        }else{
                            $result[0] = "ERRO";
                        }
                	}else{
                		$a = 0;
                		$ind = 0;
                		while($rows = mysqli_fetch_array($res)){
                			$sql1 = 'SELECT cd FROM livro WHERE id_genero = '.$rows['cd'];
                            $res1 = $GLOBALS['con']->query($sql1);
                            if($res1->num_rows > 0){
                                $result[$ind] = $res1->fetch_object()->cd;
                                $ind = $ind+1;
                            }
                			$a++;
                		}
                	}
                }else{
                	$result[0]['cd'] = "ERRO";
                };
                return $result;
            }
        //autor LivroSearchAutor
            function LivroSearchAutor($text){
                $sql = 'SELECT cd FROM autor WHERE nome like "%'.$text.'%";';
                $res = $GLOBALS['con']->query($sql);
                if($res->num_rows > 0){
                	if ($res->num_rows < 2){
                		$pes = $res->fetch_object()->cd;
                		
                		$sql1 = 'SELECT id_livro FROM autor_livro WHERE id_autor = '.$pes;
                        $res1 = $GLOBALS['con']->query($sql1);
                        if($res1->num_rows > 0){
                            if ($res1->num_rows < 2){
                                $result[0] = $res1->fetch_object()->id_livro;   
                            }else{
                                $a = 0;
                        		while($rows = mysqli_fetch_array($res1)){
                        			$result[$a] = $rows['id_livro'];
                        			$a++;
                        		}        
                            }
                        }else{
                            $result[0] = "ERRO";
                        }
                	}else{
                		$a = 0;
                		$ind = 0;
                		while($rows = mysqli_fetch_array($res)){
                			$sql1 = 'SELECT id_livro FROM autor_livro WHERE id_autor = '.$rows['cd'];
                            $res1 = $GLOBALS['con']->query($sql1);
                            if($res1->num_rows > 0){
                                if ($res1->num_rows < 2){
                                    $result[$ind] = $res1->fetch_object()->id_livro;
                                    $ind++;
                                }else{
                                    $a2 = 0;
                            		while($rows = mysqli_fetch_array($res1)){
                            			$result[$ind] = $rows['id_livro'];
                            			$ind++;
                            			$a2++;
                            		}        
                                }
                            }
                			$a++;
                		}
                	}
                }else{
                	$result[0] = "ERRO";
                };
                return $result;
            }
	//listar items
	    //listar autores
	    function listAutor($cd){
	    	$retorno = null;
	    	if($cd !== null){
	    		$sql = 'SELECT * FROM autor WHERE cd = '.$cd;
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
	    		$sql = 'SELECT * FROM editora WHERE cd = '.$cd;
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
	    function listGenero($cd){
	    	$retorno = null;
	    	if($cd !== null){
	    		$sql = 'SELECT * FROM genero WHERE cd = '.$cd;
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
	    		$sql = 'SELECT * FROM livro WHERE cd = "'.$nome.'"';
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
	    //buscar cd livro
	    function livroCd($nome, $ano, $text){
	        $sql = 'SELECT * FROM livro WHERE titulo = "'.$nome.'" AND ano='.$ano.' AND sinopse= "'.$text.'"';
	    	$res = $GLOBALS['con']->query($sql);
	    	if($res->num_rows > 0){
	    	    if($res->num_rows < 2){
	    	        $retorno = $res->fetch_object();    
	    	    }else{
	    	        $retorno = 'erro1';
	    	    }
	    	}else{
	    	    $retorno = 'erro';
	    	};
	    	return $retorno;
	    }
	    
	    //autoria autor
	    function listAutoral($cd){
	    	$retorno = null;
	    	if($cd !== null){
	    		$sql = 'SELECT * FROM autor_livro WHERE id_livro = '.$cd;
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
            if($ext == "png" || $ext == "jpg" || $ext == "gif" || $ext == "jpeg"){
                return true;
            }else{ return false; }
        }
        //numero de livros com um genero
        function numbGener($cd){
            $sql = 'SELECT * FROM livro WHERE id_genero ='.$cd;
            $res = $GLOBALS['con']->query($sql);;
            
            return $res->num_rows;
        }
        //converter status in css stet
        function convStatCss($vl){
            $res = "";
            if($vl=="Caloteiro"){
                $res = "C";
            }else if($vl=="Moderado"){
                $res = "M";
            }else if($vl=="Veterano" || $vl=="CHAD"){
                $res = "V";
            }else if($vl=="ADM"){
                $res = "ADM";
            }else{
                $res = "N";    
            }
            return $res;
        }
?>
