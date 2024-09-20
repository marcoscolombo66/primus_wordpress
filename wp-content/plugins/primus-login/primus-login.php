<?php

/**
 * Plugin Name: Primus Login
 */
if (!is_admin()) {
    wp_enqueue_style('primus-login-css', plugin_dir_url(__FILE__) . '/primus-login.css');

    // Register Script
    function custom_scripts_login()
    {
        wp_register_script('primus-login-main', plugin_dir_url(__FILE__) . '/primus-login.js', array('jquery', 'jquery-core'), '1.0', true);
        wp_enqueue_script('primus-login-main');
    }

    add_action('wp_enqueue_scripts', 'custom_scripts_login');


    function custom_scripts_bd()
    {
        wp_register_script('primus-login-bd', plugin_dir_url(__FILE__) . '/browserDetect.js', array('jquery', 'jquery-core'), '1.0', true);
        wp_enqueue_script('primus-login-bd');
    }


    add_action('wp_enqueue_scripts', 'custom_scripts_bd');


    function js_cookie()
    {
        wp_register_script('primus-login-cookie', plugin_dir_url(__FILE__) . '/js.cookie.min.js', array('jquery', 'jquery-core'), '1.0', true);
        wp_enqueue_script('primus-login-cookie');
    }

    add_action('wp_enqueue_scripts', 'js_cookie');



    function hook_add_login()
    {
        ?>
        <?php
                if (session_status() == PHP_SESSION_NONE) {
                    //session_start();
                }
                ?>


        <div class="main-login" id="primus-login">
            <input type="text" id="primus-login-username" name="primus-login-username" value="" class="input correct" placeholder="Username">
            <input type="password" id="primus-login-password" name="primus-login-password" value="" class="input correct" placeholder="Password">
            <label class="primus-login-label" for="primus-login-remember">Remember <span id="login-me" class="hide-small">me</span> <input type="checkbox" name="remember" class="primus-login-remember" id="primus-login-remember"> </label>
            <button type="submit" id="primus-login-button">Login</button>
            <div class="button brand-1 primus-login-close" id="primus-login-close"><span id="primus-login-close-text">Close</span><i class="fa fa-times"></i></div>
        </div>


        <div id="primus-login-modal" class="modal">
            <!-- Modal content -->
            <div class="modal-content" id="primus-login-modal-content">
                <span class="primus-login-modal-close close">&times;</span>
                <div id="primus-login-modal-body">
                    <div style="display: flex;text-align: center;align-items: center;width: 160px;margin: 0 auto;">Sending...<div class="sk-folding-cube sk-folding-cube-inline sk-folding-cube-small">
                            <div class="sk-cube1 sk-cube"></div>
                            <div class="sk-cube2 sk-cube"></div>
                            <div class="sk-cube4 sk-cube"></div>
                            <div class="sk-cube3 sk-cube"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    }


    add_action('wp_head', 'hook_add_login');


    function getLogged()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $logged = 'false';
        if (isset($_SESSION) && isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
            $logged = 'true';
        }
        echo '<script> window.logged = ' . $logged . '; </script>';
    }


    add_action('wp_loaded', 'getLogged');
}
