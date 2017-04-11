<div id="titlediv">
    <div id="titlewrap">


        <?php
        

        printf('<input size="40" placeholder="Enter title here" type="text" id="%s" name="' . WP_FD_TEXT_DOMAIN . '_option_name' . '[_dialog_title]" value="%s" />', "title", isset($options["_dialog_title"]) ? esc_attr($options["_dialog_title"]) : '');

        ?>


    </div>
</div>
