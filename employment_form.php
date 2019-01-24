<?php

/*
  Plugin Name:فرم استخدام
  Description:مدیریت استخدام متقاضیان
  Version: 1.0
  Plugin URI: http://zarre2.iranh.ir
  Author:جمشید
  Author URI:http://zarre2.iranh.ir
  License:GPL v2
 */



ob_start();

defined( 'ABSPATH' ) || exit;


define( 'EMPLOY_DIR', plugin_dir_path( __FILE__ ) );

define( 'EMPLOY_INC_DIR', trailingslashit( EMPLOY_DIR . 'inc' ) );

define( 'EMPLOY_DOC_DIR', trailingslashit( EMPLOY_DIR . 'doc' ) );




define( 'EMPLOY_URL', plugin_dir_url( __FILE__ ) );

define( 'EMPLOY_URL_CSS', trailingslashit( EMPLOY_URL . 'css' ) );

define( 'EMPLOY_URL_JS', trailingslashit( EMPLOY_URL . 'js' ) );

define( 'EMPLOY_URL_IMG', trailingslashit( EMPLOY_URL . 'img' ) );

define( 'EMPLOY_URL_DOC', trailingslashit( EMPLOY_URL . 'doc' ) );

define( 'EMPLOY_URL_INC', trailingslashit( EMPLOY_URL . 'inc' ) );



include_once EMPLOY_INC_DIR.'frontend.php';
include_once EMPLOY_INC_DIR.'shortcodes_employ_form.php';
include_once EMPLOY_INC_DIR.'ajax.php';





if(is_admin()){


    include_once EMPLOY_INC_DIR.'createTable.php';
    include_once EMPLOY_INC_DIR.'backend.php';
    include_once EMPLOY_INC_DIR.'pages.php';
    add_action('admin_menu','employ_add_menus');


}


register_activation_hook(__FILE__,'employ_insertpage');







function employ_insertpage(){


    employ_create_table();

}



