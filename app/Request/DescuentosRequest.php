<?php

namespace App\Request;

use App\Models\DescuentosModel;
use App\Models\ProductosModel;

class DescuentosRequest {
    function Agregar(){
        $descuentos= new DescuentosModel();
        if ($_POST['id'] != 0)
            $descuentos = $descuentos->getById($_POST['id']);

        ?>
        <form id="form" action="<?= route($_POST['model'] . '/save'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
            <div class="row form-group">
                <div class="col-md-6">
                    <label class="control-label">Producto</label>
                    <?php $productos = new ProductosModel();
                      $productos = $productos->getAll('id'); ?>
                      <select class="form-control" name="id_producto">
                        <?php foreach ($productos as $c) {
                          ?> <option value="<?= $c->id; ?>" <?= ($c->id == $descuentos->id_producto)? 'selected' : '' ; ?>> <?= $c->nombre; ?> </option> <?php
                        } ?>
                      </select>

                </div>

                <div class="col-md-6">
                    <label class="control-label">Precio de Descuento</label>
                    <input type="number" name="precio_descuento" id="precio_descuento" value="<?= $descuentos->precio_descuento; ?>" class="form-control" required autocomplete="off">
                </div>

            </div>

            <div class="row form-group">

                <div class="col-md-3">
                    <label class="control-label">Dia Inicio</label>
                    <input type="date" name="dia_inicio" id="dia_inicio" value="<?= $descuentos->dia_inicio; ?>" class="form-control" required autocomplete="off">
                </div>

                <div class="col-md-3">
                    <label class="control-label">Hora Inicio</label>
                    <input type="time" name="hora_inicio" id="hora_inicio" value="<?= $descuentos->hora_inicio; ?>" class="form-control" required autocomplete="off">
                </div>

                <div class="col-md-3">
                    <label class="control-label">Dia Final</label>
                    <input type="date" name="dia_final" id="dia_final" value="<?= $descuentos->dia_final; ?>" class="form-control" required autocomplete="off">
                </div>

                <div class="col-md-3">
                    <label for="surname" class="control-label">Hora Final</label>
                    <input type="time" name="hora_final" id="hora_final" value="<?= $descuentos->hora_final; ?>" class="form-control" required autocomplete="off">
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
        $descuentos = new DescuentosModel();
        $descuentos = $descuentos->getById($_POST['id'],'id'); ?>
        <form id="form" action="<?= route($_POST['model'] . '/del'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $descuentos->id; ?>">
            <h5>Desea eliminar el registro selecionado
                '<?= $descuentos->precio_descuento; ?>
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
        $can = new DescuentosModel();
        $descuentos = $can->getAllDescuentos();
        foreach ($descuentos as $c) { ?>
            <tr>
              <td><?= $c->producto; ?></td>
              <td><?= $c->precio_descuento; ?></td>
              <td><?= date('d/m/Y', strtotime($c->dia_inicio)).' '.date('h:i a', strtotime($c->hora_inicio)); ?></td>
              <td><?= date('d/m/Y', strtotime($c->dia_final)).' '.date('h:i a', strtotime($c->hora_final)); ?></td>
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
