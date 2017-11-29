<html>
    <body>
    <h3>Sub-categorias</h3>
<?php


    $super_categoria = $_POST['super_categoria'];
    $categoria = $_REQUEST['categoria'];
    echo("<p>$categoria<p>");
    
    
    try
    {
        include("Config.php");


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
    
        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }

    die();
?>

    </body>
</html>