window.addEventListener("load", function(){
	

});

function edit(id,name, status){
	$("#id").val(id);
	$("#Edenominacion").val(name);
	$('#estado option[value="'+ status +'"]').attr("selected",true);
}

function Borrar(id,name){
	$("#nombre").text(name);	
	$("#id_delete").val(id);
	$("#name").val(name);
}



