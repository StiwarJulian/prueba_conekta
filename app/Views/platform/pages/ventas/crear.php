<?php echo $this->extend('platform/layouts/app') ?>
<?php echo $this->section('title') ?>
Ventas
<?php echo $this->endSection() ?>
<?php echo $this->section('active-ventas') ?>
active
<?php echo $this->endSection() ?>

<?php echo $this->section('content') ?>
<section class="card">
    <header class="card-header">
        Crear Venta
    </header>
    <div class="card-body">
        <form class="form-horizontal tasi-form" id="formVenta">
            <div class="form-group row">
                <label class="col-sm-2 col-sm-2 control-label">Seleccione el producto*</label>
                <div class="col-sm-10">
                    <select type="text" name="producto" id="producto" class="form-control select2 system_validador_vacio">
                        <option value="">Seleccione una opcion</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-sm-2 control-label">Cantidad Disponible*</label>
                <div class="col-sm-10">
                    <input type="hidden" name="cantidadPermanente" id="cantidadPermanente" readonly>
                    <input type="text" name="cantidadDisponible" id="cantidadDisponible" placeholder="0" class="form-control system_validador_numerico" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-sm-2 control-label">Cantidad*</label>
                <div class="col-sm-10">
                    <input type="text" name="cantidad" id="cantidad" placeholder="Ingresa la cantidad" class="form-control system_validador_vacio system_validador_numerico">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-sm-2 control-label">Precio Unitario*</label>
                <div class="col-sm-10">
                    <input type="text" name="precioUnitario" id="precioUnitario" class="form-control system_validador_vacio system_validador_numerico" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-sm-2 control-label">Total Precio*</label>
                <div class="col-sm-10">
                    <input type="text" name="total" id="total" class="form-control system_validador_vacio system_validador_numerico" readonly>
                </div>
            </div>
            <input type="button" class="btn btn-primary" id="registrarVenta" value="Registrar">
        </form>
    </div>
</section>

<script>
    $(document).ready(function() {
        axios.get("<?php echo base_url('platform/productos/listado') ?>").then(function(resp) {
            resp.data.data.forEach(element => {
                $('#producto').append(`
                    <option value="${element.id}">${element.nombre}</option>
                `);
            });
        });
    });

    $('#producto').on('change', function() {
        let datoABuscar = $(this).val();

        if (datoABuscar.length > 0) {
            axios.get("<?php echo base_url('platform/productos/consultar') ?>/" + datoABuscar).then(function(resp) {
                $('#precioUnitario').val(resp.data.data.precio);
                $('#cantidadDisponible').val(resp.data.data.stock);
                $('#cantidadPermanente').val(resp.data.data.stock);
            });
        } else {
            $('#precioUnitario').val("");
            $('#cantidadDisponible').val("");
            $('cantidadPermanente').val("");
        }
    });

    $('#cantidad').on('change', function() {
        let cantidadIngresada = $(this).val();
        let cantidadDisponible = $('#cantidadPermanente').val();

        if (cantidadIngresada > 0 && parseInt(cantidadIngresada) <= parseInt(cantidadDisponible)) {
            let precioUnitario = $('#precioUnitario').val();

            $('#cantidadDisponible').val(cantidadDisponible - cantidadIngresada);
            $('#total').val(precioUnitario * cantidadIngresada);
        } else {
            $('#total').val("");
            $('#cantidadDisponible').val(cantidadDisponible);
            alert("La cantidad Ingresada es superior a la cantidad disponible");
        }
    });

    $("#registrarVenta").on('click', function() {
        if (system_validarcampos("formVenta")) {
            axios.post('crear', getDataJson("formVenta")).then(function(resp) {
                if (resp.data.error === 0) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'El registro se ha realizado con exito!',
                        showConfirmButton: false,
                        timer: 1500
                    }).finally(() => {
                        window.location.href = "<?php echo base_url('platform/ventas') ?>";
                    });
                } else {
                    notificarUsuario(resp.data.mensaje);
                }
            });
        }
    });
</script>
<?php echo $this->endSection() ?>