<?php

namespace App\Request;

use App\Models\ProveedoresModel;

class ProveedoresRequest {
    function Agregar(){
        $proveedor = new ProveedoresModel();
        if ($_POST['id'] != 0)
            $proveedor = $proveedor->getById($_POST['id']);

        ?>
        <form id="form" action="<?= route($_POST['model'] . '/save'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
            <div class="row form-group">
                <div class="col-md-4">
                    <label for="surname" class="control-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="<?= $proveedor->nombre; ?>" class="form-control" required autocomplete="off">
                </div>

                <div class="col-md-4">
                    <label for="surname" class="control-label">Telefono</label>
                    <input type="number" name="telefono" id="telefono" value="<?= $proveedor->telefono; ?>" class="form-control" required autocomplete="off">
                </div>

                <div class="col-md-4">
                    <label for="surname" class="control-label">Pagina web</label>
                    <input type="text" name="pagina_web" id="pagina_web" value="<?= $proveedor->pagina_web; ?>" class="form-control" required autocomplete="off">
                </div>

            </div>

            <div class="row form-group">
                <div class="col-md-12">
                    <label for="name" class="control-label">Direccion</label>
                    <input type="text" name="direccion" id="direccion" value="<?= $proveedor->direccion; ?>"
                           class="form-control" required autocomplete="off">
                </div>

            </div>

            <div class="clearfix"></div><hr>
            <div class="form-group">
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </div>
        </form>
        <?php
    }

    function Eliminar(){
        $proveedor = new ProveedoresModel();
        $proveedor = $proveedor->getById($_POST['id'],'id'); ?>
        <form id="form" action="<?= route($_POST['model'] . '/del'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $proveedor->id; ?>">
            <h5>Desea eliminar el proveedor
                '<?= $proveedor->nombre; ?>
                '?</h5>

            <div class="form-group">
              <div class="col-sm-12 text-right">
                  <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-remove"></i>
                      Cancelar
                  </button>
                  <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar</button>
              </div>
            </div>
        </form>
        <?php
    }

    function Refresh(){
        $can = new ProveedoresModel();
        $proveedor = $can->getAll('id');
        foreach ($proveedor as $c) { ?>
            <tr>
              <td><?= $c->nombre ?></td>
              <td><?= $c->direccion; ?></td>
              <td><?= $c->telefono; ?></td>
              <td><?= $c->pagina_web; ?></td>
                <td class="text-center">
                  <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <button type="button" class="btn btn-sm btn-primary" id="option1" data-toggle="modal" data-target="#operationModal" data-id="<?= $c->id; ?>" data-model="<?=$_POST['model']; ?>" data-operation="Editar">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger" id="option2" data-toggle="modal" data-target="#operationModal" data-id="<?= $c->id; ?>" data-model="<?=$_POST['model']; ?>" data-operation="Eliminar">
                        <i class="fa fa-trash"></i>
                    </button>
                  </div>
                </td>
            </tr>
            <?php
        }
    }
}
