<?php


	$categoria = $_POST['rm_categoria'];

	echo("<p>$categoria<p>");

	if( (!isset($categoria)) || empty($categoria)){
		echo 'Insira uma categoria';
		die();	
	}

	try
	{
    	include("Config.php");


    	$prepared=$db->prepare("SELECT * FROM public.categoria WHERE nome = :categoria;");
        $prepared->bindParam(':categoria', $categoria, PDO::PARAM_STR);
        $prepared->execute();
        $result = $prepared->fetchAll();
        if(!$result){
            echo "Categoria nao existe!";
            die();
        }


    	$prepared = $db->prepare("SELECT * FROM public.categoria_simples WHERE nome = :cat_simples;");
        $prepared->bindParam(':cat_simples', $categoria, PDO::PARAM_STR);
        $prepared->execute();
        $global1 = $prepared->fetchAll();

        $prepared1 = $db->prepare("SELECT * FROM public.super_categoria WHERE nome = :super_categoria;");
        $prepared1->bindParam(':super_categoria', $categoria, PDO::PARAM_STR);
        $prepared1->execute();
        $global2 = $prepared1->fetchAll();

    
        $statement = $db->prepare("SELECT count(super_categoria) FROM public.constituida  WHERE super_categoria in (
        	SELECT super_categoria FROM constituida WHERE categoria = :categoria);");
        $statement->bindParam(':categoria', $categoria, PDO::PARAM_STR);
		$statement->execute();
		$row = $statement -> fetch(PDO::FETCH_ORI_FIRST);
		$count= $row['count'];

	
		if($global1){

			//categoria simples sem pais
			if($count==0){
		
				$statement = $db->prepare("DELETE FROM public.categoria  WHERE nome= :categoria;");
            	$statement->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            	$statement->execute();

            	echo "operacao realizada com sucesso";
			}
		
			//categoria simples com dadies
			elseif($count >=2){
				
				$statement = $db->prepare("DELETE FROM public.categoria  WHERE nome= :categoria;");
            	$statement->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            	$statement->execute();
			}
			else{
				echo" Nao pode apagar categoria(filha unica)";
			}
		}
	
		if($global2){
		//super root
			if($count==0){

				$statement = $db->prepare("DELETE FROM public.categoria  WHERE nome= :categoria;");
            	$statement->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            	$statement->execute();

            	echo "operacao realizada com sucesso";

			}
			else{
				echo "Nao pode apagar supercategoria. nao e root";
			}
		}

	}

    catch (PDOException $e){
      
         handle_sql_errors($e->getMessage());
    }
   
     echo '<form action="/ist425911/index.php">
                        <input type="submit" value="Home" />
                        </form>';
    close();
    die();

?>


