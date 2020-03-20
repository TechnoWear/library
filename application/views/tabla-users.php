<table class="table table-striped table-bordered" id="example1">
    <thead>
        <tr>
            <th>Name</th>
            <th>email</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $usuario) { ?>
            <tr class="fila">
                <td>
                    <?= trim($usuario['name']) ?>
                </td>
                <td>
                    <?= trim($usuario['email']) ?>
                </td>
                
                <td>
                <button type="button" class="updateModal btn btn-warning" data-toggle="modal" data-target="#exampleModal">
                    update user<input value ="<?= trim($usuario['id']) ?>" type="hidden" class="id">
                </button>
                    <button type="button" class="eliminar btn btn-danger">Delete
                    <input value ="<?= trim($usuario['id']) ?>" type="hidden" class="id"></button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>