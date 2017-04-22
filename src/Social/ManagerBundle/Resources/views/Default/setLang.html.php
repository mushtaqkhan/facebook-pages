<?php
if ($list) {
    $i = 0;
    foreach ($list as $key => $value) {
        $i++;
        ?>
        <li>
            <a style="padding-left: 5px; padding-right: 5px;" href="<?php echo $view['router']->generate('_homepage', array(), true); ?>?lang=<?php echo $value["code"]; ?>">
                <?php echo $value["text"]; ?>
            </a>
        </li>
        <?php
    }
}
?>