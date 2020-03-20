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
                        if($Libro['user'] == "0") {
                            echo "vacante";
                        } elseif($Libro['user'] == "1") {
                            echo "Ocuped";
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if($Libro['user'] == "0") {
                            echo "";
                        } elseif($Libro['user'] == "1") {
                            echo $Libro['user_name'];
                        }
                    ?>
                </td>
                <td>
                    <button type="button" class="updateModal btn btn-primary" data-toggle="modal" data-target="#modalUpdate">
                        update book
                        <input value ="<?= trim($Libro['id']) ?>" type="hidden" class="id">
                    </button>
                    <button type="button" class="eliminar btn btn-primary">Delete
                    <input value ="<?= trim($Libro['id']) ?>" type="hidden" class="id"></button>
                    
                    <?php
                        if($Libro['user'] != "0") {?>
                           <button type="button" class="delUs btn btn-primary">Delete User
                            <input value ="<?= trim($Libro['id']) ?>" type="hidden" class="id"></button>
                    <?php    } else {?>
                            <button type="button" class="addUs btn btn-primary">Add User
                                <input value ="<?= trim($Libro['id']) ?>" type="hidden" class="id"></button>
                    <?php    }?>   
                    
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>