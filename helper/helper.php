<?php

if (!function_exists("_fd_pp")) {


    function _fd_pp($array = array(), $isDie = true)
    {

        echo '<pre>';


        print_r($array);

        echo '</pre>';

        if ($isDie) {
            die();
        }
    }
}
if (!function_exists("_fd_load_plugin_view")) {


    function _fd_load_plugin_view($viewName, $data = array())
    {


        $templatePath = WP_FD_PLUGIN_TEMPLATES_DIR . $viewName;

        $response = "";

        if (file_exists($templatePath)) {

            ob_start();

            extract($data);

            require_once $templatePath;

            foreach ($data as $key => $value) {

                unset($$key);

            }

            $response = ob_get_contents();


            ob_end_clean();


        } else if (file_exists($templatePath . '.php')) {

            ob_start();

            extract($data);

            require_once $templatePath . '.php';


            foreach ($data as $key => $value) {

                unset($$key);

            }

            $response = ob_get_contents();

            ob_end_clean();

        }


        echo $response;


    }
}
?>