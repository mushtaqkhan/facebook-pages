<div class="col-md-3">
    <div class="list-group">
        <?php if ($info && $info->getSupper()) { ?>
            <a class="list-group-item active"><i class="fa fa-list"></i> <?php echo $view['translator']->trans('Administator'); ?></a>
            <a href="<?php echo $view['router']->generate('_admin_page', array(), true); ?>" class="list-group-item <?php if ($userMenu == "_admin_page") { ?>on-select<?php } ?>">
                <i class="fa fa-angle-double-right"></i> <?php echo $view['translator']->trans('List Pages / Groups'); ?>
            </a>
            <a href="<?php echo $view['router']->generate('_admin_feed', array(), true); ?>" class="list-group-item <?php if ($userMenu == "_admin_feed") { ?>on-select<?php } ?>">
                <i class="fa fa-angle-double-right"></i> <?php echo $view['translator']->trans('List Feeds'); ?>
            </a>
            <a href="<?php echo $view['router']->generate('_admin_user', array(), true); ?>" class="list-group-item <?php if ($userMenu == "_admin_user") { ?>on-select<?php } ?>">
                <i class="fa fa-angle-double-right"></i> <?php echo $view['translator']->trans('List Users'); ?>
            </a>
        <?php } ?>
        <a class="list-group-item active"><i class="fa fa-list"></i> <?php echo $view['translator']->trans('Pages / Groups Manager'); ?></a>
        <a href="<?php echo $view['router']->generate('_my_page', array(), true); ?>" class="list-group-item <?php if ($userMenu == "_my_page") { ?>on-select<?php } ?>">
            <i class="fa fa-angle-double-right"></i> <?php echo $view['translator']->trans('My Pages / Groups'); ?>
        </a>

        <a class="list-group-item active"><i class="fa fa-pencil-square"></i> <?php echo $view['translator']->trans('Feeds Manager'); ?></a>
        <a href="<?php echo $view['router']->generate('_my_feed', array(), true); ?>" class="list-group-item <?php if ($userMenu == "_my_feed") { ?>on-select<?php } ?>">
            <i class="fa fa-angle-double-right"></i> <?php echo $view['translator']->trans('My Feeds'); ?>
        </a>
        <a href="<?php echo $view['router']->generate('_new_feed', array("title" => "text"), true); ?>" class="list-group-item <?php if ($userMenu == "_new_feed_text") { ?>on-select<?php } ?>">
            <i class="fa fa-angle-double-right"></i> <?php echo $view['translator']->trans('New Text Feed'); ?>
        </a>
        <a href="<?php echo $view['router']->generate('_new_feed', array("title" => "link"), true); ?>" class="list-group-item <?php if ($userMenu == "_new_feed_link") { ?>on-select<?php } ?>">
            <i class="fa fa-angle-double-right"></i> <?php echo $view['translator']->trans('New Link Feed'); ?>
        </a>
        <a href="<?php echo $view['router']->generate('_new_feed', array("title" => "image"), true); ?>" class="list-group-item <?php if ($userMenu == "_new_feed_image") { ?>on-select<?php } ?>">
            <i class="fa fa-angle-double-right"></i> <?php echo $view['translator']->trans('New Image Feed'); ?>
        </a>
        <a href="<?php echo $view['router']->generate('_new_feed', array("title" => "video"), true); ?>" class="list-group-item <?php if ($userMenu == "_new_feed_video") { ?>on-select<?php } ?>">
            <i class="fa fa-angle-double-right"></i> <?php echo $view['translator']->trans('New Video Feed'); ?>
        </a>

        <a class="list-group-item active"><i class="fa fa-dashboard"></i> <?php echo $view['translator']->trans('Account Settings'); ?></a>
        <a href="<?php echo $view['router']->generate('_user', array(), true); ?>" class="list-group-item <?php if ($userMenu == "profile") { ?>on-select<?php } ?>">
            <i class="fa fa-angle-double-right"></i> <?php echo $view['translator']->trans('Profile'); ?>
        </a>
        <a class="list-group-item" href="<?php echo $view['router']->generate('_logout', array(), true); ?>">
            <i class="fa fa-sign-out"></i> <?php echo $view['translator']->trans("Log out"); ?>
        </a>

    </div>
</div>