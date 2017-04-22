<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <i class="fa fa-align-justify fa-2x"></i>
            </button>

            <a class="navbar-brand" style="padding-top: 5px;" href="<?php echo $view['router']->generate('_homepage', array(), true); ?>">
                <i class="fa fa-facebook-square fa-2x color-blue"></i>
            </a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <?php
                echo $view['actions']->render(
                        $view['router']->generate('_set_lang', array(), true)
                );
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right<?php
            if (!$check) {
                echo " mtop8";
            }
            ?>">
                    <?php if (!$check) { ?>
                    <a class="btn white" data-toggle="modal" data-target=".popup-signup"><?php echo $view['translator']->trans("Sign up"); ?></a>
                    <a data-toggle="modal" data-target=".popup-signin" class="btn blue bold mleft10"><?php echo $view['translator']->trans("Log in"); ?></a>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<?php if (!$check) { ?>
    <div class="modal fade popup-signup" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content rd3">
                <div class="modal-body">
                    <center><h3><?php echo $view['translator']->trans("Create Account"); ?></h3></center>
                    <br>
                    <form class="form-horizontal" method="POST" autocomplete="off" action="<?php echo $view['router']->generate('register', array(), true); ?>">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <a class="btn btn-default facebook btn-lg" href="<?php echo $fbRegister; ?>">
                                    <i class="fa fa-facebook"></i> <?php echo $view['translator']->trans("Sign up with Facebook"); ?>
                                </a>
                            </div>
                        </div>
                        <hr>
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

    <div class="modal fade popup-signin" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content rd3">
                <div class="modal-body">
                    <center><h3><?php echo $view['translator']->trans("Login"); ?></h3></center>
                    <br>
                    <form class="form-horizontal" method="POST" autocomplete="off" action="<?php echo $view['router']->generate('_login', array(), true); ?>">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <a class="btn btn-default facebook btn-lg" href="<?php echo $fbRegister; ?>">
                                    <i class="fa fa-facebook"></i> <?php echo $view['translator']->trans("Log in with Facebook"); ?>
                                </a>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="email" autocomplete="off" class="form-control input-lg font14" id="username" name="username" required placeholder="<?php echo $view['translator']->trans("Email address"); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="password" autocomplete="off" class="form-control input-lg font14" id="password" name="password" required placeholder="<?php echo $view['translator']->trans("Password"); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn blue btn-lg font14 width100"><?php echo $view['translator']->trans("Log in"); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>