<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php $view['slots']->output('title', $view['translator']->trans("Facebook Pages/Groups Feeds Manager Pro")) ?></title>
        <meta name="title" content="<?php $view['slots']->output('title', $view['translator']->trans("Facebook Pages/Groups Feeds Manager Pro")) ?>" />
        <meta name="author" content="<?php echo $view['translator']->trans("Tran Doan San"); ?>" />
        <meta name="robots" content="index,follow" />
        <meta name="email" content="laptrinhvien2013@gmail.com" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="<?php echo $view['assets']->getUrl('/assetic/'); ?>images/favico.ico" type="image/x-icon" />
        <!--[if lt IE 9]>
          <script src="<?php echo $view['assets']->getUrl('/assetic/'); ?>js/html5shiv.js"></script>
          <script src="<?php echo $view['assets']->getUrl('/assetic/'); ?>js/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="<?php echo $view['assets']->getUrl('/assetic/'); ?>js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $view['assets']->getUrl('/assetic/'); ?>js/bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo $view['assets']->getUrl('/assetic/'); ?>js/bootstrap-select.min.js"></script>
        <script type="text/javascript" src="<?php echo $view['assets']->getUrl('/assetic/'); ?>js/jquery.ui.widget.js"></script>
        <script type="text/javascript" src="<?php echo $view['assets']->getUrl('/assetic/'); ?>js/moment.min.js"></script>
        <script type="text/javascript" src="<?php echo $view['assets']->getUrl('/assetic/'); ?>js/bootstrap-datetimepicker.min.js"></script>
        <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('/assetic/'); ?>css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('/assetic/'); ?>css/bootstrap-select.min.css">
        <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('/assetic/'); ?>css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('/assetic/'); ?>css/style.css">
        <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('/assetic/'); ?>css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('/assetic/'); ?>css/animate.css">
        <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('/assetic/'); ?>css/summernote.css">
    </head>
    <body>
        <?php /*
          <div id="preloader">
          <div class="loader">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          </div>
          </div>
         * 
         */
        ?>
        <?php
        echo $view['actions']->render(
                $view['router']->generate('menu', array(), true)
        );
        ?>
        <div class="modal fade" id="systemModal" tabindex="-1" role="dialog" aria-labelledby="systemModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div style="text-align: center; padding: 20px 0px;">
                            <img src="<?php echo $view->escape('/assetic/images/'); ?>error.jpg">
                        </div>
                        <h4 style="text-align: center;" id="systemModalText"></h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $view['translator']->trans("Close"); ?></button>
                    </div>
                </div>
            </div>
        </div>
        <?php $view['slots']->output('_content'); ?>
        <div id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p class="footer-copyright">
                            <span class="item">
                                <?php echo $view['translator']->trans("Copyright © 2015") . " " . $view['translator']->trans("Facebook Pages/Groups Feeds Manager Pro"); ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <a class="scrollup" href="javascript:" data-toggle="tooltip" data-placement="top" title="<?php echo $view['translator']->trans("Scroll To Top"); ?>"><i class="fa fa-chevron-up fa-2x"></i></a>
        <script type="text/javascript" src="<?php echo $view['assets']->getUrl('/assetic/'); ?>js/main.js"></script>
        <script type="text/javascript" src="<?php echo $view['assets']->getUrl('/assetic/'); ?>js/summernote.js"></script>
        <script type="text/javascript" src="<?php echo $view['assets']->getUrl('/assetic/'); ?>js/wysiwyg.js"></script>
        <script type="text/javascript" src="<?php echo $view['assets']->getUrl('/assetic/'); ?>js/jquery.lazyload.min.js"></script>
    </body>
</html>