<?php


class  WP_FD_AdminSettings
{
    private $options;

    // default fuction - it calls from registerPackage method of FPLoader class
    public function load()
    {

        add_action('admin_init', array($this, 'pluginInitAdmin'));

        add_action('admin_menu', array($this, 'renderAdminPage'));


    }




    /**
     * Option page for plugin
     */
    public function renderAdminPage()
    {

        $this->loadScript();

        add_menu_page(WP_FD_LABEL, WP_FD_LABEL, 'manage_options', WP_FD_PLUGIN_NAME, array($this, 'createAdminPage'));

    }


    function loadScript()
    {
        wp_enqueue_script(
            WP_FD_TEXT_DOMAIN,
            WP_FD_PLUGIN_URL . 'js/' . WP_FD_TEXT_DOMAIN . '_admin.js', // <----- get_stylesheet_directory_uri() if used in a theme
            array('jquery-ui-sortable', 'jquery') // <---- Dependencies
        );
    }


    /**
     * Options page callback
     */
    public function createAdminPage()
    {
//echo WP_FD_TEXT_DOMAIN . '_options';
        $this->options = get_option(WP_FD_TEXT_DOMAIN . '_option_name');

        $data = array(
            "pluginHeading" => __("Frontend Dialog Popup", WP_FD_TEXT_DOMAIN),
            "options" => $this->options,
            "prefix" => FDForm::$visiblePrefix

        );

        _fd_load_plugin_view("admin-setting", $data);
    }

    /**
     * Register and add settings
     */
    public function pluginInitAdmin()
    {
        register_setting(
            WP_FD_TEXT_DOMAIN . '_option_group', // Option group
            WP_FD_TEXT_DOMAIN . '_option_name', // Option name
            array($this, 'sanitize') // Sanitize
        );

    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize($input)
    {


        /* if (null == $input['post_title_label']) {
             add_settings_error(
                 'requiredTextFieldEmpty',
                 'empty',
                 'Cannot be empty',
                 'error'
             );

            we can make validation of the form by this above commented script
         }*/
        $new_input = array();

        if (isset($input['_dialog_title']))
            $new_input['_dialog_title'] = ($input['_dialog_title']);

        if (isset($input['_dialog_content']))
            $new_input['_dialog_content'] = ($input['_dialog_content']);


        return $new_input;
    }


}