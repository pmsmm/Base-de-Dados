<?php
	include("Config.php");

	if(!isset($_POST['rem_cat']) || empty($_POST['rem_cat'])){
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