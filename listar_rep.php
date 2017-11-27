 <html>
    <body>
<?php

 	

    $ean = $_REQUEST['ean'];
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist425911";
        $password = "mocabranco";
        $dbname = $user;
        
        
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $sql = "select operador, instante, unidades from reposicao where ean = $ean;";

        $result = $db->query($sql);
    
        echo("<table border=\"1\">\n");
        echo("<tr><td>operador</td><td>instante</td><td>unidades</td></tr>\n");
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

        $db = null;
    }
    catch (PDOException $e)
    {
        
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>