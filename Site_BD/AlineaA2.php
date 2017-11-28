<html>
    <body>
<?php
    $categoria_inserir = $_REQUEST['categoria_inserir'];
    $sub_categoria_inserir = $_REQUEST['sub_categoria_inserir'];
    $categoria_remover = $_REQUEST['categoria_remover'];
    $sub_categoria_remover = $_REQUEST['sub_categoria_remover'];
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist425913";
        $password = "cadeira";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->query("START TRANSACTION;");

        $sq1 = "SELECT nome FROM categoria WHERE nome='$categoria_inserir';";
        $sq2 = "SELECT nome FROM categoria WHERE nome='$sub_categoria_inserir';";
        $sq3 = "SELECT nome FROM categoria_simples WHERE nome='$categoria_inserir';";

        $sq4 = "SELECT nome FROM categoria WHERE nome='$categoria_remover';";
        $sq5 = "SELECT nome FROM categoria WHERE nome='$sub_categoria_remover';";
        $sq6 = "SELECT nome FROM categoria_simples WHERE nome='$categoria_remover';";

        echo("<p>A insersao comecou</p>");

        IF ($categoria_inserir != ''){ /*$db é modificada pelo metodo, a query, que tem logo de ser guardada noutra variavel*/
            $result = $db->query($sq1); /*$result guarda agora um iterator, pode ser percorrido com iterator_X()*/

            IF (iterator_count($result) == 0) { /*Conta os elementos desse iterador, 0 se a query der um resultado vazio */
                /*Apenas podemos usar funcoes PDO (um API) como iterator_X(), que da para tudo. Usar pg_X_Y() NAO vai dar*/
                $db->query("INSERT INTO categoria VALUES ('$categoria_inserir');");
                $db->query("INSERT INTO categoria_simples VALUES ('$categoria_inserir');");
            }

            ELSE {
                IF ($sub_categoria_inserir != '') {
                    $result = $db->query($sq2);
                    IF (iterator_count($result) == 0) {
                        $result = $db->query($sq3);
                        IF (iterator_count($result) > 0) {
                            $db->query("DELETE FROM categoria_simples WHERE nome='$categoria_inserir';");
                            $db->query("INSERT INTO super_categoria VALUES ('$categoria_inserir');");
                        }
                        $db->query("INSERT INTO categoria VALUES ('$sub_categoria_inserir');");
                        $db->query("INSERT INTO categoria_simples VALUES ('$sub_categoria_inserir');");
                        $db->query("INSERT INTO constituida(super_categoria, categoria) VALUES ('$categoria_inserir', '$sub_categoria_inserir');");
                    }
                }
            }
        }

        echo("<p>A insersao terminou</p>");

        echo("<p>A remocao comecou</p>");

        IF ($categoria_remover != ''){
            $result = $db->query($sq4);

            IF (iterator_count($result) == 0) {
            
                $db->query("INSERT INTO categoria VALUES ('$categoria_inserir');");
                $db->query("INSERT INTO categoria_simples VALUES ('$categoria_inserir');");
            }

            ELSE {
                IF ($sub_categoria_inserir != '') {
                    $result = $db->query($sq2);
                    IF (iterator_count($result) == 0) {
                        $result = $db->query($sq3);
                        IF (iterator_count($result) > 0) {
                            $db->query("DELETE FROM categoria_simples WHERE nome='$categoria_inserir';");
                            $db->query("INSERT INTO super_categoria VALUES ('$categoria_inserir');");
                        }
                        $db->query("INSERT INTO categoria VALUES ('$sub_categoria_inserir');");
                        $db->query("INSERT INTO categoria_simples VALUES ('$sub_categoria_inserir');");
                        $db->query("INSERT INTO constituida(super_categoria, categoria) VALUES ('$categoria_inserir', '$sub_categoria_inserir');");
                    }
                }
            }
        }

        echo("<p>A remocao terminou</p>");

        $db->query("COMMIT;");

        $db = null;
    }
    catch (PDOException $e)
    {
        $db->query("rollback;");
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>
