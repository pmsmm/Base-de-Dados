

<?php


$categoria = $_POST['categoria'];
$supercategoria = $_POST['supercategoria'];

echo("<p>$categoria<p>");
echo("<p>$supercategoria<p>");

if( (!isset($categoria) || empty($categoria)) && (!empty($supercategoria))){
        echo 'Impossivel adicionar super categoria sem subcategoria';
        die();
}

try
{
    include("Config.php");
        
    

	if(((!isset($supercategoria)) || empty($supercategoria)) && (!empty($categoria))){


       
        $prepared = $db->prepare("SELECT * FROM public.categoria WHERE nome = :cat_simples;");
        $prepared->bindParam(':cat_simples', $categoria, PDO::PARAM_STR);
        $prepared->execute();
        $result = $prepared->fetchAll();

        if($result){
         	echo "Categoria ja existe";

        }
        else{

        	$prepared = $db->prepare("INSERT INTO public.categoria VALUES (:categoria);");
            $prepared->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            $prepared->execute();
            $statement = $db->prepare("INSERT INTO public.categoria_simples (nome) VALUES (:cat_simples);");
            $statement->bindParam(':cat_simples', $categoria, PDO::PARAM_STR);
            $statement->execute();

         

        }
	}

	else if( (!empty($supercategoria)) && (!empty($categoria))){

		$prepared = $db->prepare("SELECT * FROM public.categoria WHERE nome = :cat_simples;");
        $prepared->bindParam(':cat_simples', $categoria, PDO::PARAM_STR);
        $prepared->execute();
        $global = $prepared->fetchAll();

        $prepared1 = $db->prepare("SELECT * FROM public.categoria WHERE nome = :super_categoria;");
        $prepared1->bindParam(':super_categoria', $supercategoria, PDO::PARAM_STR);
        $prepared1->execute();
        $global1 = $prepared1->fetchAll();

        $prepared = $db->prepare("SELECT * FROM public.categoria_simples WHERE nome = :cat_simples;");
        $prepared->bindParam(':cat_simples', $categoria, PDO::PARAM_STR);
        $prepared->execute();
        $global2 = $prepared->fetchAll();

        $prepared1 = $db->prepare("SELECT * FROM public.super_categoria WHERE nome = :super_categoria;");
        $prepared1->bindParam(':super_categoria', $supercategoria, PDO::PARAM_STR);
        $prepared1->execute();
        $global3 = $prepared1->fetchAll();

        //se nao existe super nem sub
        if((!$global) && (!$global1)){

        	$prepared = $db->prepare("INSERT INTO public.categoria VALUES (:categoria);");
            $prepared->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            $prepared->execute();

            $prepared = $db->prepare("INSERT INTO public.categoria VALUES (:categoria);");
            $prepared->bindParam(':categoria', $supercategoria, PDO::PARAM_STR);
            $prepared->execute();
         	
         	$prepared = $db->prepare("INSERT INTO public.categoria_simples VALUES (:cat_simples);");
        	$prepared->bindParam(':cat_simples', $categoria, PDO::PARAM_STR);
        	$prepared->execute();
        
        	$prepared1 = $db->prepare("INSERT INTO public.super_categoria VALUES (:super_categoria);");
        	$prepared1->bindParam(':super_categoria', $supercategoria, PDO::PARAM_STR);
        	$prepared1->execute();

        	$statement = $db->prepare("INSERT INTO public.constituida  VALUES (:super_categoria, :categoria);");
            $statement->bindParam(':super_categoria', $supercategoria, PDO::PARAM_STR);
            $statement->bindParam(':categoria', $categoria, PDO::PARAM_STR);
			$statement->execute();
            
        
        	
        }
        //se existe super mas nao existe sub
        else if(($global1) && (!$global)){

            echo "entrei no 1";

        	$prepared = $db->prepare("INSERT INTO public.categoria VALUES (:categoria);");
            $prepared->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            $prepared->execute();

            $prepared = $db->prepare("INSERT INTO public.categoria_simples VALUES (:cat_simples);");
        	$prepared->bindParam(':cat_simples', $categoria, PDO::PARAM_STR);
        	$prepared->execute();


            //esta no sistema e é super
            if($global3){

                echo "entrei onde devia";
            	$statement = $db->prepare("INSERT INTO public.constituida  VALUES (:super_categoria, :categoria);");
            	$statement->bindParam(':super_categoria', $supercategoria, PDO::PARAM_STR);
            	$statement->bindParam(':categoria', $categoria, PDO::PARAM_STR);
				$statement->execute();
            	
           
            }
			//está no sistema e é sub
            else{

                echo "entrei onde n devia";
        	
        		$statement = $db->prepare("DELETE FROM public.categoria_simples  WHERE nome= :categoria;");
            	$statement->bindParam(':categoria', $supercategoria, PDO::PARAM_STR);
            	$statement->execute();

            	$prepared1 = $db->prepare("INSERT INTO public.super_categoria VALUES (:super_categoria);");
        		$prepared1->bindParam(':super_categoria', $supercategoria, PDO::PARAM_STR);
        		$prepared1->execute();

				$statement = $db->prepare("INSERT INTO public.constituida  VALUES (:super_categoria, :categoria);");
            	$statement->bindParam(':super_categoria', $supercategoria, PDO::PARAM_STR);
            	$statement->bindParam(':categoria', $categoria, PDO::PARAM_STR);
				$statement->execute();
            	
            	
            }

        }
        //se nao existe super mas existe sub
        else if((!$global1) && ($global)){


        	$prepared = $db->prepare("SELECT * FROM public.constituida WHERE categoria = :cat_simples;");
        	$prepared->bindParam(':cat_simples', $categoria, PDO::PARAM_STR);
        	$prepared->execute();
        	$result = $prepared->fetchAll();

        	//categoria ja pertence a uma super
        	if($result){
        		echo "subcategoria ja pertence a uma supercategoria";
        	}

        	//é uma categoria simples n ligada
        	else{
        		$prepared = $db->prepare("INSERT INTO public.categoria VALUES (:categoria);");
            	$prepared->bindParam(':categoria', $supercategoria, PDO::PARAM_STR);
            	$prepared->execute();

            	$prepared1 = $db->prepare("INSERT INTO public.super_categoria VALUES (:super_categoria);");
        		$prepared1->bindParam(':super_categoria', $supercategoria, PDO::PARAM_STR);
        		$prepared1->execute();

        		$statement = $db->prepare("INSERT INTO public.constituida  VALUES (:super_categoria, :categoria);");
            	$statement->bindParam(':super_categoria', $supercategoria, PDO::PARAM_STR);
            	$statement->bindParam(':categoria', $categoria, PDO::PARAM_STR);
                $statement->execute();

        	}
        	
        }
 
    	else if(($global1) && ($global)){
 
        	//no caso de serem 2 cat simples uma pode ficar super da outra
            if(($global2) && (!$global3)){

                $statement = $db->prepare("DELETE FROM public.categoria_simples  WHERE nome= :categoria;");
                $statement->bindParam(':categoria', $supercategoria, PDO::PARAM_STR);
                $statement->execute();

                $prepared1 = $db->prepare("INSERT INTO public.super_categoria VALUES (:super_categoria);");
                $prepared1->bindParam(':super_categoria', $supercategoria, PDO::PARAM_STR);
                $prepared1->execute();

                $statement = $db->prepare("INSERT INTO public.constituida  VALUES (:super_categoria, :categoria);");
                $statement->bindParam(':super_categoria', $supercategoria, PDO::PARAM_STR);
                $statement->bindParam(':categoria', $categoria, PDO::PARAM_STR);
                $statement->execute();

            }

        }
                
            
    	
    }
    
}
catch (PDOException $e){
    $db->rollBack(); 
    echo("<p>ERROR: {$e->getMessage()}</p>");
}
    
    echo '<form action="/ist425911/index.php">
                        <input type="submit" value="Home" />
                        </form>';
    close();
    die();

?>


	
