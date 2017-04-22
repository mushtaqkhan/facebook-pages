<div id="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center top100 color-white">
                    <h1>
                        <?php echo $view['translator']->trans("Facebook Pages/Groups Feeds Manager Pro"); ?>
                    </h1>
                </div>
            </div>

            <div class="col-lg-1"></div>
            <div class="col-lg-6">

                <div class="benefits">
                    <ul class="list-unstyled">
                        <li style="margin-top: 40px;">
                            <i class="fa fa-newspaper-o fa-2x" style="padding-right: 15px;"></i> 
                            <span class="spanIn">
                                <?php echo $view['translator']->trans("4 methods can use for feed to facebook..."); ?>
                            </span>
                        </li>
                        <li style="margin-top: 30px;">
                            <i class="fa fa-newspaper-o fa-2x" style="padding-right: 15px;"></i> 
                            <span class="spanIn">
                                <?php echo $view['translator']->trans("Feeds to Pages / Groups you manager."); ?>
                            </span>
                        </li>
                        <li style="margin-top: 30px;">
                            <i class="fa fa-newspaper-o fa-2x" style="padding-right: 15px;"></i> 
                            <span class="spanIn">
                                <?php echo $view['translator']->trans("Custom Manager or delete page, group don't wan't feed."); ?>
                            </span>
                        </li>
                        <li style="margin-top: 30px;">
                            <i class="fa fa-newspaper-o fa-2x" style="padding-right: 15px;"></i> 
                            <span class="spanIn">
                                <?php echo $view['translator']->trans("Simple Admin management users, feeds hostory."); ?>
                            </span>
                        </li>
                        <li style="margin-top: 30px;">
                            <i class="fa fa-newspaper-o fa-2x" style="padding-right: 15px;"></i> 
                            <span class="spanIn">
                                <?php echo $view['translator']->trans("Made easy and fastest to deploy your feeds to facebook."); ?>
                            </span>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="col-lg-4">
                <form class="form-horizontal signup" autocomplete="off" method="POST" action="<?php echo $view['router']->generate('register', array(), true); ?>">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <a class="btn btn-default facebook btn-lg" href="<?php echo $fbRegister; ?>">
                                <i class="fa fa-facebook"></i> <?php echo $view['translator']->trans("Sign up with Facebook"); ?>
                            </a>
                        </div>
                    </div>
                    <hr class="hr9">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="email" autocomplete="off" required class="form-control input-lg font14" id="email" name="email" placeholder="<?php echo $view['translator']->trans("Email address"); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="password" autocomplete="off" required class="form-control input-lg font14" id="password" name="password" placeholder="<?php echo $view['translator']->trans("Password"); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn blue btn-lg font14 width100"><?php echo $view['translator']->trans("Sign up for free"); ?></button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<?php if ($notice) { ?>
    <div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div style="text-align: center; padding: 20px 0px;">
                        <img src="<?php echo $view->escape('/assetic/images/'); ?>error.jpg">
                    </div>
                    <h4 style="text-align: center;">
                        <?php echo $notice; ?>
                    </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $view['translator']->trans("Close"); ?></button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#noticeModal').modal('show');
    </script>
<?php } ?>
