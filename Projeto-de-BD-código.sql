CREATE TABLE fornecedor(
	nif numeric(9) PRIMARY KEY,
	nome varchar(64) NOT NULL,
	CONSTRAINT nif_tamanho CHECK (nif >= 100000000)); 

CREATE TABLE categoria(
	nome varchar(64) PRIMARY KEY); 

CREATE TABLE produto(
	ean numeric(13) PRIMARY KEY,
	design varchar(128) NOT NULL,
	nif numeric(9) REFERENCES fornecedor(nif),
	tempo date NOT NULL,
	nome varchar(64) NOT NULL REFERENCES categoria(nome),
	CONSTRAINT ean_tamanho CHECK (ean >= 1000000000000),
	CONSTRAINT nif_tamanho CHECK (nif >= 100000000)); 

CREATE TABLE categoriasimples(
	nome varchar(64) PRIMARY KEY REFERENCES categoria(nome));

CREATE TABLE supercategoria(
	nome varchar(64) PRIMARY KEY REFERENCES categoria(nome));

CREATE FUNCTION check_categoria_type_sup() RETURNS trigger AS $check_categoria_type_sup$
	BEGIN
		IF nome FROM categoriasimples WHERE (NEW.nome = CategoriaSimples.nome) IS NOT NULL THEN
			RAISE EXCEPTION 'Uma categoria nao pode ser super e simples ao mesmo tempo!';
		END IF;

		RETURN NEW;
	END;
$check_categoria_type_sup$ LANGUAGE plpgsql;

CREATE TRIGGER check_categoria_type BEFORE INSERT OR UPDATE ON supercategoria FOR EACH ROW EXECUTE PROCEDURE check_categoria_type();

CREATE FUNCTION check_categoria_type_simp() RETURNS trigger AS $check_categoria_type_simp$
	BEGIN
		IF nome FROM supercategoria WHERE (NEW.nome = SuperCategoria.nome) IS NOT NULL THEN
			RAISE EXCEPTION 'Uma categoria nao pode ser simples e super ao mesmo tempo!';
		END IF;

		RETURN NEW;
	END;
$check_categoria_type_simp$ LANGUAGE plpgsql;

CREATE TRIGGER check_categoria_type BEFORE INSERT OR UPDATE ON categoriasimples FOR EACH ROW EXECUTE PROCEDURE check_categoria_type();

CREATE TABLE constituida(
	super_categoria varchar(64) REFERENCES SuperCategoria(nome),
	categoria varchar(64) REFERENCES categoria(nome),
	PRIMARY KEY (snome, cnome));

CREATE FUNCTION categoria_verify() RETURNS trigger AS $categoria_verify$
	BEGIN
		IF NEW.snome = NEW.cnome THEN
			RAISE EXCEPTION 'Uma SuperCategoria nao pode ser constituida por si propria';
		END IF;
		IF COUNT(*) FROM CategoriaSimples, SuperCategoria WHERE (NEW.snome = CategoriaSimples.nome) IS NOT NULL THEN
			RAISE EXCEPTION 'A SuperCategoria que esta a tentar adicionar e uma CategoriaSimples!';
		END IF;
		IF COUNT(*) FROM constituida WHERE (NEW.snome = constituida.cnome) AND (NEW.cnome = constituida.snome) IS NOT NULL THEN
			RAISE EXCEPTION 'Nao sao permitidos ciclos de categorias!';
		END IF;

		RETURN NEW;
	END;
$categoria_verify$ LANGUAGE plpgsql; 

CREATE TRIGGER categoria_verify BEFORE INSERT OR UPDATE ON constituida
    FOR EACH ROW EXECUTE PROCEDURE categoria_verify();

CREATE TABLE corredor(
	nro integer PRIMARY KEY,
	largura double precision NOT NULL CHECK (largura >= 0));

CREATE TABLE prateleira(
	nro integer REFERENCES corredor(nro),
	lado varchar(10) NOT NULL,
	altura double precision NOT NULL CHECK (altura >= 0),
	PRIMARY KEY(nro, lado, altura));

CREATE TABLE planograma(
	ean numeric(13) REFERENCES produto(ean),
	nro integer NOT NULL,
	lado varchar(10) NOT NULL CHECK (lado != ''),
	altura double precision CHECK (altura >=0),
	faces integer NOT NULL CHECK (faces >= 0),
	unidades integer NOT NULL CHECK (unidades >= 0),
	loc integer NOT NULL CHECK (loc >= 0),
	PRIMARY KEY (ean, nro, lado, altura),
	FOREIGN KEY (nro, lado, altura) REFERENCES prateleira(nro, lado, altura));

CREATE TABLE evento_reposicao(
	operador varchar(64) NOT NULL,
	instante date NOT NULL,
	PRIMARY KEY(operador, instante));

CREATE FUNCTION date_verify() RETURNS trigger AS $date_verify$
	BEGIN
		IF instante FROM evento_reposicao WHERE (NEW.instante::date <= evento_reposicao.instante::date) IS NOT NULL THEN
			RAISE EXCEPTION 'O evento de reposicao que esta a tentar inserir e inferior ao evento de reposicao anterior o que e impossivel!';
		END IF;

		RETURN NEW;
	END;
$date_verify$ LANGUAGE plpgsql;

CREATE TRIGGER date_verify BEFORE INSERT OR UPDATE ON evento_reposicao
	FOR EACH ROW EXECUTE PROCEDURE date_verify();

CREATE TABLE reposicao(
	operador varchar(64) NOT NULL,
	instante date NOT NULL,
	ean numeric(13) NOT NULL,
	nro integer NOT NULL,
	lado varchar(10) NOT NULL,
	altura double precision NOT NULL,
	unidades integer CHECK (unidades >= 0),
	FOREIGN KEY (operador, instante) REFERENCES evento_reposicao(operador, instante),
	FOREIGN KEY (ean, nro, lado, altura) REFERENCES planograma(ean, nro, lado, altura));

CREATE TABLE fornecedor_sec(
	nif numeric(9) REFERENCES fornecedor(nif),
	ean numeric(13) REFERENCES produto(ean),
	PRIMARY KEY (nif, ean));

CREATE FUNCTION fornecedor_sec_verify() RETURNS trigger AS $fornecedor_sec_verify$
	BEGIN
		IF NEW.nif IS NULL THEN
			RAISE EXCEPTION '% Nao pode ser NULL', NEW.nif;
		END IF;
		IF NEW.ean IS NULL THEN
			RAISE EXCEPTION '% Nao pode ser NULL', NEW.ean;
		END IF;
		IF COUNT(nif) FROM produto WHERE (NEW.nif = produto.nif) AND (NEW.ean = produto.ean) IS NOT NULL THEN
			RAISE EXCEPTION 'Um fornecedor nao pode ser primario e secundario para o mesmo produto';
		END IF;

		NEW.nif := current_nif;
		NEW.ean := current_ean;
		RETURN NEW;
	END;
$fornecedor_sec_verify$ LANGUAGE plpgsql;

CREATE TRIGGER fornecedor_sec_verify BEFORE INSERT OR UPDATE ON fornecedor_sec
    FOR EACH ROW EXECUTE PROCEDURE fornecedor_sec_verify();

