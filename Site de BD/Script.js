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
	else if ($("#hierarquia").val() == null || $("#hierarquia").val() == '') {
		show_fail();
		return false;
	}
	else if($("#hierarquia").val() != '' && $("#categoria").val() != '' && $("#categoria").val() != null && $("#hierarquia").val() != null){
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
	else if ($("#sub_categoria").val() == null) {
		show_fail();
		return false;
	}
	else if ($("#sup-cat-id").val() == null) {
		show_fail();
		return false;
	}
	else if ($("#sup-cat-id").val() == '') {
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

function check_param_alter_design() {
	if ($("#ean_id").val() == null || $("#ean_id").val() == '') {
		show_fail();
		return false;
	}
	if ($("#design_id").val() == null || $("#design_id").val() == "") {
		show_fail();
		return false;
	}

	$("#design_id").val() = $("#design_id").val().toLowerCase();
	return true;
}

function insert_new_product() {

	$("#campo2").val()=$("#campo2").val().toLowerCase();
	$("#campo3").val()=$("#campo3").val().toLowerCase();
	$("#campo5").val()=$("#campo5").val().toLowerCase();

	if($("#campo1").val().toString() == "" || $("#campo1").val() == null || $("#campo1").val() < 1000000000000){
		show_fail();
		return false;
	}
	if($("#campo2").val() == "" || $("#campo2").val() == null){
		show_fail();
		return false;
	}
	if($("#campo3").val() == "" || $("#campo3").val() == null){
		show_fail();
		return false;
	}
	if($("#campo4").val().toString() == "" || $("#campo4").val() == null || $("#campo4").val() < 100000000){
		show_fail();
		return false;
	}
	if($("#campo5").val() == "" || $("#campo5").val() == null){
		show_fail();
		return false;
	}
	if($("#campo6").val().toString() == "" || $("#campo6").val() == null || $("#campo6").val() < 100000000){
		show_fail();
		return false;
	}
	if ($("#campo4").val() == $("#campo6").val()) {
		show_fail();
		return false;
	}

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