<?php
	include("Config.php");

	if(!isset($_POST['sub_categoria_name']) || !isset($_POST['super-cat'])){
		echo "Missing Sub-Categoria or Super Categoria da Categoria Simples";
		die();
	}

	try{
		$prepared = $db->prepare("INSERT INTO public.categoria (nome) VALUES (:sub_categoria);");
	
		$prepared->bindParam(':sub_categoria', $_POST['sub_categoria_name'], PDO::PARAM_STR);
	
		$prepared->execute();
	}
	catch(PDOException $e){
		handle_sql_errors($e->getMessage());
	}

	try{
		$prepared = $db->prepare("INSERT INTO public.categoriasimples (nome) VALUES (:sub_categoria);");
	
		$prepared->bindParam(':sub_categoria', $_POST['sub_categoria_name'], PDO::PARAM_STR);
	
		$prepared->execute();
	}
	catch(PDOException $e){
		handle_sql_errors($e->getMessage());
	}

	try{
	    $prepared = $db->prepare("INSERT INTO public.constituida (snome, cnome) VALUES (:super, :sub);");

	    $prepared->bindParam(':super', $_POST['super-cat'], PDO::PARAM_STR);
	    $prepared->bindParam(':sub', $_POST['sub_categoria_name'], PDO::PARAM_STR);

	    $prepared->execute();
    }catch (PDOException $e){
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