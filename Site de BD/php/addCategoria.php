<?php
	include("Config.php");

	if(!isset($_POST['categoria_name']) || empty($_POST['categoria_name'])){
		echo "Missing categoria";
		die();
	}

	try{
        $var=strtolower($_POST['categoria_name']);

		$prepared = $db->prepare("INSERT INTO public.categoria (nome) VALUES (:categoria);");
        $statement = $db->prepare("INSERT INTO public.supercategoria (nome) VALUES (:super_cat);");

		$prepared->bindParam(':categoria', $var, PDO::PARAM_STR);
        $statement->bindParam(':super_cat', $var, PDO::PARAM_STR);

		$prepared->execute();
        $statement->execute();
	}
	catch(PDOException $e){
		handle_sql_errors($e->getMessage());
	}

	header('Location: /~ist425918/Index.php');
	close();
	die();
	
?>