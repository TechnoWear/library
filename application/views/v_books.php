<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- STILES -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<title>Panel</title>
</head>
<body>

<!-- INPUTS -->
<?php
$name = array(
	"name" => "name",
	"type" => "text",
	"id" => "name",
	"class" => "form_control",
	"required" => "true"
);
$author = array(
	"name" => "author",
	"type" => "text",
	"id" => "author",
	"class" => "form_control",
	"required" => "true"
);
$category = array(
	"name" => "category",
	"id" => "category",
	"class" => "form_control",
	"required" => "true"
);
$options [] = [];
foreach($categories as $cat){
	$options[$cat['id']] = $cat["name"];

}

// print_r($options);

?>

<section class="container">
	<div class="row justify-content-center">
		<div class="col-11 col-md-10">
			<!-- BOTONES -->
			<div class="row justify-content-center">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
			New book
			</button>
			</div>

			<!-- TABLA -->
			<div class="row justify-content-center">
				<div id="tabla"></div>
			</div>
		</div>
	</div>
</section>

<!-- MODAL NEW BOOK -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Book</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <?= form_open("form");?><br>
			<?= form_label("Name:");?><br>
			<?= form_input($name);?><br>
			<?= form_label("Author:");?><br>
			<?= form_input($author);?><br>
			<?= form_label("Category:");?><br>
			<?= form_dropdown($category,$options);?><br>
			<input value="none" type="hidden" name="id_modal" id="id_modal">
			<?= form_close();?><br>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="guardar" type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>



<!-- JS -->
<script>
	var ruta = "<?= base_url();?>";
	// console.log(ruta);
</script>

<script src="<?php echo base_url(); ?>application/public/assets/js/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src="<?php echo base_url(); ?>application/public/assets/js/js_books.js"></script>
	
</body>
</html>