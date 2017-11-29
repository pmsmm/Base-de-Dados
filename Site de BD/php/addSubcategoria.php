<?php
	include("Config.php");

	if(!isset($_POST['sub_categoria_name']) || empty($_POST['sub_categoria_name'])){
		echo "Missing Categoria Simples";
		die();
	}

	try{
	    $var=strtolower($_POST['sub_categoria_name']);

		$prepared = $db->prepare("INSERT INTO public.categoria (nome) VALUES (:sub_categoria);");
        $statement = $db->prepare("INSERT INTO public.categoriasimples (nome) VALUES (:sub_categoria);");
	
		$prepared->bindParam(':sub_categoria', $var, PDO::PARAM_STR);
        $statement->bindParam(':sub_categoria', $var, PDO::PARAM_STR);
	
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