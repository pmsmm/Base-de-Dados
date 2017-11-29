<?php
	include("Config.php");

	if(!isset($_POST['rem_cat_simples']) || strcmp($_POST['rem_cat_simples'], '') == 0){
		echo "Missing categoria";
		die();
	}

	try{
		$prepared = $db->prepare("DELETE FROM public.categoria WHERE nome = (:categoria_simp);");
	
		$prepared->bindParam(':categoria_simp', $_POST['rem_cat_simples'], PDO::PARAM_STR);
	
		$prepared->execute();
	}
	catch(PDOException $e){
		handle_sql_errors($e->getMessage());
	}

	header('Location: /~ist425918/Index.php');
	close();
	die();
	
?>