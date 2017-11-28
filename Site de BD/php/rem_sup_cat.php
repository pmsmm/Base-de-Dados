<?php
	include("Config.php");

	if(!isset($_POST['rem_cat']) || strcmp($_POST['rem_cat'], '') == 0){
		echo "Missing categoria";
		die();
	}

	try{
		$prepared = $db->prepare("DELETE FROM public.categoria WHERE nome = (:categoria_rem);");
	
		$prepared->bindParam(':categoria_rem', $_POST['rem_cat'], PDO::PARAM_STR);
	
		$prepared->execute();
	}
	catch(PDOException $e){
		handle_sql_errors($e->getMessage());
	}

	function handle_sql_errors($error_message)
	{
	    echo $error_message;
	    echo '<form action="/~ist425918/Index.php">
    			<input type="submit" value="Home" />
				</form>';
	    die();
	}

	header('Location: /~ist425918/Index.php');
	close();
	die();
	
?>