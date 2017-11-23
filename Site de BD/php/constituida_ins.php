<?php
/**
 * Created by PhpStorm.
 * User: Pedro
 * Date: 23/11/2017
 * Time: 23:19
 */
    include("Config.php");

    if(!isset($_POST['hierarquia_sup']) || !isset($_POST['categoria_name'])){
        echo "Missing Data!";
        die();
    }

    if (isset($_POST['hierarquia_sup']) && $_POST['hierarquia_sup'] != '') {
        try{
            $prepared = $db->prepare("INSERT INTO public.constituida (snome, cnome) VALUES (:sup_categoria, :sub_categoria);");

            $prepared->bindParam(':sub_categoria', $_POST['categoria_name'], PDO::PARAM_STR);
            $prepared->bindParam(':sup_categoria', $_POST['hierarquia_sup'], PDO::PARAM_STR);

            $prepared->execute();
        }
        catch(PDOException $e){
            handle_sql_errors($e->getMessage());
        }
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
