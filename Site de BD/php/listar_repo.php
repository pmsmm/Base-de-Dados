<?php
/**
 * Created by PhpStorm.
 * User: Pedro
 * Date: 28/11/2017
 * Time: 16:15
 */

    include("Config.php");

    if (!isset($_POST['ean']) || strcmp(strval($_POST['ean']),'') == 0 || strlen(strval($_POST['ean'])) != 13){
        echo "EAN em falta!";
        die();
    }

    try{
        $prepared = $db->prepare("SELECT evento_reposicao.operador, evento_reposicao.instante, unidades FROM public.evento_reposicao, public.reposicao WHERE ean = (:ean_ins)");

        $prepared->bindParam('ean_ins', $_POST['ean'], PDO::PARAM_INT);

        $prepared->execute();

        $result = $prepared->fetchAll();

        $temp = $prepared->fetch();
        echo ($temp);

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
        echo '<form action="/~ist425918/Index.php">
                        <input type="submit" value="Home" />
                        </form>';
    }
    catch(PDOException $e){
        handle_sql_errors($e->getMessage());
    }

    function handle_sql_errors($error_message)
    {
        echo $error_message;
        echo '<form action="/~ist425918/Index.php">
                        <input type="submit" value="Home" />
                        </form>';
        die();
    }