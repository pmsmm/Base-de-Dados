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

	header('Location: /~ist425918/Index.php');
	close();
	die();
	
?>