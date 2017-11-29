<?php
/**
 * Created by PhpStorm.
 * User: Pedro
 * Date: 25/11/2017
 * Time: 19:05
 */
    include("Config.php");

    if(!isset($_POST['ean_ins']) || strcmp($_POST['ean_ins'], '') == 0 || strlen(strval($_POST['ean_ins'])) != 13){
        echo 'EAN de Produto em Falta!';
        die();
    }

    if(!isset($_POST['design_ins']) || strcmp($_POST['design_ins'], '') == 0){
        echo 'Designação de Produto em Falta';
        die();
    }

    if(!isset($_POST['categoria_ins']) || strcmp($_POST['categoria_ins'], '') == 0){
        echo 'Categoria do Produto em Falta';
        die();
    }

    if(!isset($_POST['nifp_ins']) || strcmp($_POST['nifp_ins'], '') == 0 || strlen(strval($_POST['nifp_ins'])) != 9){
        echo 'NIF do Fornecedor Primário Em Falta!';
        die();
    }

    if(!isset($_POST['fornp_data_ins']) || strcmp($_POST['fornp_data_ins'], '') == 0){
        echo 'Data do Fornecedor Primário em Falta!';
        die();
    }

    if(!isset($_POST['nifs_ins']) || strcmp($_POST['nifs_ins'], '') == 0 || strlen(strval($_POST['nifs_ins'])) != 9){
        echo 'NIF do(s) Fornecedor(es) secundário(s) em falta!';
        die();
    }

    try{
        $var1=strtolower($_POST['categoria_name']);
        $var2=strtolower($_POST['design_ins']);
        $var3=strtolower($_POST['categoria_ins']);

        $prepared = $db->prepare("INSERT INTO public.produto VALUES (:ean, :designacao, :nif_primario, :data_primario, :categoria);");

        $statement = $db->prepare("INSERT INTO public.fornecedor_sec VALUES (:nif_sec, :ean_sec);");

        $integrity = $db->prepare("INSERT INTO public.categoria (nome) VALUES (:categoria);");

        $statement->bindParam(':nif_sec', $_POST['nifs_ins'], PDO::PARAM_INT);
        $statement->bindParam(':ean_sec', $_POST['ean_ins'], PDO::PARAM_INT);

        $integrity->bindParam(':categoria', $var1, PDO::PARAM_STR);

        $prepared->bindParam(':ean', $_POST['ean_ins'], PDO::PARAM_INT);
        $prepared->bindParam(':designacao', $var2, PDO::PARAM_STR);
        $prepared->bindParam(':categoria', $var3, PDO::PARAM_STR);
        $prepared->bindParam(':nif_primario', $_POST['nifp_ins'], PDO::PARAM_INT);
        $prepared->bindParam(':data_primario', $_POST['fornp_data_ins'], PDO::PARAM_STR);

        $statement->execute();
        $integrity->execute();
        $prepared->execute();
    }
    catch (PDOException $e){
        $statement = $db->prepare("DELETE FROM public.fornecedor_sec WHERE nif = (:nif_sec) AND ean = (:ean_sec);");

        $integrity = $db->prepare("DELETE FROM public.categoria WHERE nome = (:categoria);");

        $statement->bindParam(':nif_sec', $_POST['nifs_ins'], PDO::PARAM_INT);
        $statement->bindParam(':ean_sec', $_POST['ean_ins'], PDO::PARAM_INT);

        $integrity->bindParam(':categoria', $_POST['categoria_name'], PDO::PARAM_STR);

        $statement->execute();
        $integrity->execute();

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
