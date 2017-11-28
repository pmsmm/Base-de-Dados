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

        $sq0 = "SELECT F.nome FROM fornecedor F, categoria C WHERE F.nome = C.nome";
        $sq1 = "SELECT nome FROM categoria WHERE nome='$categoria_inserir';";
        $sq2 = "SELECT nome FROM categoria WHERE nome='$sub_categoria_inserir';";
        $sq3 = "SELECT nome FROM categoria_simples WHERE nome='$categoria_inserir';";

        $db->query($sq0);
        $original = $db;

        echo("<p>A transacao comecou</p>");

        IF ($categoria_inserir != ''){
            $db->query($sq1);
            $result = $db;

            IF ($result == $original) { /*Supostamente ele entra aqui quando ja a query retorna algo*/
                $db->query("INSERT INTO categoria VALUES ('$categoria_inserir');");
                $db->query("INSERT INTO categoria_simples VALUES ('$categoria_inserir');");
            }

            ELSE {
                IF ($sub_categoria_inserir != '') {
                    $db->query($sq2);
                    IF (pg_num_rows($db) == 0) {
                        $db->query($sq3);
                        IF (pg_num_rows($db) > 0) {
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

        echo("<p>A transacao terminou</p>");

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
