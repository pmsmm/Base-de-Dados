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
        echo '<form action="/~ist425918/Index.php">
                            <input type="submit" value="Home" />
                            </form>';
    }
?>