<?php
$view->extend('SocialManagerBundle::layout.html.php');
echo $view['actions']->render(
        $view['router']->generate('indexFixed', array(), true)
);
?>