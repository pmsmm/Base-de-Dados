<?php
	include("Config.php");

	if(!isset($_POST['rem_cat_simples']) || empty($_POST['rem_cat_simples'])){
		echo "Missing categoria";
		die();
	}

    $var1;

	try{
	    echo "VOU TESTAR ESTA CENA";

	    $teste=$db->prepare("SELECT super_categoria FROM public.constituida WHERE categoria = (:pesquisa);");

	    $teste->bindParam(':pesquisa', $_POST['rem_cat_simples'], PDO::PARAM_STR);

	    $teste->execute();

	    echo "TESTEI AGORA VAMOS VER O RESULTADO";

	    $temp = $teste->fetchAll();

	    echo $temp;

	    foreach ($temp as $row){
	        echo "dentro do foreach";
	        echo $row['super_categoria'];
	        $var1=$row['super_categoria'];
	        echo $var1;
        }

        echo "Vamos ver a var1";
        echo $var1;
    }catch(PDOException $e){
        handle_sql_errors($e);
    }

    try{
        echo "SEGUNDA QUERIE ESTAMOS NESSA";

        $bora=$db->prepare("SELECT categoria FROM public.constituida WHERE super_categoria = (:finalmente);");
        echo "PREPARADO";
        $bora->bindParam(':finalmente', $var1, PDO::PARAM_STR);
        echo "BINDADO";
        if($bora->execute()){
            echo "Isto realmente funcionou";
        }
        else{
            echo "well fudeu";
        }

        echo "Executei a segunda procura";

        $result=$bora->rowCount();

        echo "Número de linhas";
        echo $result;

        if($result == 1){
            echo "Não é possível remover a categoria pretendida pois é a única da supercategoria";
            close();
        }
    }catch (PDOException $e){
            handle_sql_errors($e);
    }

	try{
        echo "Oh shit";

		$prepared = $db->prepare("DELETE FROM public.categoria WHERE nome = (:categoria_simp);");
	
		$prepared->bindParam(':categoria_simp', $_POST['rem_cat_simples'], PDO::PARAM_STR);
	
		$prepared->execute();
	}
	catch(PDOException $e){
		handle_sql_errors($e);
	}

	//header('Location: /~ist425918/Index.php');
	//close();
	//die();
	
?>