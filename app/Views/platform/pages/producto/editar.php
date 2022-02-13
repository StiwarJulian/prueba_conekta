<?php echo $this->extend('platform/layouts/app') ?>
<?php echo $this->section('title') ?>
Productos
<?php echo $this->endSection() ?>
<?php echo $this->section('active-productos') ?>
active
<?php echo $this->endSection() ?>

<?php echo $this->section('content') ?>

<section class="card">
    <header class="card-header">
        Actualizar Producto

    </header>
    <div class="card-body">
        <form class="form-horizontal tasi-form" id="formProducto">
            <input type="hidden" name="id" value="<?php echo $producto['id'] ?>">
            <div class="form-group row">
                <label class="col-sm-2 col-sm-2 control-label">Nombre*</label>
                <div class="col-sm-10">
                    <input type="text" name="nombre" id="nombre" value="<?php echo $producto['nombre']; ?>" placeholder="Ingresa el nombre del producto" class="form-control system_validador_vacio">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-sm-2 control-label">Referencia*</label>
                <div class="col-sm-10">
                    <input type="text" name="referencia" id="referencia" value="<?php echo $producto['referencia']; ?>" placeholder="Ingresa la referencia" class="form-control system_validador_vacio">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-sm-2 control-label">Precio*</label>
                <div class="col-sm-10">
                    <input type="text" name="precio" id="precio" value="<?php echo $producto['precio']; ?>" placeholder="Ingresa el precio" class="form-control system_validador_vacio system_validador_numerico">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-sm-2 control-label">Peso*</label>
                <div class="col-sm-10">
                    <input type="text" name="peso" id="peso" value="<?php echo $producto['peso']; ?>" placeholder="Ingresa el peso" class="form-control system_validador_vacio system_validador_numerico">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-sm-2 control-label">Categoria*</label>
                <div class="col-sm-10">
                    <input type="text" name="categoria" id="categoria" value="<?php echo $producto['categoria']; ?>" placeholder="Ingresa la categoria" class="form-control system_validador_vacio">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-sm-2 control-label">Cantidad*</label>
                <div class="col-sm-10">
                    <input type="text" name="cantidad" id="cantidad" value="<?php echo $producto['stock']; ?>" placeholder="Ingresa la cantidad" class="form-control system_validador_vacio system_validador_numerico">
                </div>
            </div>

            <input type="button" class="btn btn-primary" id="actualizarProducto" value="actualizar">
        </form>
    </div>
</section>

<script>
    $("#actualizarProducto").on('click', function() {
        if (system_validarcampos("formProducto")) {
            axios.put('', getDataJson("formProducto")).then(function(resp) {
                if (resp.data.error === 0) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'La actualizacion se ha realizado con exito!',
                        showConfirmButton: false,
                        timer: 1500
                    }).finally(() => {
                        window.location.href = "<?php echo base_url('platform/productos') ?>";
                    });
                } else {
                    notificarUsuario(resp.data.mensaje);
                }
            });
        }
    });
</script>
<?php echo $this->endSection() ?>