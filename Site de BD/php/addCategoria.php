<?php
	include("Config.php");

	if(!isset($_POST['categoria_name']) || strcmp($_POST['categoria_name'],'') == 0){
		echo "Missing categoria";
		die();
	}

	try{
		$prepared = $db->prepare("INSERT INTO public.categoria (nome) VALUES (:categoria);");
        $statement = $db->prepare("INSERT INTO public.supercategoria (nome) VALUES (:super_cat);");

		$prepared->bindParam(':categoria', $_POST['categoria_name'], PDO::PARAM_STR);
        $statement->bindParam(':super_cat', $_POST['categoria_name'], PDO::PARAM_STR);

		$prepared->execute();
        $statement->execute();
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