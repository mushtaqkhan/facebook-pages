<?php
$view->extend('SocialManagerBundle::layout_user.html.php');

$view['slots']->set('title', $view['translator']->trans("My Feeds"));
?>
<div class="col-md-9">
    <div class="panel panel-blue">
        <div class="panel-heading">
            <h2 class="panel-title"><i class="fa fa-archive"></i> <?php echo $view['translator']->trans("My Feeds"); ?></h2>
        </div>
        <div class="table-responsive panel-collapse pull out">
            <table class="table">
                <thead>
                    <tr>
                        <th><?php echo $view['translator']->trans("Type"); ?></th>
                        <th><?php echo $view['translator']->trans("Page / Group Name"); ?></th> 
                        <th><?php echo $view['translator']->trans("Page / Group Id"); ?></th>
                        <th><?php echo $view['translator']->trans("Schedule Feed"); ?></th>
                        <th><?php echo $view['translator']->trans("Status"); ?></th>
                        <th><?php echo $view['translator']->trans("View"); ?></th>
                        <th><?php echo $view['translator']->trans("Delete"); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($list) { ?>
                        <?php
                        foreach ($list as $value) {
                            $url = $view['router']->generate('_del_feed', array('u_id' => $value->getId()), true);
                            $urlEdit = $view['router']->generate('_edit_feed', array('u_id' => $value->getId(), 'title' => $value->getTypeFeed()), true);
                            $urlView = "";
                            if ($value->getFeedId()) {
                                $tmp = explode("_", $value->getFeedId());
                                if ($value->getTypePage() == "Group") {
                                    $urlView = "https://www.facebook.com/groups/" . $tmp[0] . "/permalink/" . $tmp[1] . "/";
                                } else {
                                    $urlView = "https://www.facebook.com/permalink.php?story_fbid=" . $tmp[1] . "&id=" . $tmp[0] . "";
                                }
                            }
                            ?>
                            <tr>
                                <td style="width: 10%"><?php echo ucfirst($value->getTypeFeed()); ?></td> 
                                <td style="width: 35%"><?php echo $value->getName(); ?></td> 
                                <td style="width: 20%"><?php echo $value->getPId(); ?></td> 
                                <td style="width: 15%"><?php echo date("d/m/Y H:i:s", $value->getTimePost()); ?></td> 
                                <td style="width: 10%"><?php echo ($value->getStatus() == 1) ? $view['translator']->trans("Feeded") : "<font color='red'>" . $view['translator']->trans("Pending") . "</font>"; ?></td> 
                                <td style="width: 5%"><a target="_blank" href="<?php echo $urlView; ?>"><?php echo $view['translator']->trans("View"); ?></a></td>
                                <td style="width: 5%"><a onclick="return  confirm('Delete?');" href="<?php echo $url; ?>"><?php echo $view['translator']->trans("Delete"); ?></a></td>
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
                $urlNext = $view['router']->generate('_my_feed', array(), true);
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