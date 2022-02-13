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
        <h2>Listado Ventas</h2>
        <div class="text-right ">
            <a href="<?php echo base_url('platform/ventas/crear') ?>" class="btn-sm btn-primary ">Crear</a>
        </div>
    </header>
    <div class="card-body">
        <div class="adv-table">
            <table class="display table table-bordered table-striped" id="listadoProductos">
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

<?php echo $this->endSection() ?>