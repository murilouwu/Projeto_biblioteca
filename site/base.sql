/*---------------------------------------------------------------------------------------------------------------------------------------------*/
/*users*/

	INSERT INTO usuario (cd, rm, nome, email, dt_nascimento, genero, telefone, senha, bio, status, adm) VALUES (1, 0124, "a", "aa@a", "2000-02-01", "H", "1273649", "sus", "...", "novato", 0);
	INSERT INTO usuario (cd, rm, nome, email, dt_nascimento, genero, telefone, senha, bio, status, adm) VALUES (2, 1237, "b", "bb@a", "2010-05-02", "F", "8907612", "sus", "...", "novato", 0);
	INSERT INTO usuario (cd, rm, nome, email, dt_nascimento, genero, telefone, senha, bio, status, adm) VALUES (3, 1534, "c", "cc@a", "2004-03-03", "H", "1965239", "sus", "...", "novato", 0);
	INSERT INTO usuario (cd, rm, nome, email, dt_nascimento, genero, telefone, senha, bio, status, adm) VALUES (4, 3456, "d", "dd@a", "2009-11-04", "F", "7245690", "sus", "...", "novato", 0);
	INSERT INTO usuario (cd, rm, nome, email, dt_nascimento, genero, telefone, senha, bio, status, adm) VALUES (5, 2930, "e", "ee@a", "2007-01-05", "H", "2038473", "sus", "...", "novato", 0);
	INSERT INTO usuario (cd, rm, nome, email, dt_nascimento, genero, telefone, senha, bio, status, adm) VALUES (6, 0000, "f", "ff@a", "2011-09-06", "F", "1243798", "sus", "...", "novato", 0);
	INSERT INTO usuario (cd, rm, nome, email, dt_nascimento, genero, telefone, senha, bio, status, adm) VALUES (7, 1111, "Murilo", "a@a", "2005-17-08", "H", "40028922", "sus", "...", "ADM", 1);
/*---------------------------------------------------------------------------------------------------------------------------------------------*/
/*generos*/

	INSERT INTO genero (cd, nome) VALUES ( 1, "ação");
	INSERT INTO genero (cd, nome) VALUES ( 2, "terror");
	INSERT INTO genero (cd, nome) VALUES ( 3, "erótico");
	INSERT INTO genero (cd, nome) VALUES ( 4, "aventura");
	INSERT INTO genero (cd, nome) VALUES ( 5, "suspense");
	INSERT INTO genero (cd, nome) VALUES ( 6, "fantasia");
	INSERT INTO genero (cd, nome) VALUES ( 7, "cómedia");
	INSERT INTO genero (cd, nome) VALUES ( 8, "drama");
	INSERT INTO genero (cd, nome) VALUES ( 9, "romance");
/*---------------------------------------------------------------------------------------------------------------------------------------------*/
/*autores*/

	INSERT INTO autor (cd, nome) VALUES ( 1, "escritor_1");
	INSERT INTO autor (cd, nome) VALUES ( 2, "escritor_2");
	INSERT INTO autor (cd, nome) VALUES ( 3, "escritor_3");
	INSERT INTO autor (cd, nome) VALUES ( 4, "escritor_4");
	INSERT INTO autor (cd, nome) VALUES ( 5, "escritor_5");
/*---------------------------------------------------------------------------------------------------------------------------------------------*/
/*editoras*/

	INSERT INTO editora (cd, nome) VALUES ( 1, "Marvel");
	INSERT INTO editora (cd, nome) VALUES ( 2, "Dc");
	INSERT INTO editora (cd, nome) VALUES ( 3, "Ultra Comics");
	INSERT INTO editora (cd, nome) VALUES ( 4, "Disney");
/*---------------------------------------------------------------------------------------------------------------------------------------------*/
/*livros*/

	INSERT INTO livro (cd, nota, titulo, ano, qtd, sinopse, capa, rank, leitores, id_editora, id_genero) VALUES ( 1, 0, "sus", 2020, 22, "serio?", "imgs/livros/1-2020-1.png", 1, 0, 4, 5);
	INSERT INTO livro (cd, nota, titulo, ano, qtd, sinopse, capa, rank, leitores, id_editora, id_genero) VALUES ( 2, 0, "Bee Book", 2000, 2, "tu ruru rurur rurur ruru", "imgs/livros/2-2000-2.png", 2, 0, 3, 3);
	INSERT INTO livro (cd, nota, titulo, ano, qtd, sinopse, capa, rank, leitores, id_editora, id_genero) VALUES ( 3, 0, "cj angolano ventures", 1980, 20, "oh mmy goood", "imgs/livros/3-1980-3.png", 3, 0, 1, 4);
	INSERT INTO livro (cd, nota, titulo, ano, qtd, sinopse, capa, rank, leitores, id_editora, id_genero) VALUES ( 4, 0, "SUSpeito da nave", 2016, 1, "voce é?", "imgs/livros/4-2016-4.png", 4, 0, 1, 8);
	INSERT INTO livro (cd, nota, titulo, ano, qtd, sinopse, capa, rank, leitores, id_editora, id_genero) VALUES ( 5, 0, "?gibi?", 1800, 34, "o que é gibi? onde vive? onde come?", "imgs/livros/5-1800-5.png", 5, 0, 2, 9);
	INSERT INTO livro (cd, nota, titulo, ano, qtd, sinopse, capa, rank, leitores, id_editora, id_genero) VALUES ( 6, 0, "Homen Homen Homen", 2022, 10, "M A N", "imgs/livros/6-2022-3.png", 6, 0, 4, 0);
	INSERT INTO livro (cd, nota, titulo, ano, qtd, sinopse, capa, rank, leitores, id_editora, id_genero) VALUES ( 7, 0, "guia de como ser um bolsonarro", 2018, 202, "tente imitar o adolf hi..", "imgs/livros/7-2018-4.png", 7, 0, 3, 3);
	INSERT INTO livro (cd, nota, titulo, ano, qtd, sinopse, capa, rank, leitores, id_editora, id_genero) VALUES ( 8, 0, "A", 2004, 1, "becedario", "imgs/livros/8-2004-5.png", 8, 0, 2, 1);
/*---------------------------------------------------------------------------------------------------------------------------------------------*/
/*Autorias*/

	INSERT INTO autor_livro (id_autor, id_livro) VALUES ( 1, 1);
	INSERT INTO autor_livro (id_autor, id_livro) VALUES ( 2, 2);
	INSERT INTO autor_livro (id_autor, id_livro) VALUES ( 3, 3);
	INSERT INTO autor_livro (id_autor, id_livro) VALUES ( 4, 4);
	INSERT INTO autor_livro (id_autor, id_livro) VALUES ( 5, 5);
	INSERT INTO autor_livro (id_autor, id_livro) VALUES ( 3, 6);
	INSERT INTO autor_livro (id_autor, id_livro) VALUES ( 4, 7);
	INSERT INTO autor_livro (id_autor, id_livro) VALUES ( 5, 8);