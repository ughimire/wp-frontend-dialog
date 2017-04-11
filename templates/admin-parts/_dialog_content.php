<?php

$content = isset($options["_dialog_content"]) ? esc_attr($options["_dialog_content"]) : '';

$editor_id = WP_FD_TEXT_DOMAIN . '_option_name[_dialog_content]';

$settings = array(

    'theme_advanced_disable' => 'fullscreen'


);

wp_editor($content, $editor_id, $settings);
?>