<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Stiwar">
    <link rel="shortcut icon" href="img/favicon.png">

    <title> <?php $this->renderSection('title') ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('flatlab/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('flatlab/css/bootstrap-reset.css') ?>" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url('flatlab/assets/font-awesome/css/font-awesome.css') ?>" rel="stylesheet" />
    <!-- Dinamyc table -->
    <link href="<?php echo base_url('flatlab/assets/advanced-datatable/media/css/demo_page.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('flatlab/assets/advanced-datatable/media/css/demo_table.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('flatlab/assets/data-tables/DT_bootstrap.css') ?>" rel="stylesheet" />
    <!--right slidebar-->
    <link href="<?php echo base_url('flatlab/css/slidebars.css') ?>" rel=" stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('flatlab/css/style.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('flatlab/css/style-responsive.css') ?>" rel="stylesheet" />

    <script src="<?php echo base_url('flatlab/js/jquery.js') ?>"></script>
    <script src="<?php echo base_url('flatlab/js/bootstrap.bundle.min.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <?php echo csrf_meta() ?>
</head>