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
        <h2>Listado Productos</h2>
        <div class="text-right ">
            <a href="<?php echo base_url('platform/productos/crear') ?>" class="btn-sm btn-primary ">Crear</a>
        </div>
    </header>
    <div class="card-body">
        <div class="adv-table">
            <table class="display table table-bordered table-striped" id="listadoProductos">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Referencia</th>
                        <th>Precio</th>
                        <th>Peso</th>
                        <th>Categoria</th>
                        <th>Cantidad</th>
                        <th>Fecha Creacion</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto) : ?>
                        <tr>
                            <td><?php echo $producto['nombre']; ?></td>
                            <td><?php echo $producto['referencia']; ?></td>
                            <td><?php echo number_format($producto['precio'], 2); ?></td>
                            <td><?php echo $producto['peso']; ?></td>
                            <td><?php echo $producto['categoria']; ?></td>
                            <td><?php echo $producto['stock']; ?></td>
                            <td><?php echo $producto['fecha_creacion']; ?></td>
                            <td class="text-center">
                                <a href="<?php echo base_url('platform/productos/editar/' . $producto['id']); ?>"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php echo $this->endSection() ?>