function traerTabla() {
	$.ajax({
		url: ruta + "index.php/Books/tabla",
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
		url: ruta + "index.php/Books/saveBook",
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
		url: ruta + "index.php/Books/deleteBook",
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

$(document).on("click", ".delUs", function(e) {
	var id = $(this)
		.find(".id")
		.val();
	console.log(id);
	$.ajax({
		url: ruta + "index.php/Books/deleteUserOfBook",
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
		url: ruta + "index.php/Books/getBook",
		data: { id: id },
		type: "POST",
		success: function(data, textStatus, jqXHR) {
			alert(data);
			$(".modal-body").load("content.html", function() {
				// $("#modalUpdate").modal({ show: true });
			});
		},
		error: function(error) {
			console.log("error");
			console.log(error);
		}
	});
});
