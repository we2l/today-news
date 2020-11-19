CREATE DATABASE noticias;

use noticias;

CREATE TABLE NOTICIAS(
    IDNOTICIA INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    TITULO TEXT NOT NULL,
    CONTEUDO TEXT NOT NULL
);

CREATE TABLE CATEGORIAS(
    IDCATEGORIA INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    CATEGORIA VARCHAR(50),
);

CREATE TABLE NOTICIAS_CATEGORIAS(
    ID_NOTICIA INT,
    ID_CATEGORIA INT,
    PRIMARY KEY(ID_NOTICIA, ID_CATEGORIA)
);

ALTER TABLE NOTICIAS_CATEGORIAS
ADD CONSTRAINT FK_IDNOTICIA
FOREIGN KEY(ID_NOTICIA)
REFERENCES NOTICIAS (IDNOTICIA);

ALTER TABLE NOTICIAS_CATEGORIAS
ADD CONSTRAINT FK_IDCATEGORIA
FOREIGN KEY(ID_CATEGORIA)
REFERENCES CATEGORIAS (IDCATEGORIA);

