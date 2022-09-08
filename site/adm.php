<?php
	include('conectc.php');
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="imgs/itens/Title.png">
		<link rel="stylesheet" type="text/css" href="css/adm.css">
		<title>Adiministração site</title>
	</head>
	<body>
		<header>
			<button onclick="drop2(this, ['#list'], ['#forms'], 0)">Listas</button>
			<button onclick="drop2(this, ['#forms'], ['#list'], 0)">Adicionar</button>
			<a href="pageUser.php" style="background-image: url(<?php echo $_SESSION['user']['dados']->img;?>)"></a>
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
							if ($users != null){
								for ($i=0; $i<count($users); $i++) { 
									if($users[$i]->adm == 1){
										$select = '
											<option value="true" selected>ADM</option>
											<option value="false">User</option>
										';
									}else{
										$select = '
											<option value="1">ADM</option>
											<option value="0" selected>User</option>
										';
									};
									$texto = '
										<form class="info" method="post">
											<h1>Informações</h1>
											
											<p>foto:</p>
											<img src="'.$users[$i]->img.'">
											
											<label>Nome: '.$users[$i]->nome.'</label>
											<label>RM: '.$users[$i]->rm.'</label>
											<label>Sexo: '.sexo($users[$i]->genero).'</label>
											<input type="number" name="cd" class="ocultar" value="'.$users[$i]->cd.'">
											
											<h1>Mudar</h1>
											<p>mudar cargo (Adm ou User)</p>
											<select name="adm">
												'.$select.'
											</select>
											
											<h1>Botões</h1>
											<input type="submit" name="admUser" value="Mudar Poder">
											<input type="submit" name="deleteUser" value="DELETAR USER">
										</form>
										<hr>
									';
									if($users[$i]->cd != $_SESSION['user']['dados']->cd){
										echo $texto;	
									}
								};
							}else{
								echo "<h1>Não há usuarios</h1>";
							};
						?>
					</div>
					<div id="pageB" class="page">
						<h1>Autores</h1>
						<?php
							$autores = listAutor(null);
							if($autores != null){
								for ($i=0; $i<count($autores); $i++) { 
									$texto = '
										<form class="info" method="post">
											<h1>Informações</h1>

											<p>Foto:</p>
											<img src="'.$autores[$i]->img.'">
											<label>Nome: '.$autores[$i]->nome.'</label>
											<input type="number" name="cd" class="ocultar" value="'.$autores[$i]->cd.'">
											
											<h1>Mudar</h1>
											<p>Nome:</p>
											<input type="text" name="nome">
											<p>Foto:</p>
											<input type="text" name="foto" placeholder="cole aqui o link da imagem">

											<h1>Botões</h1>
											<input type="submit" name="UpdateAutor" value="Atualizar">
											<input type="submit" name="deleteAutor" value="DELETAR Autor">
										</form>
									';
									echo $texto;
								};
							}else{
								echo "<h1>Não há Autores</h1>";
							};
						?>
					</div>
					<div id="pageC" class="page">
						<h1>Editoras</h1>
						<?php
							$editoras = listEditora(null);
							if($editoras != null){
								for ($i=0; $i<count($editoras); $i++) { 
									$texto = '
										<form class="info" method="post">
											<h1>Informações</h1>
											<label>Nome: '.$editoras[$i]->nome.'</label>
											<input type="number" name="cd" class="ocultar" value="'.$editoras[$i]->cd.'">

											<h1>Mudar</h1>
											<p>Nome:</p>
											<input type="text" name="nome">

											<h1>Botões</h1>
											<input type="submit" name="UpdateEdit" value="Atualizar">
											<input type="submit" name="deleteEdit" value="DELETAR editora">
										</form>
									';
									echo $texto;
								};	
							}else{
								echo "<h1>Não há Editoras</h1>";
							};
						?>
					</div>
					<div id="pageD" class="page">
						<h1>Livros</h1>
						<?php
							$livros = listLivro(null);
							if($livros != null){
								$texto = array( '0'=>'', '1'=>'', '2'=>'');
								
								$genero = listGenero(null);
								for ($i=0; $i<count($genero); $i++) { 
									$texto['0'] = $texto['0'].'
										<option value="'.$genero[$i]->cd.'">'.$genero[$i]->nome.'</option>
									';
								};
								$editoras = listEditora(null);
								for ($i=0; $i<count($editoras); $i++) { 
									$texto['1'] = $texto['1'].'
										<option value="'.$editoras[$i]->cd.'">'.$editoras[$i]->nome.'</option>
									';
								};
								
								$autores = listAutor(null);
								for ($i=0; $i<count($autores); $i++) { 
									$texto['2'] = $texto['2'].'
										<option value="'.$autores[$i]->cd.'">'.$autores[$i]->nome.'</option>
									';
								};
								
								for ($i=0; $i<count($livros); $i++) { 
									$texto = '
										<form class="info" method="post">
											<h1>Informações</h1>

											<p>Foto:</p>
											<img src="'.$livros[$i]->capa.'">
											<label>Nome: '.$livros[$i]->nome.'</label>
											<input type="number" name="cd" class="ocultar" value="'.$livros[$i]->cd.'">

											<h1>Mudar dados</h1>
											
											<p>Nome:</p>
											<input type="text" name="nome">
											
											<p>Ano de lançamento:</p>
											<input type="date" name="ano">
											
											<p>Quantidade atual:</p>
											<input type="number" name="qtd" value="45">
											
											<p>Sinopse:</p>
											<textarea name="sinopse"></textarea>
											
											<p>Gênero:</p>
											<select name="genero">
												'.$texto['0'].'
											</select>

											<p>Editora:</p>
											<select name="editora">
												'.$texto['1'].'
											</select>

											<p>Autor</p>
											<select name="autor">
												'.$texto['2'].'
											</select>

											<p>foto</p>
											<input type="text" name="foto" placeholder="cole aqui o link da foto">

											<h1>Botões</h1>
											<input type="submit" name="UpdateAutor" value="Atualizar">
											<input type="submit" name="deleteAutor" value="DELETAR Autor">
										</form>
									';
									echo $texto;
								};
							}else{
								echo "<h1>Não há Livros</h1>";
							};
						?>
					</div>
					<div id="pageE" class="page">
						<h1>Gêneros</h1>
						<?php
							$genero = listGenero(null);
							if($genero != null){
								for ($i=0; $i<count($genero); $i++) { 
									$texto = '
										<form class="info" method="post">
											<h1>Infomações</h1>
											<label>Nome: '.$genero[$i]->nome.'</label>
											<input type="number" name="cd" class="ocultar" value="'.$genero[$i]->cd.'">
											
											<h1>Mudar</h1>
												<p>Nome</p>
												<input type="text" name="nome" placeholder="Digite o novo nome">
											
											<h1>Botões</h1>	
											<input type="submit" name="UpdateGener" value="Atualizar">
											<input type="submit" name="deleteGener" value="DELETAR Gênero">
										</form>
									';
									echo $texto;
								};	
							}else{
								echo "<h1>Não há Gêneros</h1>";
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
						<form class="cad" method="post">
							<input type="text" name="nome" placeholder="Digite o nome desse autor">
							<input type="text" name="foto" placeholder="cole o link aqui">
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
						<?php
							$genero = listGenero(null);
							$editoras = listEditora(null);
							$autores = listAutor(null);
							$texto = array(
								'genero' => "",
								'editoras' => "",
								'autores' => ""
							);
							if($genero != null AND $editoras != null AND $autores != null){
								for ($i=0; $i<count($genero); $i++) { 
									$texto['genero'] = $texto['genero'].'
										<option value="'.$genero[$i]->cd.'">'.$genero[$i]->nome.'</option>
									';
								};
								for ($i=0; $i<count($editoras); $i++) { 
									$texto['editoras'] = $texto['editoras'].'
										<option value="'.$editoras[$i]->cd.'">'.$editoras[$i]->nome.'</option>
									';
								};
								for ($i=0; $i<count($autores); $i++) { 
									$texto['autores'] = $texto['autores'].'
										<option value="'.$autores[$i]->cd.'">'.$autores[$i]->nome.'</option>
									';
								};
								
								$text = '
									<form class="cad" method="post">
										<input type="text" name="nome" placeholder="Digite o nome desse livro">
										<input type="date" name="ano">
										<input type="number" name="quantidade" placeholder="coloque a quantidade de livros no estoque">
										<textarea placeholder="digite aqui a sinopse" name="sinops"></textarea>
										<h2>Gênero</h2>
										<select name="genero">
											'.$texto['genero'].'
										</select>
										<h2>Editora</h2>
										<select name="editora">
											'.$texto['editoras'].'
										</select>
										<h2>Autor</h2>
										<select name="autor">
											'.$texto['autores'].'
										</select>
										<input type="text" name="foto" placeholder="cole o link da imagem aqui" style="margin: 2vh 0vw 1vh 0vh">
										<input type="submit" name="CreateBook" value="Adiconar Livro">
									</form>		
								';

								echo $text;
							}else{
								$text = "Primeiro adicione pelo menos";
								if($genero == null){
									$text = $text.", um genero";
								};
								if($editoras == null){
									$text = $text.", uma editora";
								};
								if($autores == null){
									$text = $text.", um autor";
								};
								echo ("<h1>".$text.", ok</h1>");
							}
						?>
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
		$foto = $_POST['foto'];
		if(linkExe($foto)){
		    if(verImg($foto) == true){
        		addAutor($_POST['nome'], $foto);
        		mover('adm.php');    
		    }else{
    		    echo "<script>alert('link não leva a uma imagem ou gif');</script>";
    		}  
		}else{
		    echo "<script>alert('link não exite!!!');</script>";
		}
	}
	//criar editora
	if(isset($_POST['CreateEdit'])){
		addEditora($_POST['nome']);
		mover('adm.php');
	}
	//criar editora
	if(isset($_POST['CreateGenero'])){
		addGenero($_POST['nome']);
		mover('adm.php');
	}
	//criar livro
	if(isset($_POST['CreateBook'])){
		$foto = $_POST['foto'];
		if(linkExe($foto)){
		    if(verImg($foto) == true){
        		addLivro($_POST['nome'], $_POST['ano'], $_POST['quantidade'], $_POST['sinops'], $_POST['editora'], $_POST['editora'], $foto);
        		$cd = listLivro($_POST['nome'])->cd;
        		addAutoria($cd, $_POST['autor']);
        		mover('adm.php');    
		    }else{
    		    echo "<script>alert('link não leva a uma imagem ou gif');</script>";
    		}  
		}else{
		    echo "<script>alert('link não exite!!!');</script>";
		}
	}

	//atualizações
		//user
			//mudar poder
			if(isset($_POST['admUser'])){
				$cod = $_POST['cd'];
				$poder = $_POST['adm'];

				addAdm($cod, $poder);
				mover('adm.php');
			}
			//deletar
			if(isset($_POST['deleteUser'])){
				$cod = $_POST['cd'];

				deleteUser($cod);
				mover('adm.php');
			}
		//autores
			//deletar
			if(isset($_POST['deleteAutor'])){
				$cd = $_POST['cd'];

				deleteAutor($cd);
			}
			//muda foto
		//editora
			//deletar
			if(isset($_POST['deleteEdit'])){

			}
		//livro
			//deletar
?>