<?php
/**
 * Created by PhpStorm.
 * User: Pedro
 * Date: 25/11/2017
 * Time: 19:05
 */
    

    $ean =$_POST['ean_ins'];
    $design = $_POST['design_ins'];
    $categoria = $_POST['categoria_ins'];
    $nifp = $_POST['nifp_ins'];
    $data = $_POST['fornp_data_ins'];
    $nifs = $_POST['nifs_ins'];

    echo("<p>$ean<p>");
    echo("<p>$design<p>");
    echo("<p>$categoria<p>");
    echo("<p>$nifp<p>");
    echo("<p>$data<p>");
    echo("<p>$nifs<p>");


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
        echo 'NIF do Fornecedor Primário Em Falta!';
        die();
    }
    if(!isset($data) || empty( $data)){
        echo 'Data do Fornecedor Primário em Falta!';
        die();
    }
    if(!isset($nifs) || empty($nifs) || strlen(strval($nifs)) != 9){
        echo 'NIF do(s) Fornecedor(es) secundário(s) em falta!';
        die();
    }
    if($nifp == $nifs){
        echo "Fornecedor Primario e secundario nao pode ser o mesmo";
        die();
    }

    try{

        echo "entrei no try";
        include("Config.php");

        

        //$var1=strtolower($_POST['categoria_name']);
        //$var2=strtolower($_POST['design_ins']);
        //$var3=strtolower($_POST['categoria_ins']);
        $prepared=$db->prepare("SELECT ean FROM public.produto WHERE ean = :ean;");
        $prepared->bindParam(':ean', $ean, PDO::PARAM_INT);
        $prepared->execute();
        $result = $prepared->fetchAll();
        if($result){
            echo 'Produto ja existe!';
            die();
        }
        echo "1";

        $prepared=$db->prepare("SELECT categoria FROM public.categoria WHERE nome = :categoria;");
        $prepared->bindParam(':categoria', $categoria, PDO::PARAM_STR);
        $prepared->execute();
        $result = $prepared->fetchAll();
        if(!$result){
            echo 'Categoria nao existe!';
            die();
        }

        echo "2";

        $prepared=$db->prepare("SELECT nif FROM public.fornecedor WHERE nif = :nifp;");
        $prepared->bindParam(':nifp', $nifp, PDO::PARAM_INT);
        $prepared->execute();
        $result = $prepared->fetchAll();
        if(!$result){
            echo 'Fornecedor primario nao existe!';
            die();
        }

        echo "3";

        $prepared=$db->prepare("SELECT nif FROM public.fornecedor WHERE nif = :nifs;");
        $prepared->bindParam(':nifs', $nifs, PDO::PARAM_INT);
        $prepared->execute();
        $result = $prepared->fetchAll();
        if(!$result){
            echo 'Fornecedor secundario nao existe!';
            die();
        }

        $db->beginTransaction();

        echo "comecei transacao";

        echo "estou aqui";

        $prepared = $db->prepare("INSERT INTO public.produto VALUES (:ean, :designacao, :categoria, :nif_primario, :data_primario);");
        $statement = $db->prepare("INSERT INTO public.fornece_sec VALUES (:nif_sec, :ean_sec);");
        //$integrity = $db->prepare("INSERT INTO public.categoria (nome) VALUES (:categoria);")

        //$integrity->bindParam(':categoria',$categoria, PDO::PARAM_STR);
        echo "estou aqui2";

        $prepared->bindParam(':ean', $ean, PDO::PARAM_INT);
        $prepared->bindParam(':designacao', $design, PDO::PARAM_STR);
        $prepared->bindParam(':categoria',$categoria , PDO::PARAM_STR);
        $prepared->bindParam(':nif_primario', $nifs, PDO::PARAM_INT);
        $prepared->bindParam(':data_primario',$data , PDO::PARAM_STR);

        echo "estou aqui3";

        $statement->bindParam(':nif_sec', $nifs, PDO::PARAM_INT);
        $statement->bindParam(':ean_sec', $ean, PDO::PARAM_INT);

        //$integrity->execute();
        $prepared->execute();
        $statement->execute();

        echo "estou aqui4";

        $db->commit();

        echo "FUCKING MADE IT <3";
    }
    catch (PDOException $e){
      
         echo("<p>ERROR: {$e->getMessage()}</p>");
    }
    //header('Location: /ist425911/index.php');
     echo '<form action="/ist425911/index.php">
                        <input type="submit" value="Home" />
                        </form>';
    close();
    die();

?>