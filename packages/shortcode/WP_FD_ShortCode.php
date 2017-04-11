<?php


class  WP_FD_ShortCode
{

    private $options;


    public function load()
    {


        add_action('init', array($this, 'registerShortCode'));


        add_action('wp_footer', array($this, 'loadModel'));


        add_action('wp_enqueue_scripts', array($this, 'addScriptsAndStyles'));
    }

    function loadModel()
    {

        if (is_front_page()) {

            do_shortcode("[wp-frontend-dialog]");
        }
    }

    function addScriptsAndStyles()
    {


        // Registering Scripts
        wp_register_script('fd-google-hosted-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false);

        wp_register_script('fd-query-validation-plugin', 'https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js', array("fd-google-hosted-jquery"));

        wp_register_script('fd-custom-script', WP_FD_PLUGIN_URL . 'js/' . WP_FD_TEXT_DOMAIN . '.js', array(), '1');

        wp_register_style('fd-custom-css', WP_FD_PLUGIN_URL . 'css/' . WP_FD_TEXT_DOMAIN . '.css', array(), '1');

        // Enqueueing Scripts to the head section
        wp_enqueue_script('fd-google-hosted-jquery');

        wp_enqueue_script('fd-query-validation-plugin');

        wp_enqueue_script('fd-custom-script');

        wp_enqueue_style('fd-custom-css');
    }


    public function registerShortCode()
    {

        add_shortcode('wp-frontend-dialog', array($this, 'frontendPostSubmissionShortCode'));

    }

    public function frontendPostSubmissionShortCode($atts)
    {

        $this->options = get_option(WP_FD_TEXT_DOMAIN . '_option_name');

        $data = array(
            "pluginHeading" => __("Frontend Dialog Popup", WP_FD_TEXT_DOMAIN),
            "options" => $this->options,

        );

        _fd_load_plugin_view("ui-dialog", $data);

        //echo __("This website is boss", WP_FD_TEXT_DOMAIN);


    }
}