<?php
$data = extraerMenuJson(); ?>
<aside>
    <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <?php foreach ($data['menu'] as $item) : ?>
                <li>
                    <a href="<?php echo base_url($item['url']) ?>" class="<?php echo $this->renderSection($item['yield']) ?>">
                        <i class="<?php echo $item['icon'] ?>"></i>
                        <span><?php echo $item['label'] ?></span>
                    </a>
                </li>
            <?php endforeach ?>
            <!--multi level menu end-->
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>