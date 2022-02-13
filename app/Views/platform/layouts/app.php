<!DOCTYPE html>
<html lang="es">
<?php echo $this->include('platform/includes/head') ?>

<body>

    <section id="container" class="">
        <!--header start-->
        <?php echo $this->include('platform/includes/header') ?>
        <!--header end-->
        <!--sidebar start-->
        <?php echo $this->include('platform/includes/menu') ?>
        <!--sidebar end-->
        <!--main content start-->

        <section id="main-content">
            <section class="wrapper site-min-height">
                <?php $this->renderSection('content') ?>
            </section>
        </section>
        <!--main content end-->

        <!--footer start-->
        <?php $this->include('platform/includes/footer') ?>
        <!--footer end-->
    </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url('flatlab/js/bootstrap.bundle.min.js') ?>"></script>
    <script class="include" type="text/javascript" src="<?php echo base_url('flatlab/js/jquery.dcjqaccordion.2.7.js') ?>">
    </script>
    <script src="<?php echo base_url('flatlab/js/jquery.scrollTo.min.js') ?>"></script>
    <script src="<?php echo base_url('flatlab/js/jquery.nicescroll.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('flatlab/assets/advanced-datatable/media/js/jquery.dataTables.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('flatlab/assets/data-tables/DT_bootstrap.js') ?>" type="text/javascript"></script>

    <script src="<?php echo base_url('flatlab/js/respond.min.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="<?php echo base_url('js/app_request.js') ?>"></script>
    <script src="<?php echo base_url('js/validador.js') ?>"></script>

    <!--right slidebar-->
    <script src="<?php echo base_url('flatlab/js/slidebars.min.js') ?>"></script>
    <script src="<?php echo base_url('flatlab/js/dynamic_table_init.js') ?>"></script>

    <!--common script for all pages-->
    <script src="<?php echo base_url('flatlab/js/common-scripts.js') ?>"></script>
</body>

</html>