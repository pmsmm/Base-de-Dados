insert into categoria values ('algo', 'algo2');

insert into categoria values (''); /*Funciona mas nao devia*/

insert into categoria values ("");

insert into categoria values (123456789); /*Funciona mas nao devia*/

insert into categoria values ('1234567890123456789012345678901234567890123456789012345678901234567890');

insert into categoria values ('congelados');
insert into categoria values ('congelados');



insert into categoria values ('algo');
insert into categoria values ('algo2');
insert into categoria_simples values ('algo', 'algo2');

insert into categoria values ('');
insert into categoria_simples values (''); /*Funciona mas nao devia*/

insert into categoria_simples values ("");

insert into categoria values (123456789);
insert into categoria_simples values (123456789); /*Funciona mas nao devia*/

insert into categoria_simples values ('1234567890123456789012345678901234567890123456789012345678901234567890');

insert into categoria values ('algo');
insert into categoria_simples values ('algo');
insert into categoria_simples values ('algo');



insert into categoria values ('algo');
insert into categoria values ('algo2');
insert into super_categoria values ('algo', 'algo2');

insert into categoria values ('');
insert into super_categoria values (''); /*Funciona mas nao devia*/

insert into super_categoria values ("");

insert into categoria values (123456789);
insert into super_categoria values (123456789); /*Funciona mas nao devia*/

insert into super_categoria values ('1234567890123456789012345678901234567890123456789012345678901234567890');

insert into categoria values ('algo');
insert into super_categoria values ('algo');
insert into super_categoria values ('algo');

insert into categoria values ('algo');
insert into categoria_simples values ('algo');
insert into super_categoria values ('algo');

insert into categoria values ('algo');
insert into super_categoria values ('algo');
insert into categoria_simples values ('algo');



insert into categoria values ('algo');
insert into super_categoria values ('algo');
insert into constituida (super_categoria, categoria) values ('algo');

insert into categoria values ('algo');
insert into categoria values ('algo2');
insert into categoria values ('algo3');
insert into super_categoria values ('algo');
insert into constituida (super_categoria, categoria) values ('algo', 'algo2', 'algo3');

insert into categoria values ('');
insert into super_categoria values ('');
insert into constituida (super_categoria, categoria) values ('', '');

insert into categoria values ('algo');
insert into super_categoria values ('algo');
insert into constituida (super_categoria, categoria) values ('algo', ''); /* Funciona mas nao devia */

insert into categoria values ('algo');
insert into constituida (super_categoria, categoria) values ('', 'algo'); /* Funciona mas nao devia */

insert into categoria values ('algo');
insert into constituida (super_categoria, categoria) values (1234, 'algo'); /* Funciona mas nao devia */

insert into categoria values ('algo');
insert into super_categoria values ('algo');
insert into constituida (super_categoria, categoria) values ('algo', 1234); /* Funciona mas nao devia */

insert into constituida (super_categoria, categoria) values (1234, 5678); /* Funciona mas nao devia */

insert into constituida (super_categoria, categoria) values ('1234567890123456789012345678901234567890123456789012345678901234567890', 'algo');

insert into constituida (super_categoria, categoria) values ('algo', '1234567890123456789012345678901234567890123456789012345678901234567890');

insert into categoria values ('carne');
insert into categoria values ('vaca');
insert into super_categoria values ('carne');
insert into constituida (super_categoria, categoria) values ('carne', 'vaca');
insert into constituida (super_categoria, categoria) values ('carne', 'vaca');

insert into categoria values ('carne');
insert into categoria values ('vaca');
insert into super_categoria values ('carne');
insert into super_categoria values ('vaca');
insert into constituida (super_categoria, categoria) values ('carne', 'vaca');
insert into constituida (super_categoria, categoria) values ('vaca', 'carne');

insert into categoria values ('algo');
insert into super_categoria values ('algo');
insert into constituida (super_categoria, categoria) values ('algo', 'algo');



insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000000, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000);

insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000000, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', 'frescos', 100000000, date '2017-01-01', 'argumento invalido');

insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000000, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values ( , 'ervilhas', 'frescos', 100000000, date '2017-01-01');

insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000000, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, '', 'frescos', 100000000, date '2017-01-01'); /* Funciona mas nao devia */

insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000000, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', '', 100000000, date '2017-01-01'); /* Funciona mas nao devia*/

insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000000, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', 'frescos', , date '2017-01-01');

insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000000, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', 'frescos', 100000000, date '');

insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000000, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values ( , '', '', , date '');

insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000000, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 1234, 'frescos', 100000000, date '2017-01-01'); /* Funciona mas nao devia */

insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000000, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', 1234, 100000000, date '2017-01-01'); /* Funciona mas nao devia */

insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000000, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values ('1000000000000', 1234, 5678, '100000000', '2017-01-01'); /* Funciona mas nao devia */

insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000000, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (100, 'ervilhas', 'frescos', 100000000, date '2017-01-01');

insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000000, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', 'frescos', 100, date '2017-01-01');

insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000000, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, '1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890', 'frescos', 100000000, date '2017-01-01');

insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000000, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', '1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890', 100000000, date '2017-01-01');

insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000000, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (100000000000000000, 'ervilhas', 'frescos', 100000000, date '2017-01-01');

insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000000, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', 'frescos', 10000000000000000000000, date '2017-01-01');

insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000000, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', 'frescos', 100000000, date '2017-01-01');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', 'frescos', 100000000, date '2017-01-01');



insert into fornecedor (nif, nome) values (100000000);

insert into fornecedor (nif, nome) values (100000000, 'Miguel', 'argumento invalido');

insert into fornecedor (nif, nome) values ( , 'Miguel');

insert into fornecedor (nif, nome) values (100000000, ''); /* Funciona mas nao devia */

insert into fornecedor (nif, nome) values ( , '');

insert into fornecedor (nif, nome) values ('10', 'Miguel');

insert into fornecedor (nif, nome) values (100000000, 1234); /* Funciona mas nao devia */

insert into fornecedor (nif, nome) values ('10', 1234);

insert into fornecedor (nif, nome) values (10, 'Miguel');

insert into fornecedor (nif, nome) values (100000000000000000, 'Miguel');

insert into fornecedor (nif, nome) values (100000000, '1234567890123456789012345678901234567890123456789012345678901234567890');

insert into fornecedor (nif, nome) values (100000000, 'Miguel');
insert into fornecedor (nif, nome) values (100000000, 'Miguel');



insert into fornecedor (nif, nome) values (100000000, 'Pedro');
insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000001, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', 'frescos', 100000000, date '2017-01-01');
insert into fornece_sec (nif, ean) values (100000001);

insert into fornecedor (nif, nome) values (100000000, 'Pedro');
insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000001, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', 'frescos', 100000000, date '2017-01-01');
insert into fornece_sec (nif, ean) values (100000001, 1000000000000, 'argumento invalido');

insert into fornecedor (nif, nome) values (100000000, 'Pedro');
insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000001, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', 'frescos', 100000000, date '2017-01-01');
insert into fornece_sec (nif, ean) values ( , 1000000000000);

insert into fornecedor (nif, nome) values (100000000, 'Pedro');
insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000001, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', 'frescos', 100000000, date '2017-01-01');
insert into fornece_sec (nif, ean) values (100000001, );

insert into fornecedor (nif, nome) values (100000000, 'Pedro');
insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000001, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', 'frescos', 100000000, date '2017-01-01');
insert into fornece_sec (nif, ean) values ( , );

insert into fornecedor (nif, nome) values (100000000, 'Pedro');
insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000001, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', 'frescos', 100000000, date '2017-01-01');
insert into fornece_sec (nif, ean) values ('algo', 1000000000000);

insert into fornecedor (nif, nome) values (100000000, 'Pedro');
insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000001, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', 'frescos', 100000000, date '2017-01-01');
insert into fornece_sec (nif, ean) values (100000001, 'algo');

insert into fornecedor (nif, nome) values (100000000, 'Pedro');
insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000001, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', 'frescos', 100000000, date '2017-01-01');
insert into fornece_sec (nif, ean) values ('algo', 'algo');
/* FASE DE TESTES PAROU AQUI */
insert into fornecedor (nif, nome) values (100000000, 'Pedro');
insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000001, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', 'frescos', 100000000, date '2017-01-01');
insert into fornece_sec (nif, ean) values (10, 1000000000000);

insert into fornecedor (nif, nome) values (100000000, 'Pedro');
insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000001, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', 'frescos', 100000000, date '2017-01-01');
insert into fornece_sec (nif, ean) values (100000001, 100000);

insert into fornecedor (nif, nome) values (100000000, 'Pedro');
insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000001, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', 'frescos', 100000000, date '2017-01-01');
insert into fornece_sec (nif, ean) values (10, 1000);

insert into fornecedor (nif, nome) values (100000000, 'Pedro');
insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000001, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', 'frescos', 100000000, date '2017-01-01');
insert into fornece_sec (nif, ean) values (100000001000000, 1000000000000);

insert into fornecedor (nif, nome) values (100000000, 'Pedro');
insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000001, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', 'frescos', 100000000, date '2017-01-01');
insert into fornece_sec (nif, ean) values (100000001, 100000000000000000000000);

insert into fornecedor (nif, nome) values (100000000, 'Pedro');
insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000001, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', 'frescos', 100000000, date '2017-01-01');
insert into fornece_sec (nif, ean) values (100000001000000, 100000000000000000);

insert into fornecedor (nif, nome) values (100000000, 'Pedro');
insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000001, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', 'frescos', 100000000, date '2017-01-01');
insert into fornece_sec (nif, ean) values (100000001, 1000000000000);
insert into fornece_sec (nif, ean) values (100000001, 1000000000000);

insert into fornecedor (nif, nome) values (100000000, 'Pedro');
insert into categoria values ('frescos');
insert into fornecedor (nif, nome) values (100000001, 'Miguel');
insert into produto (ean, design, categoria, forn_primario, data) values (1000000000000, 'ervilhas', 'frescos', 100000000, date '2017-01-01');
insert into fornece_sec (nif, ean) values (100000000, 1000000000000);

/* A REVISÃO DE INSTRUÇÕES PAROU AQUI */

