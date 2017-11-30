<?php
	$host = "db.ist.utl.pt";
	$user ="ist425918";
	$password = "Pedro1997";
	$dbname = $user;

	$db = new PDO("pgsql:host=" . $host. ";dbname=".$dbname."", $user, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    function handle_sql_errors($error_message)
    {
        echo $error_message;
        echo '<div class="jumbotron" style="text-align: center; background: transparent;">
                <h1>Oh Não, Ocorreu um erro!</h1>
                <p style="color: white;">'+$error_message+'</p>
              </div>
              <form action="/~ist425918/Index.php">
                <input type="submit" value="Home" />
              </form>';
    }
?>