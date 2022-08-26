<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="imgs/Title.png">
	<link rel="stylesheet" type="text/css" href="css/adm.css">
	<title>Adiministração site</title>
</head>
<body>
	<header>
		<button onclick="drop2(this, ['#list'], ['#forms'], 0)">Listas</button>
		<button onclick="drop2(this, ['#forms'], ['#list'], 0)">Adicionar</button>
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
					<form class="info">
						<div class="pt1">
							<img src="imgs/itens/procura.png">
							<label>Rodolfo</label>
							<label>RM: 00000</label>
							<label>Homen</label>
						</div>
						<div class="pt2">
							<input type="number" name="cd" class="ocultar" value="00000">
							<select name="adm">
								<option value="true">ADM</option>
								<option value="false">User</option>
							</select>
							<input type="submit" name="admUser" value="Mudar Poder">
							<input type="submit" name="deleteUser" value="DELETAR USER">
						</div>
					</form>
				</div>
				<div id="pageB" class="page">
					<h1>Autores</h1>
					<form class="info2" enctype="multipart/form-data">
						<div class="pt1">
							<img src="imgs/itens/procura.png">
							<label>Machado de asia</label>
						</div>
						<div class="pt2">
							<input type="number" name="cd" class="ocultar" value="00000">
							<input type="text" name="nome" placeholder="Digite o novo nome">
							<label for="foto_autor">Mudar Foto</label>
							<input id="foto_autor" type="file" name="foto" accept="image/png, image/jpeg">
						</div>
						<div class="pt3">
							<input type="submit" name="UpdateAutor" value="Atualizar">
							<input type="submit" name="deleteAutor" value="DELETAR Autor">
						</div>
					</form>
				</div>
				<div id="pageC" class="page">
					<h1>Editoras</h1>
					<form class="info">
						<div class="pt1">
							<label>Marvel</label>
						</div>
						<div class="pt2">
							<input type="number" name="cd" class="ocultar" value="00000">
							<input type="text" name="nome" placeholder="Digite o novo nome">
							<input type="submit" name="UpdateEdit" value="Atualizar">
							<input type="submit" name="deleteEdit" value="DELETAR editora">
						</div>
					</form>
				</div>
				<div id="pageD" class="page">
					<h1>Livros</h1>
					<form class="info2" enctype="multipart/form-data">
						<div class="pt1">
							<label>Machado de asia</label>
						</div>
						<div class="pt2">
							<input type="number" name="cd" class="ocultar" value="00000">
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
				</div>
				<div id="pageE" class="page">
					<h1>Gêneros</h1>
					<form class="info">
						<div class="pt1">
							<label>Ação</label>
						</div>
						<div class="pt2">
							<input type="number" name="cd" class="ocultar" value="00000">
							<input type="text" name="nome" placeholder="Digite o novo nome">
							<input type="submit" name="UpdateGener" value="Atualizar">
							<input type="submit" name="deleteGener" value="DELETAR Gênero">
						</div>
					</form>
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
					<form class="cad" enctype="multipart/form-data">
						<input type="text" name="nome" placeholder="Digite o nome desse autor">
						<label for="foto_autorC">Enviar Imagem</label>
						<input id="foto_autorC" type="file" name="foto" accept="image/png, image/jpeg">
						<input type="submit" name="CrateAutor" value="Adicionar autor">
					</form>
				</div>
				<div id="apageB" class="page">
					<h1>Editora</h1>
					<form class="cad" enctype="multipart/form-data">
						<input type="text" name="nome" placeholder="Digite o nome dessa editora">
						<input type="submit" name="CrateEdit" value="Adicionar editora">
					</form>
				</div>
				<div id="apageC" class="page">
					<h1>Livro</h1>
					<form class="cad" enctype="multipart/form-data">
						<input type="text" name="nome" placeholder="Digite o nome desse livro">
						<input type="date" name="ano">
						<input type="number" name="quantidade" placeholder="coloque a quantidade de livros no estoque">
						<textarea placeholder="digite aqui a sinopse"></textarea>
						<select name="genero">
							<option value="0">Genero</option>
						</select>
						<select name="editora">
							<option value="0">Editora</option>
						</select>
						<select name="autor">
							<option value="0">Autor</option>
						</select>
						<label for="foto_livroC">Enviar foto</label>
						<input id="foto_livroC" type="file" name="foto" accept="image/png, image/jpeg">
						<input type="submit" name="CrateAutor" value="Adiconar Livro">
					</form>
				</div>
				<div id="apageD" class="page">
					<h1>Gênero</h1>
					<form class="cad">
						<input type="text" name="nome" placeholder="Digite o nome desse genero">
						<input type="submit" name="CrateGenero" value="Adiconar Genero">
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