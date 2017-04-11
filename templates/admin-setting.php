<div class="wrap">
    <h2><?= $pluginHeading; ?></h2>
    <form method="post" action="options.php">
        <?php settings_errors();

        settings_fields(WP_FD_TEXT_DOMAIN . '_option_group');

        ?>

        <div id="poststuff">
            <div id="post-body" class="metabox-holder">
                <div id="post-body-content" style="position: relative;">
                    <?php

                    _fd_load_plugin_view("admin-parts/_dialog_title", array("options" => $options));

                    ?>
                    <br class="clear">

                    <?php

                    _fd_load_plugin_view("admin-parts/_dialog_content", array("options" => $options));

                    ?>

                </div>
                <br class="clear">
            </div>
            <?php
            submit_button(); ?>
        </div>

    </form>
</div><!-- .wrap -->


