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
			traerTabla();
			$("#name").val("");
			$("#author").val("");
			$("#id_modal").val("");
			// alert(data);
			Swal.fire({
				icon: "success",
				title: data,
				showConfirmButton: false,
				position: "center",
				timer: 2000
			});
		},
		error: function(error) {
			// console.log("error");
			Swal.fire({
				icon: "error",
				title: data,
				showConfirmButton: false,
				position: "center",
				timer: 2000
			});
			console.log(error);
		}
	});
});

$(document).on("click", "#guardar_user", function(e) {
	console.log($("form").serialize());
	$.ajax({
		url: ruta + "index.php/Books/addUser",
		data: $("form").serialize(),
		type: "POST",
		success: function(data, textStatus, jqXHR) {
			traerTabla();
			$("#name").val("");
			$("#author").val("");
			$("#id_modal").val("");
			// alert(data);
			Swal.fire({
				icon: "success",
				title: data,
				showConfirmButton: false,
				position: "center",
				timer: 2000
			});
		},
		error: function(error) {
			// console.log("error");
			Swal.fire({
				icon: "error",
				title: data,
				showConfirmButton: false,
				position: "center",
				timer: 2000
			});
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
			// alert(data);
			Swal.fire({
				icon: "success",
				title: data,
				showConfirmButton: false,
				position: "center",
				timer: 2000
			});
			traerTabla();
		},
		error: function(error) {
			// console.log("error");
			Swal.fire({
				icon: "error",
				title: data,
				showConfirmButton: false,
				position: "center",
				timer: 2000
			});
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
			// alert(data);
			Swal.fire({
				icon: "success",
				title: data,
				showConfirmButton: false,
				position: "center",
				timer: 2000
			});
			traerTabla();
		},
		error: function(error) {
			// console.log("error");
			Swal.fire({
				icon: "error",
				title: data,
				showConfirmButton: false,
				position: "center",
				timer: 2000
			});
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
			var objeto_json = JSON.parse(data);

			$("#name").val(objeto_json.name);
			$("#author").val(objeto_json.author);
			$("#id_modal").val(objeto_json.id);
			$("#id_modal_user").val(objeto_json.id);
		},
		error: function(error) {
			console.log("error");
			console.log(error);
		}
	});
});
