<?php
	include("Config.php");

	if(!isset($_POST['categoria_name'])){
		echo "Missing categoria";
		die();
	}

	try{
		$prepared = $db->prepare("INSERT INTO public.categoria (nome) VALUES (:categoria);");
	
		$prepared->bindParam(':categoria', $_POST['categoria_name'], PDO::PARAM_STR);
	
		$prepared->execute();
	}
	catch(PDOException $e){
		handle_sql_errors($e->getMessage());
	}

	try{
		$prepared = $db->prepare("INSERT INTO public.supercategoria (nome) VALUES (:categoria);");
	
		$prepared->bindParam(':categoria', $_POST['categoria_name'], PDO::PARAM_STR);
	
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