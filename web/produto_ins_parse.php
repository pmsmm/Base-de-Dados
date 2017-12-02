<?php

    
    $ean =$_POST['ean_ins'];
    $design = $_POST['design_ins'];
    $categoria = $_POST['categoria_ins'];
    $nifp = $_POST['nifp_ins'];
    $data = $_POST['fornp_data_ins'];
    $nifs = $_POST['nifs_ins'];


    if(!isset($ean) || empty($ean) || strlen(strval($ean)) != 13){
        echo 'EAN de Produto em Falta!';
        die();
    }
    if(!isset($design) || empty($design)){
        echo 'Designacao de Produto em Falta';
        die();
    }
    if(!isset($categoria) || empty($categoria)){
        echo 'Categoria do Produto em Falta';
        die();
    }
    if(!isset($nifp) || empty($nifp) || strlen(strval($nifp)) != 9){
        echo 'NIF do Fornecedor Primario Em Falta!';
        die();
    }
    if(!isset($data) || empty( $data)){
        echo 'Data do Fornecedor Primario em Falta!';
        die();
    }
    if(!isset($nifs) || empty($nifs)){
    	echo 'NIF do(s) Fornecedor(es) secundario(s) em falta!';
    	die();
    }


    $several_nifs = explode(";", $nifs);
    foreach ($several_nifs as $key => $nifs) {
    	if(strlen($nifs) != 9) {
       		echo 'NIF do(s) Fornecedor(es) secundario(s) incorreto(s)!';
       		die();
       	}
    }


    $nifs = $_POST['nifs_ins'];
    $several_nifs = explode(";", $nifs);
    foreach ($several_nifs as $key => $nifs) {
    	if($nifp == $nifs) {
       		echo 'Fornecedor primario nao pode ser secundario';
       		die();
       	}
    }


    try{

        include("Config.php");
       
        $prepared=$db->prepare("SELECT ean FROM public.produto WHERE ean = :ean;");
        $prepared->bindParam(':ean', $ean, PDO::PARAM_INT);
        $prepared->execute();
        $result = $prepared->fetchAll();
        if($result){
            echo 'Produto ja existe!';
            die();
        }



        $prepared=$db->prepare("SELECT nome FROM public.categoria WHERE nome = :categoria;");
        $prepared->bindParam(':categoria', $categoria, PDO::PARAM_STR);
        $prepared->execute();
        $result = $prepared->fetchAll();
        if(!$result){
            echo 'Categoria nao existe!';
            die();
        }


        $prepared=$db->prepare("SELECT nif FROM public.fornecedor WHERE nif = :nifp;");
        $prepared->bindParam(':nifp', $nifp, PDO::PARAM_INT);
        $prepared->execute();
        $result = $prepared->fetchAll();
        if(!$result){
            echo 'Fornecedor primario nao existe!';
            die();
        }



        $nifs = $_POST['nifs_ins'];
        $several_nifs = explode(";", $nifs);
    	foreach ($several_nifs as $key => $nifs) {
    		$prepared=$db->prepare("SELECT nif FROM public.fornecedor WHERE nif = :nifs;");
			$prepared->bindParam(':nifs', $nifs, PDO::PARAM_INT);
			$prepared->execute();
			$result = $prepared->fetchAll();
			if(!$result){
            	echo 'Fornecedor secundario nao existe!';
            	die();
        	}
       	}

        $db->beginTransaction();
      
        $prepared = $db->prepare("INSERT INTO public.produto VALUES (:ean, :designacao, :categoria, :nif_primario, :data_primario);");
        $statement = $db->prepare("INSERT INTO public.fornece_sec VALUES (:nif_sec, :ean_sec);");
       

        $prepared->bindParam(':ean', $ean, PDO::PARAM_INT);
        $prepared->bindParam(':designacao', $design, PDO::PARAM_STR);
        $prepared->bindParam(':categoria',$categoria , PDO::PARAM_STR);
        $prepared->bindParam(':nif_primario', $nifp, PDO::PARAM_INT);
        $prepared->bindParam(':data_primario',$data , PDO::PARAM_STR);
		$prepared->execute();


        $nifs = $_POST['nifs_ins'];
        $several_nifs = explode(";", $nifs);
    	foreach ($several_nifs as $key => $nifs) {
			$statement->bindParam(':nif_sec', $nifs, PDO::PARAM_INT);
			$statement->bindParam(':ean_sec', $ean, PDO::PARAM_INT);
			$statement->execute();
       	}
 
        $db->commit();

        echo "operacao realizada com sucesso";
      
    }
    catch (PDOException $e){
        $db->rollBack(); 
        handle_sql_errors($e->getMessage());
    }
   
     echo '<form action="/ist425911/index.php">
                        <input type="submit" value="Home" />
                        </form>';
    close();
    die();
?>