<!DOCTYPE html>
<html>
<head>
	<title>Market Manager</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="main.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script type="text/javascript" src="Script.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
</head>
<body style="background-image: url(Teste.jpg);">
	<div class="jumbotron" style="text-align: center; background: transparent;">
		<h1>Bem Vindo ao Market Manager</h1>
		<p style="color: white;">Bem vindo, prepara-se para a melhor experiência de gestão de supermercados de sempre!</p>
	</div>

	<?php
		session_start();
	?>

	<div class="col-lg-12" id="botao" style="display: none;">
		<button class="button" style="vertical-align:middle; margin-left: 650px; margin-top: 170px;" onclick="hide()"><span>Começar </span></button>
	</div>

	<div id="escondido">
		<div class="col-lg-12">

			<div class="col-lg-4" style="text-align: center;">

				<form action="/~ist425918/php/addCategoria.php" method = "post" style="display: inline-block;" onsubmit="return check_param_addCategoria()">
					<input type="text" id="categoria" name="categoria_name" placeholder="Nome da Super-Categoria a Adicionar..." style="width: 270px;">
					<button>Enter</button>
				</form>

				<br>

				<form action="/~ist425918/php/addSubcategoria.php" method = "post" style="display: inline-block; margin-top: 15px;" onsubmit="return check_param_add_Subcategoria()">
					<input type="text" placeholder="Nome da Categoria-Simples a Adicionar..." id="sub_categoria" name="sub_categoria_name" style="width: 270px;">
					<button>Enter</button>
				</form>

				<br>

				<form action="/~ist425918/php/constituida_ins.php" method = "post" style="display: inline-block; margin-top: 15px;" onsubmit="return check_param_addConstituida()">
					<input type="text" name="hierarquia_sup" placeholder="Nome da Super-Categoria de Ordem Superior (Opcional) ..." id="hierarquia">
					<input type="text" name="constituida" placeholder="Nome da Super-Categoria Filha ..." id="parametro">
					<button>Enter</button>
				</form>

				<br>

				<div style="margin-top: 20px;">

					<form style="display: inline-block;" action="/~ist425918/php/alter_design.php" method="post" onsubmit="return check_param_alter_design()">
						<input type="text" name="ean" placeholder="Insira o EAN do Produto a Alterar:" style="margin-top: 15px;" id="ean_id">
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
				<div>

					<form action="/~ist425918/php/rem_sup_cat.php" method="post" style="display: inline-flex;" onsubmit="return check_param_rem_Supcategoria()">					
						<input type="text" name="rem_cat" id="cat_rem" placeholder="Nome da Super-Categoria a Remover...">
						<button>Enter</button>
					</form>

					<br>

					<form action="/~ist425918/php/rem_cat_simp.php" style="display: inline-flex; margin-top: 20px;" method="post" onsubmit="return check_param_rem_Simpcategoria()">
						<input type="text" id="rem_cat_simples_id" name="rem_cat_simples" placeholder="Insira o nome da Sub-Categoria a Remover:">
						<button>Enter</button>
					</form>

				</div>

				<div style="margin-top: 20px;">

					<form action="/php/Remcategoria.php" style="display: inline-flex;">					
						<input type="text" name="categoria" placeholder="Inserir o Nome do Produto a Listar:">
						<button>Enter</button>
					</form>

					<form action="/php/Remcategoria.php" style="display: inline-flex; margin-top: 20px;">					
						<input type="text" name="categoria" placeholder="Inserir o Nome da Super-Categoria a Listar:">
						<button>Enter</button>
					</form>

				</div>

			</div>

			<div class="col-lg-4">
				<form action="/php/Remcategoria.php" style="display: inline-block;">
					<input type="text" id="campo1" name="categoria" placeholder="Insira o EAN do Produto:">
					<br>
					<input type="text" id="campo2" name="sub-categoria" placeholder="Insira a Designação do Produto:">
					<br>
					<input type="text"  id="campo3" name="sub-categoria" placeholder="Insira a Categoria do Produto:">
					<br>
					<input type="text" id="campo4" name="sub-categoria" placeholder="Insira o NIF do Fornecedor Primário:">
					<br>
					<input type="text" id="campo5" name="sub-categoria" placeholder="Insira a Data do Fornecedor Primário:">
					<br>
					<input type="text" id="campo6" name="sub-categoria" placeholder="Insira o(s) Fornecedor(es) Secundário(s):">
					<br>
				<div style="text-align: center; margin-right: 70px; margin-top: 10px;">
					<button style="margin-right: 10px;">Adicionar</button>
					<button style="margin-left: 10px;">Remover</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>