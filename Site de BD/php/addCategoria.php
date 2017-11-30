<?php
	include("Config.php");

	if(!isset($_POST['categoria_name']) and !isset($_POST['sub_categoria_name']) || empty($_POST['categoria_name'])){
		echo "Missing categoria";
		die();
	}

    if(!isset($_POST['sub_categoria_name']) || empty($_POST['sub_categoria_name'])){
        echo "Missing Categoria Simples";
        die();
    }

	try{
        if(isset($_POST['categoria_name']) && isset($_POST['sub_categoria_name']) and !empty($_POST['sub_categoria_name']) and !empty($_POST['categoria_name'])){

            $var1=strtolower($_POST['categoria_name']);
            $var2=strtolower($_POST['sub_categoria_name']);

            try{
                $db->beginTransaction();

                $prepared = $db->prepare("INSERT INTO public.categoria (nome) VALUES (:categoria);");

                $prepared->bindParam(':categoria', $var1, PDO::PARAM_STR);

                $prepared->execute();

                $db->commit();
            }catch (PDOException $e){
                $db->rollBack();
                handle_sql_errors($e->getMessage());
            }

            try{
                $db->beginTransaction();

                $prepared1 = $db->prepare("INSERT INTO public.categoria (nome) VALUES (:categoria);");

                $prepared1->bindParam(':categoria', $var2, PDO::PARAM_STR);

                $prepared1->execute();

                $db->commit();
            }catch(PDOException $e){
                $db->rollBack();
                handle_sql_errors($e->getMessage());
            }

            try{
                $db->beginTransaction();

                $statement = $db->prepare("INSERT INTO public.supercategoria (nome) VALUES (:super_cat);");
                $statement1 = $db->prepare("INSERT INTO public.categoriasimples (nome) VALUES (:super_cat);");

                $statement->bindParam(':super_cat', $var1, PDO::PARAM_STR);
                $statement1->bindParam(':super_cat', $var2, PDO::PARAM_STR);

                $statement->execute();
                $statement1->execute();

                $db->commit();
            }catch(PDOException $e){
                $db->rollBack();
                handle_sql_errors($e->getMessage());
            }

            try{
                $db->beginTransaction();

                $constituida = $db->prepare('INSERT INTO public.constituida VALUES (:cat, :sub);');

                $constituida->bindParam(':cat', $var1, PDO::PARAM_STR);
                $constituida->bindParam(':sub', $var2, PDO::PARAM_STR);

                $constituida->execute();

                $db->commit();
            }catch (PDOException $e){
                $db->rollBack();
                handle_sql_errors($e->getMessage());
            }
        }
        if (isset($_POST['sub_categoria_name']) and empty($_POST['categoria_name'])){

            $var2=strtolower($_POST['sub_categoria_name']);

            echo $var2;
            echo 'ENTREI ONDE DEVIA PORRA';

            try{
                $db->beginTransaction();

                $prepared = $db->prepare("INSERT INTO public.categoria (nome) VALUES (:categoria);");

                $prepared->bindParam(':categoria', $var2, PDO::PARAM_STR);

                $prepared->execute();

                $db->commit();
            }catch (PDOException $e){
                $db->rollBack();
                handle_sql_errors($e->getMessage());
            }

            try{
                $db->beginTransaction();

                $statement1 = $db->prepare("INSERT INTO public.categoriasimples (nome) VALUES (:super_cat);");

                $statement1->bindParam(':super_cat', $var2, PDO::PARAM_STR);

                $statement1->execute();

                $db->commit();
            }catch (PDOException $e){
                $db->rollBack();
                handle_sql_errors($e->getMessage());
            }
        }
	}
	catch(PDOException $e){
		handle_sql_errors($e->getMessage());
	}

	//header('Location: /~ist425918/Index.php');
	//close();
	//die();
	
?>