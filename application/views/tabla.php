<table class="table table-striped table-bordered" id="example1">
    <thead>
        <tr>
            <th>Name</th>
            <th>Author</th>
            <th>Category</th>
            <th>Status</th>
            <th>User</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $Libro) { ?>
            <tr class="fila">
                <td>
                    <?= trim($Libro['name']) ?>
                </td>
                <td>
                    <?= trim($Libro['author']) ?>
                </td>
                <td>
                    <?= trim($Libro['category']) ?>
                </td>
                <td>
                    <?php
                        if($Libro['user'] != "0") {
                            echo "Ocuped";
                        } else {
                            echo "Vacante";
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if($Libro['user'] != "0") {
                            echo $Libro['user_name'];
                        } else {
                            echo "";
                        }
                    ?>
                </td>
                <td>
                    <button type="button" class="updateModal btn btn-warning" data-toggle="modal" data-target="#exampleModal">
                        update book
                        <input value ="<?= trim($Libro['id']) ?>" type="hidden" class="id">
                    </button>
                    <button type="button" class="eliminar btn btn-danger">Delete
                    <input value ="<?= trim($Libro['id']) ?>" type="hidden" class="id"></button>
                    
                    <?php
                        if($Libro['user'] != "0") {?>
                           <button type="button" class="delUs btn btn-danger">Delete User
                            <input value ="<?= trim($Libro['id']) ?>" type="hidden" class="id"></button>
                    <?php    } else {?>
                        <button type="button" class="updateModal btn btn-success" data-toggle="modal" data-target="#exampleModal_user">
                        Add User
                        <input value ="<?= trim($Libro['id']) ?>" type="hidden" class="id">
                    <?php    }?>   
                    
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>