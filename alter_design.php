<?php

   
    if(!isset($_POST['ean']) || empty($_POST['ean']) || strlen(strval($_POST['ean'])) != 13){
        echo 'Missing EAN or EAN different from 13 numbers!';
        die();
    }
    if(!isset($_POST['ean_design']) || strcmp($_POST['ean_design'], '') == 0){
        echo 'Missing designation to update!';
        die();
    }
    try{

        include("Config.php");

        $prepared=$db->prepare("SELECT ean FROM public.produto WHERE ean = :ean;");
        $prepared->bindParam(':ean',$_POST['ean'] , PDO::PARAM_INT);
        $prepared->execute();
        $result = $prepared->fetchAll();

        if(!$result){
            echo 'Produto nao existe!';
            die();
        }   

        $var2=($_POST['ean_design']);
        $prepared=$db->prepare("UPDATE public.produto SET design = (:designacao) WHERE ean = (:ean);");
        $prepared->bindParam(':ean', $_POST['ean'], PDO::PARAM_INT);
        $prepared->bindParam(':designacao', $var2, PDO::PARAM_STR);
        $prepared->execute();

        echo "operacao realizada com sucesso";

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