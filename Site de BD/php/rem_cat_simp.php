<?php
	include("Config.php");

	if(!isset($_POST['rem_cat_simples']) || empty($_POST['rem_cat_simples'])){
		echo "Missing categoria";
		die();
	}

	try{
	    $var1;

	    $teste=$db->prepare("SELECT super_categoria FROM public.constituida WHERE categoria = (:pesquisa);");

	    $teste->bindParam(':pesquisa', $_POST['rem_cat_simples'], PDO::PARAM_STR);

	    $teste->execute();

	    $teste->fetchAll();
	    foreach ($teste as $row){
	        $var1=$row['super_categoria'];
        }

        $bora=$db->prepare("SELECT categoria FROM public.constituida WHERE supercategoria = (:finalmente);");
        $bora->bindParam(':finalmente', $var1, PDO::PARAM_STR);
        $bora->execute();

        $result=$bora->rowCount();
        if($result = 1){
            echo "Não é possível remover a categoria pretendida pois é a única da supercategoria "+$var1;
            close();
        }
    }catch (PDOException $e){
	    handle_sql_errors($e);
    }

	try{
		$prepared = $db->prepare("DELETE FROM public.categoria WHERE nome = (:categoria_simp);");
	
		$prepared->bindParam(':categoria_simp', $_POST['rem_cat_simples'], PDO::PARAM_STR);
	
		$prepared->execute();
	}
	catch(PDOException $e){
		handle_sql_errors($e);
	}

	header('Location: /~ist425918/Index.php');
	close();
	die();
	
?>