<?php
	$host = "db.ist.utl.pt";
	$user ="ist425911";
	$password = "mocabranco";
	$dbname = $user;
	$db = new PDO("pgsql:host=" . $host. ";dbname=".$dbname."", $user, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	function handle_sql_errors(PDOException $error)
    {
        if($error->getCode() == 23505){
            echo '<div style="text-align: center; background: transparent;">
                <h1>Oh Não, Ocorreu um erro!</h1>
                <p style="color: white; text-align: left;">';
            echo 'Um ou mais valores que está a tentar introduzir já se encontram na base de dados!';
            echo '</p>
              </div>';
        }
        else{
        echo '<div style="text-align: center; background: transparent;">
                <h1>Oh Não, Ocorreu um erro!</h1>
                <p style="color: white; text-align: left;">';
            echo("<p>ERROR: {$e->getMessage()}</p>");
            echo '</p>
              </div>';
        }
    }

?>