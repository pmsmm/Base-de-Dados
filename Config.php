<?php
	$host = "db.ist.utl.pt";
	$user ="ist425911";
	$password = "mocabranco";
	$dbname = $user;
	$db = new PDO("pgsql:host=" . $host. ";dbname=".$dbname."", $user, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	function handle_sql_errors($error)
    {
     
        echo '<div style="text-align: center; background: transparent;">
                <h1>Oh Nao, Ocorreu um erro!</h1>
                <p style="color: white; text-align: left;">';
            echo("<p>ERROR: {$error}</p>");
            echo '</p>
              </div>';
    }

?>