<?php

class FDLoader
{
    private $registeredPackages = array();

    private static $instance = null;

    // Plugin initialize from here
    public static function fdLoad()
    {


        //load_plugin_textdomain('WP_FD_TEXT_DOMAIN', false, dirname(plugin_basename(__FILE__)) . '/lang/');

        load_plugin_textdomain(WP_FD_TEXT_DOMAIN, false, dirname(plugin_basename(__FILE__)) . '/lang/');


        if (self::$instance == null) {

            self::$instance = new FDLoader();
        }

        self::$instance->loadHelper();

        self::$instance->registerAndLoadPackages();

        self::$instance->removeP();


    }

    function removeP()
    {

        if (is_front_page()) {
            echo "<h1>Hello World</h1>";
        }
    }

// load helper (where  common functions are located for this plugin)
    function loadHelper()
    {
        $helperPath = WP_FD_PLUGIN_HELPER_DIR . 'helper.php';

        if (file_exists($helperPath)) {

            require_once $helperPath;

        }

    }

    // Get instance of package
    private static function getInstance($packageName)
    {
        $class = isset(self::$instance->registeredPackages[$packageName]) ? self::$instance->registeredPackages[$packageName] : "";

        if ($class == "" || $class == null) {

            throw new Exception("Package not exists");
        }

        $classFilePath = WP_FD_PLUGIN_PACKAGES_DIR . $packageName . DIRECTORY_SEPARATOR . $class . '.php';


        if (!file_exists($classFilePath)) {


            throw  new Exception("package main class not found.File " . $classFilePath);

        }
        //echo $classFilePath;
        require_once $classFilePath;

        $instance = new self::$instance->registeredPackages[$packageName];

        return $instance;
    }

    // register new package
    private function registerPackages($packages = array())
    {

        if (count(array_keys($packages)) != count(array_values($packages))) {

            throw  new Exception("package key value missmatch.");
        }

        $this->registeredPackages = $packages;

    }

// Register and auto load packages
    private function registerAndLoadPackages()
    {

        $this->registerPackages(array(

                "shortcode" => "WP_FD_ShortCode", // Key == Package directory name and Value is Package Main class name

                "admin-setting" => "WP_FD_AdminSettings",

                "form" => "FDForm",


                /*"actions" => "FPActions"*/

            )
        );


        $this->loadPackage("shortcode");

        if (is_admin()) {

            $this->loadPackage("admin-setting");
        }
        $this->loadPackage("form");

        /*$this->loadPackage("actions");*/
    }

    private function loadPackage($packageName)
    {
        try {

            if (!isset($this->registeredPackages[$packageName])) {

                throw  new Exception("Package not registered yet.");

            }

            self::getInstance($packageName)->load();

        } catch (Exception $e) {


            echo '<h1>' . $e->getMessage() . '</h1>';
        }

    }


}

?>