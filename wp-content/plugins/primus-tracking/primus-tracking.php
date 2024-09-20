<?php

/**
 * Plugin Name: Primus Tracking
 */
if (!is_admin()) {
    wp_enqueue_style('primus-tracking-css', plugin_dir_url(__FILE__) . '/primus-tracking.css');

    // Register Script
    function custom_scripts()
    {
        wp_register_script('primus-tracking-main', plugin_dir_url(__FILE__) . '/primus-tracking.js', array('jquery', 'jquery-core'), '1.0', true);
        wp_enqueue_script('primus-tracking-main');
    }

    add_action('wp_enqueue_scripts', 'custom_scripts');

    function hook_add_tracking()
    {
        ?>
        <script>
            window.primustrakingdir = '<?php echo plugin_dir_url(__FILE__); ?>'
        </script>
        <div class="main-search" id="primus-tracking">
            <form id="form-track">
                <input class="primus-tracking-input" type="text" name="trackingNumber" id="trackingNumber" placeholder="Enter your tracking #" value="">
                <button type="submit" class="primus-tracking-button" id="primus-tracking-button"><i class="fa fa-search"></i></button>
                <div class="button brand-1 search-close primus-tracking-close" id="primus-tracking-close"><span id="primus-tracking-close-text">Close</span><i class="fa fa-times"></i></div>
            </form>
        </div>


        <div id="primus-tracking-modal" class="modal">

            <!-- Modal content -->
            <div class="modal-content" id="primus-tracking-modal-content">
                <span class="primus-tracking-modal-close close">&times;</span>
                <div id="primus-tracking-modal-body">
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
    add_action('wp_head', 'hook_add_tracking');
}

//   // include custom jQuery
// function shapeSpace_include_custom_jquery() {

// 	wp_deregister_script('jquery');
// 	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);

// }
// add_action('wp_enqueue_scripts', 'shapeSpace_include_custom_jquery');
