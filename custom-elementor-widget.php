<?php
/**
 * Plugin Name: Custom Elementor Widget Test
 * Description: A custom Elementor widget for a 4x4 grid with category filters.
 * Version: 1.0
 * Author: Arslan Tariq
 */

if (!defined('ABSPATH')) {
    exit;
}

define('PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));

function custom_elementor_widget_enqueue_scripts()
{
    wp_enqueue_script('custom-widget-script', plugin_dir_url(__FILE__) . 'assets/js/custom-widget.js', array('jquery'), null, true);
    wp_enqueue_style('custom-widget-style', plugin_dir_url(__FILE__) . 'assets/css/custom-widget.css');
}
add_action('wp_enqueue_scripts', 'custom_elementor_widget_enqueue_scripts');

function register_custom_elementor_widget($widgets_manager)
{
    require_once (__DIR__ . '/widgets/custom-grid-widget.php');

    $widgets_manager->register(new \Custom_Grid_Widget());
}
add_action('elementor/widgets/register', 'register_custom_elementor_widget');

function add_elementor_widget_categories($category_manager)
{
    $category_manager->add_category(
        'custom_widgets',
        [ 
            'title' => __('Custom Widgets', 'custom-grid'),
            'icon' => 'fa fa-home',
        ]
    );
}
add_action('elementor/elements/categories_registered', 'add_elementor_widget_categories');

function register_custom_page_template($templates)
{
    $templates['page-template-form.php'] = __('Service Form Template', 'custom-grid');
    $templates['page-template-admin.php'] = __('Admin Settings', 'custom-grid');
    $templates['page-template-thankyou.php'] = __('Thank You Template', 'custom-grid');
    $templates['page-template-home.php'] = __('Home Template', 'custom-grid');
    return $templates;
}
add_filter('theme_page_templates', 'register_custom_page_template');

function load_custom_page_template($template)
{
    if (is_page_template('page-template-form.php')) {
        $plugin_template = PLUGIN_DIR_PATH . 'templates/page-template-form.php';
        if (file_exists($plugin_template)) {
            return $plugin_template;
        }
    }

    if (is_page_template('page-template-admin.php')) {
        $plugin_template = PLUGIN_DIR_PATH . 'templates/page-template-admin.php';
        if (file_exists($plugin_template)) {
            return $plugin_template;
        }
    }

    if (is_page_template('page-template-thankyou.php')) {
        $plugin_template = PLUGIN_DIR_PATH . 'templates/page-template-thankyou.php';
        if (file_exists($plugin_template)) {
            return $plugin_template;
        }
    }

    if (is_page_template('page-template-home.php')) {
        $plugin_template = PLUGIN_DIR_PATH . 'templates/page-template-home.php';
        if (file_exists($plugin_template)) {
            return $plugin_template;
        }
    }

    return $template;
}
add_filter('template_include', 'load_custom_page_template');