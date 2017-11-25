<?php
/**
 * Created by PhpStorm.
 * User: Pedro
 * Date: 25/11/2017
 * Time: 19:05
 */
    include("Config.php");

    if(!isset($_POST['ean_ins'])){
        echo 'EAN de Produto em Falta!';
        die();
    }

    if(!isset($_POST['design_ins'])){
        echo 'Designação de Produto em Falta';
        die();
    }

    if(!isset($_POST['categoria_ins'])){
        echo 'Categoria do Produto em Falta';
        die();
    }

    if(!isset($_POST['nifp_ins'])){
        echo 'NIF do Fornecedor Primário Em Falta!';
        die();
    }

    if(!isset($_POST['fornp_data_ins'])){
        echo 'Data do Fornecedor Primário em Falta!';
        die();
    }

    if(!isset($_POST['nifs_ins'])){
        echo 'NIF do(s) Fornecedor(es) secundário(s) em falta!';
        die();
    }

    try{
        $prepared = $db->prepare("INSERT INTO public.produto VALUES (:ean, :designacao, :nif_primario, :data_primario, :categoria);");

        $statement = $db->prepare("INSERT INTO public.fornecedor_sec VALUES (:nif_sec, :ean_sec);");

        $statement->bindParam(':nif_sec', $_POST['nifs_ins'], PDO::PARAM_INT);
        $statement->bindParam(':ean_sec', $_POST['ean_ins'], PDO::PARAM_INT);

        $prepared->bindParam(':ean', $_POST['ean_ins'], PDO::PARAM_INT);
        $prepared->bindParam(':designacao', $_POST['design_ins'], PDO::PARAM_STR);
        $prepared->bindParam(':categoria', $_POST['categoria_ins'], PDO::PARAM_STR);
        $prepared->bindParam(':nif_primario', $_POST['nifp_ins'], PDO::PARAM_INT);
        $prepared->bindParam(':data_primario', $_POST['fornp_data_ins'], PDO::PARAM_STR);

        $prepared->execute();
        $statement->execute();
    }
    catch (PDOException $e){
        handle_sql_errors($e->getMessage());
    }

    function handle_sql_errors($error_message)
    {
        echo $error_message;
        echo '<form action="/~ist425918/Index.php">
                        <input type="submit" value="Home" />
                        </form>';
        die();
    }

    header('Location: /~ist425918/Index.php');
    close();
    die();
