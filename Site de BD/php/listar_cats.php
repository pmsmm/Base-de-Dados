<?php
/**
 * Created by PhpStorm.
 * User: Pedro
 * Date: 29/11/2017
 * Time: 00:49
 */

    include ('Config.php');

    if(!isset($_POST['categoria']) || empty($_POST['categoria'])){
        echo "Nome da Super Categoria a Listar em Falta";
        die();
    }

    try{
        $var=strtolower($_POST['categoria']);

        $prepared=$db->prepare("SELECT super_categoria, categoria FROM public.constituida WHERE super_categoria = (:cat);");
        $statement=$db->prepare("SELECT super_categoria, categoria FROM public.constituida WHERE super_categoria = (:fixe);");

        if(!isset($_REQUEST['categoria_sub'])){
            $prepared->bindParam(':cat', $var, PDO::PARAM_STR);
            $prepared->execute();
            $result=$prepared->fetchAll();
        }
        else{
            $statement->bindParam(':fixe', $_REQUEST['categoria_sub'], PDO::PARAM_STR);
            $statement->execute();
            $result=$prepared->fetchAll();
        }

        echo("<table border=\"0\" cellspacing=\"5\">\n");
        foreach($result as $row)
        {
            echo("<tr>\n");
            echo("<td>{$row['super_categoria']}</td>\n");
            echo("<td>{$row['categoria']}</td>\n");
            echo("<td><a href=\"listar_cats.php?categoria={$row['categoria']}\">Ver sub-categorias</a></td>\n");
            echo("</tr>\n");
        }
        echo("</table>\n");
    }
    catch (PDOException $e){
        handle_sql_errors($e->getMessage());
    }

    close();
    die();
    