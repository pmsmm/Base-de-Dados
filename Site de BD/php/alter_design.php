<?php
/**
 * Created by PhpStorm.
 * User: Pedro
 * Date: 25/11/2017
 * Time: 16:17
 */
    include("Config.php");

    if(!isset($_POST['ean'])){
        echo 'Missing EAN!';
        die();
    }

    if(!isset($_POST['ean_design'])){
        echo 'Missing designation to update!';
        die();
    }

    try{
        $prepared=$db->prepare("UPDATE public.produto SET design = (:designacao) WHERE ean = (:ean);");

        $prepared->bindParam(':ean', $_POST['ean'], PDO::PARAM_INT);
        $prepared->bindParam(':designacao', $_POST['ean_design'], PDO::PARAM_STR);

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