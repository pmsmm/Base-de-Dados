<?php


    $ean =$_POST['ean'];

     if(!isset($ean) || empty($ean) || strlen(strval($ean)) != 13){
        echo 'EAN de Produto em Falta!';
        die();
    }

    try{

        include("Config.php");

   
        $prepared=$db->prepare("SELECT ean FROM public.produto WHERE ean = :ean;");
        $prepared->bindParam(':ean', $ean, PDO::PARAM_INT);
        $prepared->execute();
        $result = $prepared->fetchAll();
        if(!$result){
            echo 'Produto nao existe!';
            die();
        }

        $db->beginTransaction();


        $prepared=$db->prepare("DELETE FROM  public.produto WHERE ean = :ean;");
 		$prepared->bindParam(':ean', $ean, PDO::PARAM_INT);
        $prepared->execute();

        echo "operacao realizada com sucesso";

        $db->commit();

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