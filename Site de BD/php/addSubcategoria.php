<?php
	include("Config.php");

	if(!isset($_POST['sub_categoria_name']) || strcmp($_POST['sub_categoria_name'],'') == 0){
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