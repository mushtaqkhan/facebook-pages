<?php
$view->extend('SocialManagerBundle::layout_user.html.php');
?>
<div class="col-md-9">
    <form class="form-horizontal" method="POST" autocomplete="off" action="">
        <div class="panel panel-blue">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo $view['translator']->trans('Feed') . " " . ucfirst($title); ?> <?php
                    if ($product) {
                        echo ": ID " . $product->getId();
                    }
                    ?></h2>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-sm-12">
                        <?php if ($error) { ?>
                            <div class="alert alert-dismissable alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <strong><?php echo $view['translator']->trans("Error!"); ?></strong>
                                <?php echo $view['translator']->trans("Please try again."); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <?php if ($title == "link") { ?>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label><?php echo $view['translator']->trans("Link URL"); ?></label>
                            <input type="text" autocomplete="off" class="form-control font14" id="link_url" name="link_url" placeholder="<?php echo $view['translator']->trans("Link URL"); ?>" value="<?php
                            if ($product) {
                                echo $product->getLinkUrl();
                            }
                            ?>">
                        </div>
                    </div>
                <?php } ?>

                <?php if (in_array($title, array("link", "text"))) { ?>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label><?php echo $view['translator']->trans("Message"); ?></label>
                            <textarea class="form-control" name="message" id="message" rows="8"><?php
                                if ($product) {
                                    echo $product->getMessage();
                                }
                                ?></textarea>
                        </div>
                    </div>
                <?php } ?>

                <?php if (in_array($title, array("link", "video"))) { ?>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label><?php echo ucfirst($title) . " " . $view['translator']->trans("Title"); ?></label>
                            <input type="text" autocomplete="off" class="form-control font14" id="link_title" name="link_title" placeholder="<?php echo $view['translator']->trans("Link Title"); ?>" value="<?php
                            if ($product) {
                                echo $product->getLinkTitle();
                            }
                            ?>">
                        </div>
                    </div>
                <?php } ?>

                <?php if (in_array($title, array("link", "image", "video"))) { ?>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label><?php echo ucfirst($title) . " " . $view['translator']->trans("Description"); ?></label>
                            <textarea class="form-control" name="link_description" id="link_description" rows="8"><?php
                                if ($product) {
                                    echo $product->getDescription();
                                }
                                ?></textarea>
                        </div>
                    </div>
                <?php } ?>

                <?php if ($title == "link") { ?>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label><?php echo $view['translator']->trans("Link Caption"); ?></label>
                            <input type="text" autocomplete="off" class="form-control font14" id="link_caption" name="link_caption" placeholder="<?php echo $view['translator']->trans("Link Caption"); ?>" value="<?php
                            if ($product) {
                                echo $product->getCaption();
                            }
                            ?>">
                        </div>
                    </div>
                <?php } ?>

                <?php
                if (in_array($title, array("link", "image", "video"))) {
                    $title = ($title == "link") ? "Picture" : $title;
                    ?>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label><?php echo ucfirst($title) . " " . $view['translator']->trans("URL"); ?></label>
                            <input type="text" autocomplete="off" class="form-control font14" id="image" name="image" placeholder="<?php echo ucfirst($title) . " " . $view['translator']->trans("URL"); ?>" value="<?php
                            if ($product) {
                                echo $product->getImageUrl();
                            }
                            ?>">
                        </div>
                    </div>
                <?php } ?>

                <div class="form-group">
                    <div class="col-sm-12">
                        <label><?php echo $view['translator']->trans("Feed Schedule"); ?></label>
                        <div class='input-group date' id='datetimepicker1'>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            <input type='text' class="form-control"  id="time_post" name="time_post" value="<?php echo date("d-m-Y H:i:s", ($product) ? $product->getTimePost() : time()); ?>"/>
                        </div>
                        <script type="text/javascript">
                            $(function () {
                                $('#datetimepicker1').datetimepicker({
                                    format: 'DD-MM-YYYY HH:mm:ss'
                                });
                            });
                        </script>
                    </div>
                </div>


                <?php if (!$product) { ?>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label><?php echo $view['translator']->trans("Choose Pages / Groups"); ?></label>
                            <br>
                            <select name="pages[]" class="selectpicker" data-live-search="true" data-live-search-placeholder="<?php echo $view['translator']->trans("Search"); ?>" data-actions-box="true" data-done-button="true" data-done-button-text="<?php echo $view['translator']->trans("Done"); ?>" multiple data-none-selected-text="<?php echo $view['translator']->trans("Choose Pages / Groups"); ?>">
                                <?php
                                $arr = array();
                                if ($list) {
                                    foreach ($list as $key => $value) {
                                        if ($value->getType() == "Page") {
                                            $arr["Pages"][] = $value;
                                        } else {
                                            $arr["Groups"][] = $value;
                                        }
                                    }
                                }
                                if ($arr) {
                                    foreach ($arr as $key => $value) {
                                        ?>
                                        <optgroup label="<?php echo $key; ?>">
                                            <?php foreach ($value as $key1 => $value1) { ?>
                                                <option value="<?php echo $value1->getPId(); ?>"><?php echo $value1->getTitle(); ?></option>
                                            <?php } ?>
                                        </optgroup>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="panel-footer bg-white">
                <button type="submit" class="btn btn-danger btn-lg font14"><?php echo $view['translator']->trans("Submit"); ?></button>
            </div>
        </div>
    </form>
</div>