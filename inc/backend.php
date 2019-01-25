<?php

function  employ_add_menus()
{
    $employ_main=add_menu_page('مدیریت فرم های استخدام ','مدیریت  فرم های استخدام','manage_options','employ_main','employ_manage_page');
    $employ_main_form=add_submenu_page('employ_main',' مدیریت فرم ها ',' مدیریت فرم ها','manage_options','employ_main');
    $employ_bookmarks=add_submenu_page('employ_main',' متقاضیان برگزیده ',' متقاضیان برگزیده ','manage_options','employ_bookmarks','employ_bookmarks_page');
    $employ_shortcode=add_submenu_page('employ_main','shortcode ',' shortcode ','manage_options','employ_shortcode','employ_shortcode_page');


    add_action("load-{$employ_main}","load_employ_scripts");
    add_action("load-{$employ_main_form}","load_employ_scripts");
    add_action("load-{$employ_bookmarks}","load_employ_scripts");
    add_action("load-{$employ_shortcode}","load_employ_scripts");
}


function load_employ_scripts(){
    wp_register_style('employ_admin_styles',EMPLOY_URL_CSS.'employ_admin_styles.css');
    wp_enqueue_style('employ_admin_styles');
    wp_register_script('employ_admin_script',EMPLOY_URL_JS.'employ_admin_script.js',array('jquery'));
    wp_localize_script('employ_admin_script','wpemploy',array('ajaxurl'=>admin_url('admin-ajax.php')));
    wp_enqueue_script('employ_admin_script');
}