CREATE TABLE fornecedor(
	nif numeric(9) CHECK (nif >= 100000000),
	nome varchar(64) NOT NULL CHECK (nome != ''),
	PRIMARY KEY (nif));

CREATE TABLE categoria(
	nome varchar(64) CHECK (nome != ''),
	PRIMARY KEY (nome));

CREATE TABLE produto(
	ean numeric(13) CHECK (ean >= 1000000000000),
	design varchar(128) NOT NULL CHECK (design != ''),
	forn_primario numeric(9) CHECK (forn_primario >= 100000000),
	data date NOT NULL CHECK (data != null),
	categoria varchar(64) CHECK (categoria != ''),
	PRIMARY KEY (ean),
	FOREIGN KEY (forn_primario) REFERENCES fornecedor(nif),
	FOREIGN KEY (categoria) REFERENCES categoria(nome));

CREATE TABLE categoria_simples(
	nome varchar(64) CHECK (nome != ''),
	PRIMARY KEY (nome),
	FOREIGN KEY (nome) REFERENCES categoria(nome) ON DELETE CASCADE);

CREATE TABLE super_categoria(
	nome varchar(64) CHECK (nome != ''),
	PRIMARY KEY (nome),
	FOREIGN KEY (nome) REFERENCES categoria(nome) ON DELETE CASCADE);

CREATE TABLE constituida(
	super_categoria varchar(64) CHECK (super_categoria != ''),
	categoria varchar(64) CHECK (categoria != ''),
	PRIMARY KEY (super_categoria, categoria),
	FOREIGN KEY (super_categoria) REFERENCES super_categoria(nome) ON DELETE CASCADE,
	FOREIGN KEY (categoria) REFERENCES categoria(nome) ON DELETE CASCADE);

CREATE TABLE corredor(
	nro integer CHECK (nro != null),
	largura double precision NOT NULL CHECK (largura >= 0),
	PRIMARY KEY (nro));

CREATE TABLE prateleira(
	nro integer CHECK (nro != null),
	lado varchar(15) CHECK (lado != ''),
	altura varchar(15) CHECK (altura != ''),
	PRIMARY KEY(nro, lado, altura),
	FOREIGN KEY (nro) REFERENCES corredor(nro));

CREATE TABLE planograma(
	ean numeric(13) CHECK (ean >= 1000000000000),
	nro integer CHECK (nro != null),
	lado varchar(15) CHECK (lado != ''),
	altura varchar(15) CHECK (altura != ''),
	faces integer NOT NULL CHECK (faces >= 0),
	unidades integer NOT NULL CHECK (unidades >= 0),
	loc integer NOT NULL CHECK (loc >= 0),
	PRIMARY KEY (ean, nro, lado, altura),
	FOREIGN KEY (ean) REFERENCES produto(ean),
	FOREIGN KEY (nro, lado, altura) REFERENCES prateleira(nro, lado, altura));

CREATE TABLE evento_reposicao(
	operador varchar(64) CHECK (operador != ''),
	instante date CHECK (instante != null),
	PRIMARY KEY(operador, instante));

CREATE TABLE reposicao(
	ean numeric(13) CHECK (ean >= 1000000000000),
	nro integer CHECK (nro != null),
	lado varchar(10) CHECK (lado != ''),
	altura varchar(15) CHECK (altura != ''),
	operador varchar(64) CHECK (operador != ''),
	instante date CHECK (instante != null),
	unidades integer NOT NULL CHECK (unidades >= 0),
	FOREIGN KEY (operador, instante) REFERENCES evento_reposicao(operador, instante),
	FOREIGN KEY (ean, nro, lado, altura) REFERENCES planograma(ean, nro, lado, altura),
	PRIMARY KEY(ean, nro, lado, altura, operador, instante));

CREATE TABLE fornece_sec(
	nif numeric(9) CHECK (nif >= 100000000),
	ean numeric(13) CHECK (ean >= 1000000000000),
	PRIMARY KEY (nif, ean),
	FOREIGN KEY (nif) REFERENCES fornecedor(nif),
	FOREIGN KEY (ean) REFERENCES produto(ean));


/*CREATE FUNCTION check_categoria_type_sup() RETURNS trigger AS $check_categoria_type_sup$
	BEGIN
		IF nome FROM categoriasimples WHERE (NEW.nome = CategoriaSimples.nome) IS NOT NULL THEN
			RAISE EXCEPTION 'Uma categoria nao pode ser super e simples ao mesmo tempo!';
		END IF;
		RETURN NEW;
	END;
$check_categoria_type_sup$ LANGUAGE plpgsql;
CREATE TRIGGER check_categoria_type_sup BEFORE INSERT OR UPDATE ON super_categoria FOR EACH ROW EXECUTE PROCEDURE check_categoria_type_sup();
CREATE FUNCTION check_categoria_type_simp() RETURNS trigger AS $check_categoria_type_simp$
	BEGIN
		IF nome FROM super_categoria WHERE (super_categoria.nome = NEW.nome) IS NOT NULL THEN
			RAISE EXCEPTION 'Uma categoria nao pode ser simples e super ao mesmo tempo!';
		END IF;
		RETURN NEW;
	END;
$check_categoria_type_simp$ LANGUAGE plpgsql;
CREATE TRIGGER check_categoria_type_simp BEFORE INSERT OR UPDATE ON categoriasimples FOR EACH ROW EXECUTE PROCEDURE check_categoria_type_simp();*/

/*CREATE FUNCTION categoria_verify() RETURNS trigger AS $categoria_verify$
	BEGIN
		IF NEW.super_categoria = NEW.categoria THEN
			RAISE EXCEPTION 'Uma super categoria nao pode ser constituida por si propria';
		END IF;
		IF COUNT(*) FROM CategoriaSimples, SuperCategoria WHERE (NEW.super_categoria = CategoriaSimples.nome) IS NOT NULL THEN
			RAISE EXCEPTION 'A super categoria que esta a tentar adicionar e uma CategoriaSimples!';
		END IF;
		IF COUNT(*) FROM constituida WHERE (NEW.super_categoria = constituida.categoria) AND (NEW.categoria = constituida.super_categoria) IS NOT NULL THEN
			RAISE EXCEPTION 'Nao sao permitidos ciclos de categorias!';
		END IF;
		RETURN NEW;
	END;
$categoria_verify$ LANGUAGE plpgsql; 
CREATE TRIGGER categoria_verify BEFORE INSERT OR UPDATE ON constituida
    FOR EACH ROW EXECUTE PROCEDURE categoria_verify();*/

/*CREATE FUNCTION date_verify() RETURNS trigger AS $date_verify$
	BEGIN
		IF instante FROM evento_reposicao WHERE (NEW.instante::date <= evento_reposicao.instante::date) IS NOT NULL THEN
			RAISE EXCEPTION 'O evento de reposicao que esta a tentar inserir e inferior ao evento de reposicao anterior o que e impossivel!';
		END IF;
		RETURN NEW;
	END;
$date_verify$ LANGUAGE plpgsql;
CREATE TRIGGER date_verify BEFORE INSERT OR UPDATE ON evento_reposicao
	FOR EACH ROW EXECUTE PROCEDURE date_verify();*/

/*CREATE FUNCTION fornecedor_sec_verify() RETURNS trigger AS $fornecedor_sec_verify$
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
    FOR EACH ROW EXECUTE PROCEDURE fornecedor_sec_verify();*/
