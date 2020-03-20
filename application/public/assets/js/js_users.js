function traerTabla() {
	$.ajax({
		url: ruta + "index.php/Users/tabla",
		success: function(data, textStatus, jqXHR) {
			$("#tabla").html(data);
		},
		error: function(error) {}
	});
}

$(document).ready(function() {
	traerTabla();
});

$(document).on("click", "#guardar", function(e) {
	console.log($("form").serialize());
	$.ajax({
		url: ruta + "index.php/Users/saveUser",
		data: $("form").serialize(),
		type: "POST",
		success: function(data, textStatus, jqXHR) {
			alert(data);
			traerTabla();
		},
		error: function(error) {
			console.log("error");
			console.log(error);
		}
	});
});

$(document).on("click", ".eliminar", function(e) {
	var id = $(this)
		.find(".id")
		.val();
	console.log(id);
	$.ajax({
		url: ruta + "index.php/Users/deleteUser",
		data: { id: id },
		type: "POST",
		success: function(data, textStatus, jqXHR) {
			alert(data);
			traerTabla();
		},
		error: function(error) {
			console.log("error");
			console.log(error);
		}
	});
});

$(document).on("click", ".updateModal", function(e) {
	var id = $(this)
		.find(".id")
		.val();
	console.log(id);
	$.ajax({
		url: ruta + "index.php/Users/getUser",
		data: { id: id },
		type: "POST",
		success: function(data, textStatus, jqXHR) {
			console.log(data);
			var objeto_json = JSON.parse(data);

			$("#name").val(objeto_json.name);
			$("#email").val(objeto_json.email);
			$("#id_modal").val(objeto_json.id);
		},
		error: function(error) {
			console.log("error");
			console.log(error);
		}
	});
});
