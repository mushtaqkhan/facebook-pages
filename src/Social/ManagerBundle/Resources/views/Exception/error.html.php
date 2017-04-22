<?php
$view->extend('SocialManagerBundle::layout.html.php');
?>
<?php $view['slots']->set('title', $view['translator']->trans("Not Found.")) ?>
<div id="main" class="mt90">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h1 style="color: #006c9a;"><?php echo $view['translator']->trans("Error 404!"); ?></h1>
                <h3 style="color: #006c9a;"><?php echo $view['translator']->trans("Not Found."); ?></h3>
                <a href="<?php echo $view['router']->generate('_homepage', array(), true); ?>" class="btn btn-white"><?php echo $view['translator']->trans("Back Homepage"); ?></a>
            </div>
        </div>
    </div>
</div>