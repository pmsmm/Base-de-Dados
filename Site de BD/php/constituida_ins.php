<?php
/**
 * Created by PhpStorm.
 * User: Pedro
 * Date: 23/11/2017
 * Time: 23:19
 */
    include("Config.php");

    if(!isset($_POST['hierarquia_sup']) || !isset($_POST['constituida']) || empty($_POST['hierarquia_sup']) || empty($_POST['constituida'])){
        echo "Missing Data!";
        die();
    }

    try{
        $var1=strtolower($_POST['hierarquia_sup']);
        $var2=strtolower($_POST['constituida']);

        $prepared = $db->prepare("INSERT INTO public.constituida VALUES (:sup_categoria, :sub_categoria);");

        $prepared->bindParam(':sup_categoria', $var1, PDO::PARAM_STR);
        $prepared->bindParam(':sub_categoria', $var2, PDO::PARAM_STR);

        $prepared->execute();
    }
    catch(PDOException $e){
        handle_sql_errors($e);
    }

    header('Location: /~ist425918/Index.php');
    close();
    die();
