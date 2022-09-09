<?php
	include('conectc.php');
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/Menu.css">
	<link rel="shortcut icon" href="imgs/itens/Title.png">
	<title>Home</title>
</head>
<body>
	<header>
		<img src="imgs/itens/Largato.png">
		<a href="#">Bucher</a><!--livros-->
		<a href="#">Sammlungen</a><!--Coleção-->
		<a href="#">Profil</a><!--Perfil-->
		<button onclick="drop(this, '#barraSearch', 0)"></button>
		<input id="barraSearch" type="text">
		<img src="imgs/itens/Largato.png" class="perfil" onclick="red('PageUser.php')">
	</header>
	<?php
		$livro = listLivro(null);
		$genero = listGenero(null);
		if($livro != null){
			$bigcard = "";
			for($i = 0; $i< count($livro); $i++){
				$editora = listEditora($livro[$i]->id_editora);
				$autoria = listAutoral($livro[$i]->cd);
				$autor = listAutor($autoria->id_autor);
				$nota = $livro[$i]->nota;
				$avali = "";
				for ($i2=0; $i2<$nota; $i2++){ 
					$avali = $avali."*";
				}
				$bigcard = $bigcard.`
						<div class="bigcard" id="livroRank_`.$i.`">
							<div class="text">
								<h1>`.$livro[$i]->titulo.`</h1>
								<p>`.$livro[$i]->sinopse.`</p>
								<h6>ano: `.$livro[$i]->ano.`/ rank: #`.$livro[$i]->rank.`/ autor: `.$autor.`/ editora: `.$editora->nome.`</h6>
								<h3>`.$avali.`</h3>
								<button>Ver Mais</button>
							</div>
							<img src="`.$livro[$i]->capa.`">
						</div>
				`;
			}
			$categorias  = "";
			for($i = 0; $i<count($genero); $i++){
				$text = `
						<h2>`.$genero[$i].`</h2>
						<div class="listH">
				`;
				for($i2=0; $i2<count($livro); $i2++){
					if($livro[$i2]->id_genero == $genero[$i]->cd){
						$text = $text.`
							<div class="card" style="background-image: url(`.$livro[$i2]->capa.`);">
								
							</div>`;
					}
				}
				$text = $text.`
						</div>
				`;
				$categorias = $text;
			}
			$text =`
				<main>
					<div class="slide">
						<button id="front" class="mudar" style="margin-left: 1vw;" onclick="card(this, '#back',1, [1, 5], 0, 'livroRank_')"><</button>
						<button id="back" class="mudar" style="margin-left: 91vw;" onclick="card(this, '#front', 1, [0, 4], 1, 'livroRank_')">></button>
						`.$bigcard.`
						</div>
					</div>
					<div class="espaso">
						`.$categorias.`
					</div>
				</main>
			`;
		}else{
			$text = '
				<h1 style="color: rgb(253 253 253);z-index: 1;font-size: 5vh;margin-top: 26vh;width: 71vw;text-align: center;background-color: var(--thema);border-radius: 23px;padding: 2vh;">
					Espere amigo estamos sem livro cadastrados
				</h1>
				<img src="https://pbs.twimg.com/media/EZDRMTMXQAAi2wW.jpg" style="margin-top: -21vh; height: 55vh; border-radius: 18px; box-shadow: 5px 9px 11px rgb(21 14 28);">
			';
			echo $text;
		}
	?>
	<script src="java.js"></script>
	<script>
		window.onload = ()=>{
			document.querySelector('#livroRank_1').style.display = "flex";
		}
	</script>
</body>
</html>