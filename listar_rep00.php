<html>
<head>
    <title>Market Manager</title>
</head>
</body>
     <h3>Listar eventos de reposicao de um produto</h3>

<?php
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist425911";
        $password = "mocabranco";
        $dbname = $user;
    
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sql = "SELECT ean FROM produto;";
    
        $result = $db->query($sql);
    
        echo("<table border=\"0\" cellspacing=\"5\">\n");
        foreach($result as $row)
        {
            echo("<tr>\n");
            echo("<td>{$row['ean']}</td>\n");
            echo("<td><a href=\"listar_rep.php?ean={$row['ean']}\">Listar reposicao</a></td>\n");
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

