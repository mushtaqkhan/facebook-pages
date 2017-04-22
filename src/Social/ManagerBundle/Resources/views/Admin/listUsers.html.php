<?php
$view->extend('SocialManagerBundle::layout_user.html.php');

$view['slots']->set('title', $view['translator']->trans("List Users"));
?>
<div class="col-md-9">
    <hr class="mb5 mt2">
    <div class="panel panel-blue">
        <div class="panel-heading">
            <h2 class="panel-title">
                <i class="fa fa-archive"></i> <?php echo $view['translator']->trans("List Users"); ?>
            </h2>
        </div>
        <div class="table-responsive panel-collapse pull out">
            <table class="table">
                <thead>
                    <tr>
                        <th><?php echo $view['translator']->trans("ID"); ?></th>
                        <th><?php echo $view['translator']->trans("Name"); ?></th> 
                        <th><?php echo $view['translator']->trans("Facebook"); ?></th> 
                        <th><?php echo $view['translator']->trans("Email"); ?></th>
                        <th><?php echo $view['translator']->trans("View"); ?></th>
                        <th><?php echo $view['translator']->trans("Edit"); ?></th>
                        <th><?php echo $view['translator']->trans("Delete"); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($list) { ?>
                        <?php
                        foreach ($list as $value) {
                            $url = $view['router']->generate('_admin_del_user', array('id' => $value->getId()), true);
                            $urlEdit = $view['router']->generate('_admin_edit_user', array('id' => $value->getId()), true);
                            ?>
                            <tr>
                                <td style="width: 10%"><?php echo $value->getId(); ?></td> 
                                <td style="width: 30%"><?php echo $value->getName(); ?></td>
                                <td style="width: 10%"><?php echo $value->getFacebookId(); ?></td> 
                                <td style="width: 20%"><?php echo $value->getEmail(); ?></td>  
                                <td style="width: 20%"><a target="_blank" href="https://facebook.com/<?php echo $value->getFacebookId(); ?>"><?php echo $view['translator']->trans("View"); ?></a></td> 
                                <td style="width: 20%"><a href="<?php echo $urlEdit; ?>"><?php echo $view['translator']->trans("Edit"); ?></a></td> 
                                <td style="width: 10%"><a onclick="return  confirm('Delete?');" href="<?php echo $url; ?>"><?php echo $view['translator']->trans("Delete"); ?></a></td>
                            </tr>
                            <?php
                        }
                        ?>
                        <?php
                    } else {
                        ?>
                        <tr>
                            <td colspan="3">
                    <center>
                        <?php echo $view['translator']->trans("No Data"); ?>
                    </center>
                    </td>
                    </tr>
                <?php }
                ?> 
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="row">
            <?php
            if ($page["NextPage"] > 1) {
                $urlNext = $view['router']->generate('_admin_user', array(), true);
                ?>
                <ul class="pagination">
                    <?php if ($page["PreviousPage"] != $page["Page"]) { ?>
                        <li class="prev">
                            <a href="<?php echo $urlNext . '?p=' . $page["PreviousPage"]; ?>"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;<?php echo $view['translator']->trans("Prew"); ?></a>
                        </li>
                    <?php } ?>
                    <li class="active"><a><?php echo $page["Page"]; ?></a></li>
                    <?php if ($page["LastPage"] > $page["Page"]) { ?>
                        <li class="next"><a href="<?php echo $urlNext . '?p=' . $page["NextPage"]; ?>"><?php echo $view['translator']->trans("Next"); ?>&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></a></li>
                            <?php } ?>
                </ul>
            <?php } ?>
        </div>
    </div>
</div>