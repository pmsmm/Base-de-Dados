<html>
    <body>
    <h3>Sub-categorias</h3>
<?php

    $super_categoria = $_REQUEST['super_categoria'];
    $categoria = $_REQUEST['categoria'];
    
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist425913";
        $password = "cadeira";
        $dbname = $user;
    
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sql = "SELECT super_categoria, categoria FROM constituida WHERE super_categoria = '$super_categoria';";
        $sq2 = "SELECT super_categoria, categoria FROM constituida WHERE super_categoria = '$categoria';";
        
        IF ($categoria == null) {
            $result = $db->query($sql);
        }
        ELSE {
            $result = $db->query($sq2);
        }
    
        echo("<table border=\"0\" cellspacing=\"5\">\n");
        foreach($result as $row)
        {
            echo("<tr>\n");
            echo("<td>{$row['super_categoria']}</td>\n");
            echo("<td>{$row['categoria']}</td>\n");
            echo("<td><a href=\"AlineaE2.php?categoria={$row['categoria']}\">Ver sub-categorias</a></td>\n");
            echo("</tr>\n");
        }
        echo("</table>\n");
    
        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>
        
