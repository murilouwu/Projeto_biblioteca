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
INSERT INTO autor (cd, nome) VALUES ( 6, "escritor_6");
INSERT INTO autor (cd, nome) VALUES ( 7, "escritor_7");
INSERT INTO autor (cd, nome) VALUES ( 8, "escritor_8");
INSERT INTO autor (cd, nome) VALUES ( 9, "escritor_9");
/*---------------------------------------------------------------------------------------------------------------------------------------------*/
/*editoras*/

INSERT INTO editora (cd, nome) VALUES ( 1, "Marvel");
INSERT INTO editora (cd, nome) VALUES ( 2, "Dc");
INSERT INTO editora (cd, nome) VALUES ( 3, "Ultra Comics");
INSERT INTO editora (cd, nome) VALUES ( 4, "Wallner");
INSERT INTO editora (cd, nome) VALUES ( 5, "Disney");
INSERT INTO editora (cd, nome) VALUES ( 6, "EA");
INSERT INTO editora (cd, nome) VALUES ( 7, "Punk-edit");
INSERT INTO editora (cd, nome) VALUES ( 8, "Marbel");
/*---------------------------------------------------------------------------------------------------------------------------------------------*/
/*livros*/

INSERT INTO livro (cd, nota, titulo, ano, qtd, sinopse, capa, rank, leitores, id_editora, id_genero) VALUES ( 1, 0, "nome", ano, qtd, "sinopse", "capa", cd, 0, id_editora, id_genero);
INSERT INTO livro (cd, nota, titulo, ano, qtd, sinopse, capa, rank, leitores, id_editora, id_genero) VALUES ( 2, 0, "nome", ano, qtd, "sinopse", "capa", cd, 0, id_editora, id_genero);
INSERT INTO livro (cd, nota, titulo, ano, qtd, sinopse, capa, rank, leitores, id_editora, id_genero) VALUES ( 3, 0, "nome", ano, qtd, "sinopse", "capa", cd, 0, id_editora, id_genero);
INSERT INTO livro (cd, nota, titulo, ano, qtd, sinopse, capa, rank, leitores, id_editora, id_genero) VALUES ( 4, 0, "nome", ano, qtd, "sinopse", "capa", cd, 0, id_editora, id_genero);
INSERT INTO livro (cd, nota, titulo, ano, qtd, sinopse, capa, rank, leitores, id_editora, id_genero) VALUES ( 5, 0, "nome", ano, qtd, "sinopse", "capa", cd, 0, id_editora, id_genero);
INSERT INTO livro (cd, nota, titulo, ano, qtd, sinopse, capa, rank, leitores, id_editora, id_genero) VALUES ( 6, 0, "nome", ano, qtd, "sinopse", "capa", cd, 0, id_editora, id_genero);
INSERT INTO livro (cd, nota, titulo, ano, qtd, sinopse, capa, rank, leitores, id_editora, id_genero) VALUES ( 7, 0, "nome", ano, qtd, "sinopse", "capa", cd, 0, id_editora, id_genero);
INSERT INTO livro (cd, nota, titulo, ano, qtd, sinopse, capa, rank, leitores, id_editora, id_genero) VALUES ( 9, 0, "nome", ano, qtd, "sinopse", "capa", cd, 0, id_editora, id_genero);
/*---------------------------------------------------------------------------------------------------------------------------------------------*/
/*Autorias*/

INSERT INTO autor_livro (id_autor, id_livro) VALUES ( , );