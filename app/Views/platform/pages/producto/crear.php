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
        Crear Producto
    </header>
    <div class="card-body">
        <form class="form-horizontal tasi-form" id="formProducto">
            <div class="form-group row">
                <label class="col-sm-2 col-sm-2 control-label">Nombre*</label>
                <div class="col-sm-10">
                    <input type="text" name="nombre" id="nombre" placeholder="Ingresa el nombre del producto" class="form-control system_validador_vacio">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-sm-2 control-label">Referencia*</label>
                <div class="col-sm-10">
                    <input type="text" name="referencia" id="referencia" placeholder="Ingresa la referencia" class="form-control system_validador_vacio">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-sm-2 control-label">Precio*</label>
                <div class="col-sm-10">
                    <input type="text" name="precio" id="precio" placeholder="Ingresa el precio" class="form-control system_validador_vacio system_validador_numerico">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-sm-2 control-label">Peso*</label>
                <div class="col-sm-10">
                    <input type="text" name="peso" id="peso" placeholder="Ingresa el peso" class="form-control system_validador_vacio system_validador_numerico">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-sm-2 control-label">Categoria*</label>
                <div class="col-sm-10">
                    <input type="text" name="categoria" id="categoria" placeholder="Ingresa la categoria" class="form-control system_validador_vacio">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-sm-2 control-label">Cantidad*</label>
                <div class="col-sm-10">
                    <input type="text" name="cantidad" id="cantidad" placeholder="Ingresa la cantidad" class="form-control system_validador_vacio system_validador_numerico">
                </div>
            </div>

            <input type="button" class="btn btn-primary" id="registrarProducto" value="Registrar">
        </form>
    </div>
</section>

<script>
    $("#registrarProducto").on('click', function() {
        if (system_validarcampos("formProducto")) {
            axios.post('crear', getDataJson("formProducto")).then(function(resp) {
                if (resp.data.error === 0) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'El registro se ha realizado con exito!',
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