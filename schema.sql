drop table categoria cascade;
drop table categoria_simples cascade;
drop table super_categoria cascade;
drop table constituida cascade;
drop table fornecedor cascade;
drop table produto cascade;
drop table fornece_sec cascade;
drop table corredor cascade;
drop table prateleira cascade;
drop table planograma cascade;
drop table evento_reposicao cascade;
drop table reposicao cascade;



CREATE TABLE categoria(
	nome varchar(64) NOT NULL unique,
	PRIMARY KEY(nome)); 

CREATE TABLE categoria_simples(
	nome char(64) NOT NULL,
	PRIMARY KEY (nome),
	FOREIGN KEY(nome) references categoria (nome) on delete cascade);

CREATE TABLE super_categoria(
	nome char(64) NOT NULL,
	PRIMARY KEY (nome),
	FOREIGN KEY (nome) references categoria(nome) on delete cascade);



CREATE TABLE constituida(
	super_categoria char(64) NOT NULL,
	categoria char(64) NOT NULL,
	PRIMARY KEY (super_categoria, categoria),
	FOREIGN KEY (super_categoria) REFERENCES super_categoria(nome) on delete cascade,
	FOREIGN KEY (categoria) REFERENCES categoria(nome)on delete cascade);

CREATE TABLE fornecedor(
	nif numeric(9) NOT NULL unique,
	nome char(64) NOT NULL,
	PRIMARY KEY(nif),
	

	
CREATE TABLE produto(
	ean numeric(13) NOT NULL unique,
	design char(128) NOT NULL,
	categoria char(64) ,
	forn_primario numeric(9),
	data date NOT NULL,
	PRIMARY KEY(ean),
	FOREIGN KEY(categoria) REFERENCES categoria(nome) on delete set null,
	FOREIGN KEY(forn_primario) references fornecedor(nif),


CREATE TABLE fornece_sec(
	nif numeric(9) NOT NULL,
	ean numeric(13) NOT NULL,
	PRIMARY KEY (nif, ean),
	FOREIGN KEY (nif) references fornecedor(nif),
	FOREIGN KEY(ean) references produto(ean) on delete cascade);


CREATE TABLE corredor(
	nro integer NOT NULL unique,
	PRIMARY KEY(nro),
	largura double precision NOT NULL CHECK (largura >= 0));
	

CREATE TABLE prateleira(
	nro integer NOT NULL,
	lado char(10) NOT NULL,
	altura varchar(12) NOT NULL ,
	PRIMARY KEY(nro, lado, altura),
	FOREIGN KEY(nro) references corredor(nro));

CREATE TABLE planograma(
	ean numeric(13) NOT NULL,
	nro integer NOT NULL,
	lado char(10) NOT NULL CHECK (lado != ''),
	altura varchar(12) NOT NULL,
	faces integer NOT NULL CHECK (faces >= 0),
	unidades integer NOT NULL CHECK (unidades >= 0),
	loc integer NOT NULL CHECK (loc >= 0),
	PRIMARY KEY (ean, nro, lado, altura),
	FOREIGN KEY (nro, lado, altura) REFERENCES prateleira(nro, lado, altura),
	FOREIGN KEY (ean) REFERENCES produto(ean)on delete cascade);

CREATE TABLE evento_reposicao(
	operador varchar(64) NOT NULL,
	instante date NOT NULL,
	PRIMARY KEY(operador, instante));


CREATE TABLE reposicao(
	ean numeric(13) NOT NULL,
	nro integer NOT NULL,
	lado varchar(10) NOT NULL,
	altura varchar(12) NOT NULL,
	operador char(64) NOT NULL,
	instante date NOT NULL,
	unidades integer CHECK (unidades >= 0),
	PRIMARY KEY (ean , nro, lado, altura, operador, instante),
	FOREIGN KEY (operador, instante) REFERENCES evento_reposicao(operador, instante),
	FOREIGN KEY (ean, nro, lado, altura) REFERENCES planograma(ean, nro, lado, altura)on delete cascade);