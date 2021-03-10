<?php

namespace App\Request;

use App\Models\ProductosModel;
use App\Models\CategoriasModel;
use App\Models\ProveedoresModel;

class ProductosRequest {
    function Agregar(){
        $productos= new ProductosModel();
        if ($_POST['id'] != 0)
            $productos = $productos->getById($_POST['id']);

        ?>
        <form id="form" action="<?= route($_POST['model'] . '/save'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
            <div class="row form-group">
                <div class="col-md-4 ">
                    <label for="name" class="control-label">Codigo</label>
                    <input type="text" name="code" id="code" value="<?= $productos->codigo; ?>"
                           class="form-control" required autocomplete="off">
                </div>
                <div class="col-md-4 ">
                    <label for="surname" class="control-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="<?= $productos->nombre; ?>" class="form-control" required autocomplete="off">
                </div>

                <div class="col-md-4 ">
                    <label for="surname" class="control-label">Modelo</label>
                    <input type="text" name="modelo" id="modelo" value="<?= $productos->modelo; ?>" class="form-control" required autocomplete="off">
                </div>

            </div>

            <div class="row form-group">
                <div class="col-md-12">
                    <label for="surname" class="control-label">Descripcion</label>
                    <textarea class="form-control"  name="des" id="des" rows="6" cols="80"> <?= $productos->descripcion; ?> </textarea>
                </div>

            </div>

            <div class="row form-group">
                <div class="col-md-4 ">
                    <label for="name" class="control-label">Categoia</label>
                    <?php $categoria = new CategoriasModel();
                      $categoria = $categoria->getAll('id'); ?>
                      <select class="form-control" name="categoria">
                        <?php foreach ($categoria as $c) {
                          ?> <option value="<?= $c->id; ?>" <?= ($c->id == $productos->id_categoria)? 'selected' : '' ; ?>> <?= $c->nombre; ?> </option> <?php
                        } ?>
                      </select>

                </div>
                <div class="col-md-4 ">
                    <label for="surname" class="control-label">Precio</label>
                    <input type="number" name="precio" id="precio" value="<?= $productos->precio; ?>" class="form-control" required autocomplete="off">
                </div>

                <div class="col-md-4 ">
                    <label for="surname" class="control-label">Stock</label>
                    <input type="number" name="stock" id="stock" value="<?= $productos->stock; ?>" class="form-control" required autocomplete="off">
                </div>

            </div>

            <div class="row form-group">
                <div class="col-md-6">
                    <label for="name" class="control-label">Proveedor</label>
                    <?php $Proveedor = new ProveedoresModel();
                      $Proveedor = $Proveedor->getAll('id'); ?>
                      <select class="form-control" name="proveedor">
                        <?php foreach ($Proveedor as $c) {
                          ?> <option value="<?= $c->id; ?>" <?= ($c->id == $productos->id_proveedor)? 'selected' : '' ; ?>> <?= $c->nombre; ?> </option> <?php
                        } ?>
                      </select>
                </div>

                <div class="col-md-6">
                    <label for="surname" class="control-label">Imagen</label>
                    <input type="file" name="imagen" id="imagen" class="form-control" >
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
        $productos = new ProductosModel();
        $productos = $productos->getById($_POST['id'],'id'); ?>
        <form id="form" action="<?= route($_POST['model'] . '/del'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $productos->id; ?>">
            <h5>Desea eliminar el producto
                '<?= $productos->nombre; ?>
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
        $can = new ProductosModel();
        $productos = $can->getAll('id');
        foreach ($productos as $c) { ?>
            <tr>
              <td><?= $c->codigo ?></td>
              <td><?= $c->nombre; ?></td>
              <td><?= $c->modelo; ?></td>
              <td><?= $c->stock; ?></td>
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
