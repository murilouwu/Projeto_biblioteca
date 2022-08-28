<?php
	include('conectc.php');
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="imgs/Title.png">
		<link rel="stylesheet" type="text/css" href="imgs/itens/Title.png">
		<title>Adiministração site</title>
	</head>
	<body>
		<header>
			<button onclick="drop2(this, ['#list'], ['#forms'], 0)">Listas</button>
			<button onclick="drop2(this, ['#forms'], ['#list'], 0)">Adicionar</button>
			<a href="pageUser.php" style="background-image: url(imgs/user/<?php echo $_SESSION['user']['dados']->cd.'.png';?>);"></a>
		</header>
		<main>
			<!--Listas-->
			<div id="list" class="aba">
				<div class="header">
					<button onclick="drop2(this, ['#pageA'], ['#pageB','#pageC','#pageD','#pageE'], 0)">
						Usuarios
					</button>

					<button onclick="drop2(this, ['#pageB'], ['#pageA','#pageC','#pageD','#pageE'], 0)">
						Autores
					</button>

					<button onclick="drop2(this, ['#pageC'], ['#pageA','#pageB','#pageD','#pageE'], 0)">
						Editoras
					</button>

					<button onclick="drop2(this, ['#pageD'], ['#pageA','#pageB','#pageC','#pageE'], 0)">
						Livros
					</button>

					<button onclick="drop2(this, ['#pageE'], ['#pageA','#pageB','#pageC','#pageD'], 0)">
						Generos
					</button>
				</div>
				<div class="body">
					<div id="pageA" class="page">
						<h1>Usuarios</h1>
						<?php
							$users = listUser(null);
							for ($i=0; $i<count($users); $i++) { 
								if($users[$i]->adm == 1){
									$select = '
										<option value="true" selected>ADM</option>
										<option value="false">User</option>
									';
								}else{
									$select = '
										<option value="true">ADM</option>
										<option value="false" selected>User</option>
									';
								};
								$texto = '
									<form class="info" method="post">
										<div class="pt1">
											<img src="imgs/user/'.$users[$i]->cd.'.png">
											<label>'.$users[$i]->nome.'</label>
											<label>RM: '.$users[$i]->rm.'</label>
											<label>'.sexo($users[$i]->genero).'</label>
										</div>
										<div class="pt2">
											<input type="number" name="cd" class="ocultar" value="'.$users[$i]->cd.'">
											<select name="adm">
												'.$select.'
											</select>
											<input type="submit" name="admUser" value="Mudar Poder">
											<input type="submit" name="deleteUser" value="DELETAR USER">
										</div>
									</form>
								';
								echo $texto;
							};
						?>
					</div>
					<div id="pageB" class="page">
						<h1>Autores</h1>
						<?php
							$autores = listAutor(null);
							for ($i=0; $i<count($autores); $i++) { 
								$texto = '
									<form class="info2" enctype="multipart/form-data" method="post">
										<div class="pt1">
											<img src="imgs/autores/'.$autores[$i]->cd.'.png">
											<label>'.$autores[$i]->nome.'</label>
										</div>
										<div class="pt2">
											<input type="number" name="cd" class="ocultar" value="'.$autores[$i]->cd.'">
											<input type="text" name="nome" placeholder="Digite o novo nome">
											<label for="foto_autor">Foto</label>
											<input id="foto_autor" type="file" name="foto" accept="image/png, image/jpeg">
										</div>
										<div class="pt3">
											<input type="submit" name="UpdateAutor" value="Atualizar">
											<input type="submit" name="deleteAutor" value="DELETAR Autor">
										</div>
									</form>
								';
								echo $texto;
							};
						?>
					</div>
					<div id="pageC" class="page">
						<h1>Editoras</h1>
						<?php
							$editoras = listEditora(null);
							for ($i=0; $i<count($editoras); $i++) { 
								$texto = '
									<form class="info" method="post">
										<div class="pt1">
											<label>'.$editoras[$i]->nome.'</label>
										</div>
										<div class="pt2">
											<input type="number" name="cd" class="ocultar" value="'.$editoras[$i]->cd.'">
											<input type="text" name="nome" placeholder="Digite o novo nome">
											<input type="submit" name="UpdateEdit" value="Atualizar">
											<input type="submit" name="deleteEdit" value="DELETAR editora">
										</div>
									</form>
								';
								echo $texto;
							};
						?>
					</div>
					<div id="pageD" class="page">
						<h1>Livros</h1>
						<?php
							$livros = listLivro(null);
							for ($i=0; $i<count($livros); $i++) { 
								$texto = '
									<form class="info2" enctype="multipart/form-data" method="post">
										<div class="pt1">
											<img src="'.$livros[$i]->capa.'">
											<label>'.$livros[$i]->titulo.'</label>
										</div>
										<div class="pt2">
											<input type="number" name="cd" class="ocultar" value="'.$livros[$i]->cd.'">
											<input type="text" name="nome" placeholder="Digite o novo nome">
											<input type="date" name="ano">
											<input type="number" name="qtd" placeholder="Digite a quatidade atual dos livros">
											<textarea name="sinopse" placeholder="digite a  nova sinopse do livro aqui"></textarea>
										</div>
										<div class="pt3">
											<label for="foto_livro">Enviar arquivo</label>
											<input id="foto_livro" type="file" name="capa" accept="image/png, image/jpeg">
											<input type="submit" name="UpdateAutor" value="Atualizar">
											<input type="submit" name="deleteAutor" value="DELETAR Autor">
										</div>
									</form>
								';
								echo $texto;
							};
						?>
					</div>
					<div id="pageE" class="page">
						<h1>Gêneros</h1>
						<?php
							$genero = listGenero(null);
							for ($i=0; $i<count($genero); $i++) { 
								$texto = '
									<form class="info" method="post">
										<div class="pt1">
											<label>'.$genero[$i]->nome.'</label>
										</div>
										<div class="pt2">
											<input type="number" name="cd" class="ocultar" value="'.$genero[$i]->cd.'">
											<input type="text" name="nome" placeholder="Digite o novo nome">
											<input type="submit" name="UpdateGener" value="Atualizar">
											<input type="submit" name="deleteGener" value="DELETAR Gênero">
										</div>
									</form>
								';
								echo $texto;
							};
						?>
					</div>
				</div>
			</div>
			<!--Adicionar-->
			<div id="forms" class="aba">
				<div class="header">
					<button onclick="drop2(this, ['#apageA'], ['#apageB','#apageC','#apageD'], 0)">
						Autores
					</button>

					<button onclick="drop2(this, ['#apageB'], ['#apageA','#apageC','#pageD'], 0)">
						Editoras
					</button>

					<button onclick="drop2(this, ['#apageC'], ['#apageA','#apageB','#apageD'], 0)">
						Livros
					</button>

					<button onclick="drop2(this, ['#apageD'], ['#apageA','#apageB','#apageC'], 0)">
						Generos
					</button>
				</div>
				<div class="body">
					<div id="apageA" class="page">
						<h1>Autor</h1>
						<form class="cad" enctype="multipart/form-data" method="post">
							<input type="text" name="nome" placeholder="Digite o nome desse autor">
							<label for="foto_autorC">Enviar Imagem</label>
							<input id="foto_autorC" type="file" name="foto" accept="image/png, image/jpeg">
							<input type="submit" name="CrateAutor" value="Adicionar autor">
						</form>
					</div>
					<div id="apageB" class="page">
						<h1>Editora</h1>
						<form class="cad" method="post">
							<input type="text" name="nome" placeholder="Digite o nome dessa editora">
							<input type="submit" name="CreateEdit" value="Adicionar editora">
						</form>
					</div>
					<div id="apageC" class="page">
						<h1>Livro</h1>
						<form class="cad" enctype="multipart/form-data" method="post">
							<input type="text" name="nome" placeholder="Digite o nome desse livro">
							<input type="date" name="ano">
							<input type="number" name="quantidade" placeholder="coloque a quantidade de livros no estoque">
							<textarea placeholder="digite aqui a sinopse" name="sinops"></textarea>
							<h2>Gênero</h2>
							<select name="genero">
								<?php
									$genero = listGenero(null);
									for ($i=0; $i<count($genero); $i++) { 
										$texto = '
											<option value="'.$genero[$i]->cd.'">'.$genero[$i]->nome.'</option>
										';
										echo $texto;
									};
								?>
							</select>
							<h2>Editora</h2>
							<select name="editora">
								<?php
									$editoras = listEditora(null);
									for ($i=0; $i<count($editoras); $i++) { 
										$texto = '
											<option value="'.$editoras[$i]->cd.'">'.$editoras[$i]->nome.'</option>
										';
										echo $texto;
									};
								?>
							</select>
							<h2>Autor</h2>
							<select name="autor">
								<?php
									$autores = listAutor(null);
									for ($i=0; $i<count($autores); $i++) { 
										$texto = '
											<option value="'.$autores[$i]->cd.'">'.$autores[$i]->nome.'</option>
										';
										echo $texto;
									};
								?>
							</select>
							<label for="foto_livroC">Enviar foto</label>
							<input id="foto_livroC" type="file" name="foto" accept="image/png, image/jpeg">
							<input type="submit" name="CreateBook" value="Adiconar Livro">
						</form>
					</div>
					<div id="apageD" class="page">
						<h1>Gênero</h1>
						<form class="cad" method="post">
							<input type="text" name="nome" placeholder="Digite o nome desse genero">
							<input type="submit" name="CreateGenero" value="Adiconar Genero">
						</form>
					</div>
				</div>
			</div>
		</main>
		<script src="java.js"></script>
		<script>
			window.onload = ()=>{
				ocultar('#list',0);
				ocultar('#forms',0);
			};
		</script>
	</body>
</html>
<?php
	//criar autor
	if(isset($_POST['CrateAutor'])){
		//autor no banco de dados
		//criar
		addAutor($_POST['nome']);

		//imagem do autor
		//pegar cd do autor
		$autor = listAutor($_POST['nome'])->cd;
		//extenção de imagem
		$ext = strtolower(substr($_FILES['foto']['name'],-4));
		//destino da imagem
		$destino = 'imgs/autores/'.$autor.$ext;
		//imagem
		$img = $_FILES['foto'];
		//salvar imagem
		addFoto($img, $destino);
		
		//recarregar pagina
		mover('adm.php');
	}
	//criar editora
	if(isset($_POST['CreateEdit'])){
		//adicionar no banco
		addEditora($_POST['nome']);

		//recarregar pagina
		mover('adm.php');
	}
	//criar editora
	if(isset($_POST['CreateGenero'])){
		//adicionar no banco
		addGenero($_POST['nome']);

		//recarregar pagina
		mover('adm.php');
	}
	//criar livro
	if(isset($_POST['CreateBook'])){
		$cod = count(listLivro(null));
		//imagem do livro
			//extenção de imagem
			$ext = strtolower(substr($_FILES['foto']['name'],-4));
			//novo noma para imagem
			$NewNomeImg = $cod."-".$_POST['quantidade']."-".$_POST['ano']."-".$_POST['autor'].$ext;
			//destino da imagem
			$destino = 'imgs/livros/'.$NewNomeImg;
			//imagem
			$img = $_FILES['foto'];
			//salvar imagem
			addFoto($img, $destino);
		
		//adicionar livro no banco
		addLivro($_POST['nome'], $_POST['ano'], $_POST['quantidade'], $_POST['sinops'], $_POST['editora'], $_POST['editora'], $destino);
		
		//conectar livro com autor
		$cd = listLivro($_POST['nome'])->cd;
		addAutoria($cd, $_POST['autor']);
		
		//recarregar pagina
		mover('adm.php');
	}
?>