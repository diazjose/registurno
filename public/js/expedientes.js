window.addEventListener("load", function(){
	$("#btn-from").click(function(){
		var	buscar = $("#buscar_form").val();
		console.log(buscar);
		
		$("#resultado").remove("table");
		$("#resultado").hide();
		$('#spinner').show();
		
		setTimeout(function(){
			$('#spinner').hide();
			$("#resultado").show();				
		    $("#resultado").html('<h3 class="text-danger">¡¡ No existe nungun expediente con el N° '+buscar+' !! <i class="far fa-sad-tear"></i></h3>');
		    $("#buscar_form").val('');
		}, 2000);	
	});

});
/*

function buscar(){
	var	buscar = $("#buscar_form").val();
	console.log(buscar);
	
	$("#resultado").remove("table");
	$("#resultado").hide();
	$('#spinner').show();
	
	setTimeout(function(){
		$('#spinner').hide();
		$("#resultado").show();				
	    $("#resultado").html('<h3 class="text-danger">¡¡ No existe nungun expediente con el N° '.$buscar.' !! <i class="far fa-sad-tear"></i></h3>');
	    $("#buscar_form").val('');
	}, 2000);
}*/