<?php
    include("Config.php");

    if (!isset($_POST['ean']) || empty(strval($_POST['ean'])) || strlen(strval($_POST['ean'])) != 13){
        echo "EAN em falta!";
        die();
    }

    try{
        $prepared = $db->prepare("SELECT operador, instante, unidades FROM public.reposicao WHERE ean = (:ean_ins);");

        $prepared->bindParam('ean_ins', $_POST['ean'], PDO::PARAM_INT);

        $prepared->execute();

        $result = $prepared->fetchAll();

        echo("<table border=\"1\">\n");
        echo("<tr><td>Operador</td><td>Instante</td><td>Unidades</td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['operador']);
            echo("</td><td>");
            echo($row['instante']);
            echo("</td><td>");
            echo($row['unidades']);
            echo("</td></tr>\n");
        }
        echo("</table>\n");

        echo '<form action="/ist425911/index.php">
                            <input type="submit" value="Home" />
                            </form>';
    }
    catch(PDOException $e){
        handle_sql_errors($e->getMessage());
    }
?>