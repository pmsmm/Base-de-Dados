function popup(str){
	window.alert(str);
}

function check_param_addCategoria(){
	if ($("#categoria").val() == "") {
		//popup("O nome da Categoria a inserir não pode ser vazio");
		show_fail();
		return false;
	}
	else if ($("#categoria").val() == null) {
		//popup("O nome da Categoria a inseri não pode ser null");
		show_fail();
		return false;
	}
	else if ($("#hierarquia") == null || $("#hierarquia") == '') {
		show_fail();
		return false;
	}
	else if($("#hierarquia") != '' && $("#categoria") != '' && $("#categoria").val() != null && $("#hierarquia") != null){
		insert_constituida($("#hierarquia").val().toLowerCase(), $("#categoria").val().toLowerCase());
		return false;
	}

	$("#categoria").val() = $("#categoria").val().toLowerCase();
	return true;
}

function check_param_addConstituida(){
	if($("#hierarquia").val() == ""){
		show_fail();
		return false;
	}
	else if($("#hierarquia").val() == null){
		show_fail();
		return false;
	}
	else if($("#parametro").val() == ""){
		show_fail();
		return false;
	}
	else if($("#parametro").val() == null){
		show_fail();
		return false;
	}

	$("#parametro").val()=$("#parametro").val().toLowerCase();	
	$("#hierarquia").val()=$("#hierarquia").val().toLowerCase();
	return true;
}


function check_param_add_Subcategoria() {
	if ($("#sub_categoria").val() == "") {
		show_fail();
		return false;
	}
	else if ($("#sub_categoria") == null) {
		show_fail();
		return false;
	}
	else if ($("#sup-cat-id") == null) {
		show_fail();
		return false;
	}
	else if ($("#sup-cat-id") == '') {
		show_fail();
		return false;
	}

	$("#sup-cat-id").val() = $("#sup-cat-id").val().toLowerCase();
	$("#sub_categoria").val() = $("#sub_categoria").val().toLowerCase();
	return true;
}

function check_param_rem_Supcategoria(){
	if ($("#cat_rem").val() == "") {
		show_fail();
		return false;
	}
	else if ($("#cat_rem").val() == null) {
		show_fail();
		return false;
	}

	$("#cat_rem").val() = $("#cat_rem").val().toLowerCase();
	return true;
}

function check_param_rem_Simpcategoria() {
	if ($("#rem_cat_simples_id").val() == "") {
		show_fail();
		return false;
	}
	else if ($("#rem_cat_simples_id").val() == null) {
		show_fail();
		return false;
	}

	$("#rem_cat_simples_id").val() = $("#rem_cat_simples_id").val().toLowerCase();
	return true;
}

function show_win(){
	$("#cai_temp_good").hide().show();
	setTimeout(function(){
		$("#cai_temp_good").hide();
	}, 2000);
}

function show_fail(){
	$("#cai_temp_bad").hide().show();
	setTimeout(function(){
		$("#cai_temp_bad").hide();
	}, 2000);
}