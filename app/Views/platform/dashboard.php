<?php echo $this->extend('platform/layouts/app') ?>
<?php echo $this->section('title'); ?>
Panel Principal
<?php echo $this->endSection(); ?>
<?php echo $this->section('active-dashboard'); ?>
active
<?php echo $this->endSection(); ?>

<?php echo $this->section('content') ?>
<div class="row state-overview">
    <div class="col-lg-6 col-sm-6">
        <section class="card">
            <div class="symbol terques">
                <i class="fa fa-archive"></i>
            </div>
            <div class="value">
                <h1 class="count">
                    <?php echo $cantidadProductos; ?>
                </h1>
                <p>Productos Registrados</p>
            </div>
        </section>
    </div>
    <div class="col-lg-6 col-sm-6">
        <section class="card">
            <div class="symbol yellow">
                <i class="fa fa-credit-card"></i>
            </div>
            <div class="value">
                <h1 class=" count2">
                    <?php echo $cantidadVentas; ?>
                </h1>
                <p>Ventas Registradas</p>
            </div>
        </section>
    </div>
</div>

<!--work progress start-->
<section class="card">
    <div class="card-header">
        <h2>Ultimos Productos</h2>
    </div>
    <div class="card-body">
        <div class="adv-table">
            <table class="display table table-bordered table-striped" id="listadoEmpleados">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Referencia</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Fecha Creacion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto) : ?>
                        <tr>
                            <td><?php echo $producto['nombre']; ?></td>
                            <td><?php echo $producto['referencia']; ?></td>
                            <td><?php echo number_format($producto['precio'], 2); ?></td>
                            <td><?php echo $producto['stock']; ?></td>
                            <td><?php echo $producto['fecha_creacion']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!--work progress end-->

<!--work progress start-->
<section class="card">
    <div class="card-header">
        <h2>Ultimas Ventas</h2>
    </div>
    <div class="card-body">
        <div class="adv-table">
            <table class="display table table-bordered table-striped" id="listadoEmpleados">
                <thead>
                    <tr>
                        <th>Codigo Venta</th>
                        <th>Nombre Producto</th>
                        <th>Cantidad</th>
                        <th>Total Venta</th>
                        <th>Fecha Creacion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ventas as $venta) : ?>
                        <tr>
                            <td><?php echo $venta['id']; ?></td>
                            <td><?php echo $venta['nombre']; ?></td>
                            <td><?php echo $venta['cantidad']; ?></td>
                            <td><?php echo number_format($venta['total'], 2); ?></td>
                            <td><?php echo $venta['fecha_venta']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!--work progress end-->
<?php echo $this->endSection() ?>