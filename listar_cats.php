<html>
    <body>
    <h3>Sub-categorias</h3>
<?php



    $super_categoria = $_POST['super_categoria'];
    $categoria = $_REQUEST['categoria'];
    echo("<p>$categoria<p>");
    
    if((!isset($super_categoria) || empty($super_categoria)) && (!isset($categoria) || empty($categoria))) {
        echo "Nome da Super Categoria a Listar em Falta";
        die();
    }
    if (isset($categoria) && (!empty($categoria))) {
        $super_categoria = $categoria;
    }

    try
    {
        include("Config.php");


        $prepared=$db->prepare("SELECT nome FROM public.categoria WHERE nome = :categoria;");
        $prepared->bindParam(':categoria', $super_categoria, PDO::PARAM_STR);
        $prepared->execute();
        $result = $prepared->fetchAll();
        if(!$result){
            echo 'Super Categoria nao existe!';
            die();
        }


        $prepared1=$db->prepare("SELECT super_categoria, categoria FROM public.constituida WHERE super_categoria = :super_categoria;");
        $prepared2=$db->prepare("SELECT super_categoria, categoria FROM public.constituida WHERE super_categoria = :categoria;");

        $prepared1->bindParam(':super_categoria', $super_categoria, PDO::PARAM_STR);
        $prepared2->bindParam(':categoria', $categoria, PDO::PARAM_STR);


        
        if ($categoria == null) {
            $prepared1->execute();
            $result = $prepared1->fetchAll();
        }
        else {
            $prepared2->execute();
            $result = $prepared2->fetchAll();
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
    catch (PDOException $e)
    {
        handle_sql_errors($e->getMessage());
    }
    close();
    die();
?>

    </body>
</html>