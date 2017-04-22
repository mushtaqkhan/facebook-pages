<?php
$view->extend('SocialManagerBundle::layout_user.html.php');
?>
<div class="col-md-9">
    <form role="form" method="POST" action="">
        <div class="panel panel-blue">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo $view['translator']->trans('Profile'); ?></h2>
            </div>
            <div class="panel-body">
                <?php if ($error == 1) { ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <?php echo $view['translator']->trans('Change Password Success!'); ?>
                    </div>
                <?php } ?>
                <?php if ($error == 2) { ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <?php echo $view['translator']->trans("Can't Change Password!"); ?>
                    </div>
                <?php } ?>
                <div class="form-group">
                    <label><?php echo $view['translator']->trans("Name"); ?></label>
                    <input type="text" name="name" id="name" class="form-control font14" placeholder="<?php echo $view['translator']->trans("Name"); ?>" value="<?php
                    echo $info->getName();
                    ?>">
                </div>
                <div class="form-group">
                    <label><?php echo $view['translator']->trans("Email"); ?></label>
                    <input type="text" disabled class="form-control font14 disabled" placeholder="<?php echo $view['translator']->trans("Email"); ?>" value="<?php
                    echo $info->getEmail();
                    ?>">
                </div>
                <?php if ($info->getSupper()) { ?>
                    <div class="form-group">
                        <label><?php echo $view['translator']->trans("Admin"); ?></label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="isAdmin" value="0" <?php
                                if ($info && $info->getSupper() == 0) {
                                    echo 'checked';
                                }
                                ?>><?php echo $view['translator']->trans("No"); ?>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="isAdmin" value="1" <?php
                                if ($info && $info->getSupper() == 1) {
                                    echo 'checked';
                                }
                                if (!$info) {
                                    echo "checked";
                                }
                                ?>><?php echo $view['translator']->trans("Yes"); ?>
                            </label>
                        </div>
                    </div>
                <?php } ?>
                <hr class="hrdashed">
                <div class="form-group">
                    <label><?php echo $view['translator']->trans('New password'); ?></label>
                    <input required autocomplete="off" type="password" class="form-control" id="newpass" name="newpass" placeholder="<?php echo $view['translator']->trans('New password'); ?>">
                </div>
                <div class="form-group">
                    <label><?php echo $view['translator']->trans('Confirm new password'); ?></label>
                    <input required autocomplete="off" type="password" class="form-control" id="renewpass" name="renewpass" placeholder="<?php echo $view['translator']->trans('Confirm new password'); ?>">
                </div>
            </div>
            <div class="panel-footer bg-white">
                <button type="submit" class="btn btn-success"><?php echo $view['translator']->trans('Update'); ?></button>
            </div>
        </div>
    </form>
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