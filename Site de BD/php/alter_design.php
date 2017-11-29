<?php
/**
 * Created by PhpStorm.
 * User: Pedro
 * Date: 25/11/2017
 * Time: 16:17
 */
    include("Config.php");

    if(!isset($_POST['ean']) || strcmp($_POST['ean'],'') == 0 || strlen(strval($_POST['ean'])) != 13){
        echo 'Missing EAN or EAN different from 13 numbers!';
        die();
    }

    if(!isset($_POST['ean_design']) || strcmp($_POST['ean_design'], '') == 0){
        echo 'Missing designation to update!';
        die();
    }

    try{
        $var2=strtolower($_POST['ean_design']);

        $prepared=$db->prepare("UPDATE public.produto SET design = (:designacao) WHERE ean = (:ean);");

        $prepared->bindParam(':ean', $_POST['ean'], PDO::PARAM_INT);
        $prepared->bindParam(':designacao', $var2, PDO::PARAM_STR);

        $prepared->execute();
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