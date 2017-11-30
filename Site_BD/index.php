

<!DOCTYPE html>
<html>
<head>
	<title>Market Manager</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="main.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
</head>
<body style="background-image: url(Teste.jpg);">
	<div class="jumbotron" style="text-align: center; background: transparent;">
		<h1>Bem Vindos ao Market Manager</h1>
		<p style="color: white;">Bem vindos, preparem-se para a melhor experiência de gestão de supermercados de sempre!</p>
	</div>

	<?php
		session_start();
	?>

	<div class="col-lg-12" id="botao" style="display: none;">
		<button class="button" style="vertical-align:middle; margin-left: 650px; margin-top: 170px;"><span>Começar </span></button>
	</div>

	<div id="escondido">
		<div class="col-lg-12">

			<div class="col-lg-4" style="text-align: center;">

				<h1>Adicionar categorias e subcategorias </h1>
				<form action="add_cat_e_sub.php" method = "post" style="display: inline-block; margin-top;">
					<input type="text" id="categoria" name="supercategoria" placeholder="Nome da Super-Categoria a Adicionar..." style="width: 270px;">
					<p><input type="text" placeholder="Nome da Categoria-Simples a Adicionar..." id="sub_categoria" name="categoria" style="width: 270px;"></p>
					<p><input type="submit" value="Submit"/></p>
					<p>
				</form>

			
				<p>Remover categoria/subcategoria </p>
				<form action="rmCategoria.php" method = "post" style="display: inline-block; margin-top: 15px;">
					<p><input type="text" name="rm_categoria" placeholder="Nome da categoria a remover ..." id="parametro" style="width: 270px;"></p>
					<button>Enter</button>
				</form>

				<br>
				<br>

				<div style="margin-top: 20px;">

					<h6>Alterar designacao produto </h6>
					<form style="display: inline-block;" action="alter_design.php" method="post">
						<input type="number" name="ean" placeholder="Insira o EAN do Produto a Alterar:" style="margin-top: 15px;" id="ean_id">
						<input type="text" name="ean_design" placeholder="Insira a Nova Designação:" style="margin-top: 15px;" id="design_id">
						<button>Enter</button>
					</form>

					<div>
						<div style="border: solid; border-color: black; background-color: red; margin-top: 148px; margin-right: 30px; display: none;" id="cai_temp_bad">
							<h4>Ocorreu Um Problema!</h4>
						</div>

					</div>
				</div>
			</div>

			<div class="col-lg-4" style="text-align: center;">
		

				<div style="margin-top: 20px;">

					<h1>Listar eventos reposicao </h1>
					<form action="listar_repo.php" method="post" style="display: inline-flex;">					
						<input type="text" name="ean" placeholder="Inserir o Nome do Produto a Listar:">
						<button>Enter</button>
					</form>
					<h4>Listar subcatgeorias de superCategoria</h4>
					<form action="listar_cats.php" method="post" style="display: inline-flex; margin-top: 20px;">					
						<input type="text" name="super_categoria" placeholder="Inserir o Nome da Super-Categoria a Listar:">
						<button>Enter</button>
					</form>


				</div>

			</div>

			<div class="col-lg-4">
				<h2>Adicionar produto</h2>
				<form action="produto_ins.php" method="post" style="display: inline-block;">
					<input type="number" id="campo1" name="ean_ins" placeholder="Insira o EAN do Produto:">
					<br>
					<input type="text" id="campo2" name="design_ins" placeholder="Insira a Designação do Produto:">
					<br>
					<input type="text"  id="campo3" name="categoria_ins" placeholder="Insira a Categoria do Produto:">
					<br>
					<input type="number" id="campo4" name="nifp_ins" placeholder="Insira o NIF do Fornecedor Primário:">
					<br>
					<input type="date" id="campo5" name="fornp_data_ins" placeholder="Insira a Data do Fornecedor Primário:">
					<br>
					<input type="text" id="campo6" name="nifs_ins" placeholder="Insira o(s) Fornecedor(es) Secundário(s):">
					<br>
					<div style="text-align: center; margin-right: 110px; margin-top: 10px;">
						<button style="margin-right: 10px;">Adicionar</button>
						<!--<button style="margin-left: 10px;">Remover</button>-->
					</div>
				</form>
				<h3>Remover produto</h3>
       			<form action="produto_rem.php" method="post">
            		<input type="number" name="ean" placeholder="Insira o ean:">
            		<br><input type="submit" value="Submit"/></br>
        		</form>
			</div>
		</div>
	</div>
</body>
</html>



