window.addEventListener("load", function(){
	 $("#oficina").change(function(){
		var buscar = $(this).val();
		var form = $("#form-search");
		var url = form.attr('action');
		$("#id").val(buscar);
		var data = form.serialize();	
		$.ajax({          
			url: url,
			type: 'POST',
			data : data,
			success: function(data){
				$("#tramite").html('');
				$("#tramite").append(data);
			}	
		});
		$("#tipo").show();
	});
});