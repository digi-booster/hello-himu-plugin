<?php
/**
 * Plugin Name: Hello Himu
 * Description: My first custom WordPress plugin.
 * Version: 1.0
 * Author: Himanshu
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('admin_notices', 'himu_show_notice');

function himu_show_notice()
{
    echo '<div class="notice notice-info"><p>Plugin loaded using a named function 💡</p></div>';
}

add_action('admin_menu', 'himu_register_admin_menu');

function himu_register_admin_menu()
{
    add_menu_page(
        'Hello Himu Settings',
        'Hello Himu',
        'manage_options',
        'hello-himu',
        'himu_settings_page',
        'dashicons-admin-generic'
    );
}

function himu_settings_page()
{

    if (
        isset($_POST['himu_message']) &&
        isset($_POST['himu_nonce']) &&
        wp_verify_nonce($_POST['himu_nonce'], 'himu_save_settings')
    ) {

        update_option('himu_message', sanitize_text_field($_POST['himu_message']));
    }

    $message = get_option('himu_message', '');
    ?>
    <div class="wrap">
        <h1>Hello Himu Settings</h1>

        <form method="post">
            <?php wp_nonce_field('himu_save_settings', 'himu_nonce'); ?>
            <input type="text" name="himu_message" value="<?php echo esc_attr($message); ?>" />
            <button class="button button-primary">Save</button>
        </form>
    </div>
    <?php
}

