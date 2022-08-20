CREATE DATABASE biblioteca;
USE biblioteca;

CREATE TABLE usuario(
	rm INT PRIMARY KEY,
	nome VARCHAR(60),
	email VARCHAR(120),
	dt_nascimento DATE,
	genero CHAR(1),
	telefone VARCHAR(45),
	senha CHAR(20),
	perfil VARCHAR(120),
	status VARCHAR(100),
	obs VARCHAR(200)
	adm BOOLEAN
);

CREATE TABLE autor(
	cd INT PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(60)
);

CREATE TABLE editora(
	cd INT PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(80)
);

CREATE TABLE genero(
	cd INT PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(100)
);

CREATE TABLE livro(
	cd INT PRIMARY KEY AUTO_INCREMENT,
	isbn VARCHAR(100),
	titulo VARCHAR(200),
	ano INT(4),
	qtd INT,
	sinopse LONGTEXT,
	capa VARCHAR(200),
	classificacao VARCHAR(45),
	id_editora INT,
	id_genero INT,
	FOREIGN KEY (id_editora) REFERENCES editora(cd),
	FOREIGN KEY (id_genero) REFERENCES genero(cd)
);

CREATE TABLE emprestimo(
	cd INT PRIMARY KEY AUTO_INCREMENT,
	dt_emprestimo DATE,
	dt_prevista DATE,
	dt_devolucao DATE,
	status VARCHAR(100),
	id_usuario INT,
FOREIGN KEY (id_usuario) REFERENCES usuario(cd)
);
CREATE TABLE favorito(
	cd INT PRIMARY KEY AUTO_INCREMENT,
	id_usuario INT,
	id_livro INT,
	FOREIGN KEY (id_usuario) REFERENCES usuario(cd),
	FOREIGN KEY (id_livro) REFERENCES livro(cd)
);

CREATE TABLE autor_livro(
	id_autor INT,
	id_livro INT,
	FOREIGN KEY (id_autor) REFERENCES autor(cd),
	FOREIGN KEY (id_livro) REFERENCES livro(cd)
);
CREATE TABLE livro_emprestimo(
	id_emprestimo INT,
	id_livro INT,
	nota INT(1),
	FOREIGN KEY (id_emprestimo) REFERENCES emprestimo(cd),
	FOREIGN KEY (id_livro) REFERENCES livro(cd)
);