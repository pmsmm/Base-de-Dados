<?php
/**
 * Created by PhpStorm.
 * User: Pedro
 * Date: 25/11/2017
 * Time: 19:05
 */
    

    $ean =$_POST['ean'];
    echo("<p>$ean<p>");

     if(!isset($ean) || empty($ean) || strlen(strval($ean)) != 13){
        echo 'EAN de Produto em Falta!';
        die();
    }

    try{

        echo "entrei no try";
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

        echo "comecei transacao";

        $prepared=$db->prepare("DELETE FROM  public.produto WHERE ean = :ean;");
 		$prepared->bindParam(':ean', $ean, PDO::PARAM_INT);
        $prepared->execute();

        $db->commit();

        echo "FUCKING MADE IT <3";

    }
    catch (PDOException $e){
      
         echo("<p>ERROR: {$e->getMessage()}</p>");
    }
    //header('Location: /ist425913/index.php');
     echo '<form action="/ist425913/index.php">
                        <input type="submit" value="Home" />
                        </form>';
    close();
    die();

?>