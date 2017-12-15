<?php
/*
  Plugin Name: Copy Protect
  Plugin URI:
  Description: Copy Protect is the effective way to protect your site content form others.
  Version: 1.1
  Author: quackwp
  Author URI:
  License: GPLv2
 */

class copyprotect {

    function admin_cp() {
        add_submenu_page('options-general.php', 'Copy Protect', 'Copy Protect', 'manage_options', 'copyprotect_s', 'admin_menu_copy');
    }

    function cp_enq_script() {
        wp_enqueue_script('jquery');
    }

    function copy_protect_process() {
        echo '<script type="text/javascript">
             jQuery(document).bind("keydown", function(e) {
               if(e.ctrlKey && (e.which == 65 || e.which == 67 || e.which == 88 || e.which == 83 ||e.which == 85)) {
                 e.preventDefault();
                 return false;
                 }
             });

         jQuery(document).on( "mousedown", function(event) {
             if(event.which=="3")
             {
             document.oncontextmenu = document.body.oncontextmenu = function() {return false;}

             }
             });
            </script>

            <style type="text/css">
            body{
                    -webkit-touch-callout: none;
                    -webkit-user-select: none;
                    -khtml-user-select: none;
                    -moz-user-select: none;
                    -ms-user-select: none;
                    user-select: none;
               }
            </style>';
    }

    function copy_protect_c() {
        delete_option('ccaption');
        delete_option('clink');
        delete_option('ctext');
    }

    function quack_copy_protect_c() {
        if (is_home() || is_front_page()) {
            ?>
            <center>
                <small style="font-size:10px;"> <?php echo get_option('ctext'); ?> <a href="<?php echo get_option('clink'); ?>" target="_blank"> <?php echo get_option('ccaption'); ?> </a> </small></center>
            <?php
        }
    }

}

function admin_menu_copy() {
    echo "<center><h1>Welcome to Copy Protect</h1></center><br><center>This Plugin doesn't have any Settings.</center>";
}

register_activation_hook(__FILE__, array('copyprotect', 'copy_protect_c'));
add_action('init', array('copyprotect', 'quack_copy_protect_c'));
add_action('wp_enqueue_scripts', array('copyprotect', 'cp_enq_script'));
add_action('wp_head', array('copyprotect', 'copy_protect_process'));
add_action('admin_menu', array('copyprotect', 'admin_cp'));
?>