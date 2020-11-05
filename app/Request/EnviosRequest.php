<?php

namespace App\Request;

use App\Models\EnviosModel;

class EnviosRequest {
    function Agregar(){
        $envios = new EnviosModel();
        if ($_POST['id'] != 0)
            $envios = $envios->getById($_POST['id']);

        ?>
        <form id="form" action="<?= route($_POST['model'] . '/save'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
            <div class="row form-group">
                <div class="col-md-6">
                    <label for="surname" class="control-label">Codigo Postal</label>
                    <input type="text" name="cp" id="cp" value="<?= $envios->cp; ?>" class="form-control" required autocomplete="off">
                </div>

                <div class="col-md-6">
                    <label for="surname" class="control-label">Precio Envio</label>
                    <input type="number" name="precio" id="precio" value="<?= $envios->precio; ?>" class="form-control" required autocomplete="off">
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
        $envios = new EnviosModel();
        $envios = $envios->getById($_POST['id'],'id'); ?>
        <form id="form" action="<?= route($_POST['model'] . '/del'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $envios->id; ?>">
            <h5>Desea eliminar el registro
                '<?= $envios->cp; ?>
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
        $can = new EnviosModel();
        $envios = $can->getAll('id');
        foreach ($envios as $c) { ?>
            <tr>
              <td><?= $c->cp; ?></td>
              <td><?= $c->precio; ?></td>
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
