<?php
$view->extend('SocialManagerBundle::layout.html.php');
?>
<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('/assetic/'); ?>css/jquery.fileupload.css">
<div id="main" class="mt90">
    <div class="container">
        <div class="row">
            <?php
            echo $view['actions']->render(
                    $view['router']->generate('menuUser', array(), true)
            );
            ?>
            <?php $view['slots']->output('_content'); ?>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('/assetic/'); ?>js/code.js"></script>
<?php /* <script type="text/javascript" src="<?php echo $view['assets']->getUrl('/assetic/'); ?>js/jquery.ui.widget.js"></script> */ ?>
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('/assetic/'); ?>js/jquery.iframe-transport.js"></script>
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('/assetic/'); ?>js/jquery.fileupload.js"></script>