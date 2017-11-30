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

        $prepared1=$db->prepare("DELETE FROM public.reposicao WHERE ean = :ean;");
        $prepared2=$db->prepare("DELETE FROM public.planograma WHERE ean = :ean;");
        $prepared3=$db->prepare("DELETE FROM public.fornece_sec WHERE ean = :ean;");
        $prepared4=$db->prepare("DELETE FROM public.produto WHERE ean = :ean;");

 		$prepared1->bindParam(':ean', $ean, PDO::PARAM_INT);
        $prepared2->bindParam(':ean', $ean, PDO::PARAM_INT);
        $prepared3->bindParam(':ean', $ean, PDO::PARAM_INT);
        $prepared4->bindParam(':ean', $ean, PDO::PARAM_INT);

        echo "Deu?";
        $prepared1->execute();
        $prepared2->execute();
        $prepared3->execute();
        $prepared4->execute();
        echo "Deu!";

        $db->commit();

        echo "Sucesso!";

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