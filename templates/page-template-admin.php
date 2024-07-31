<?php
/*
Template Name: Admin Settings
*/

session_start();

get_header();

// Check if the user is logged in
if (!is_user_logged_in()) {
    echo '<h2 class="container">' . __('You must be logged in to access this page.', 'custom-grid') . '</h2>';
    get_footer();
    exit;
}

// Handle re-authentication
if (!isset($_SESSION['reauthenticated']) || $_SESSION['reauthenticated'] !== true) {
    if (!isset($_POST['reauth_nonce']) || !wp_verify_nonce($_POST['reauth_nonce'], 'reauth_action')) {
        echo '<h2 class="container">' . __('Please re-authenticate to access this page.', 'custom-grid') . '</h2>';
        echo '<form method="POST">';
        wp_nonce_field('reauth_action', 'reauth_nonce');
        echo '<button type="submit">' . __('Re-authenticate', 'custom-grid') . '</button>';
        echo '</form>';
        get_footer();
        exit;
    } else {
        $_SESSION['reauthenticated'] = true;
    }
}

// Handle form submission
$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_settings_nonce']) && wp_verify_nonce($_POST['admin_settings_nonce'], 'admin_settings_action')) {
    if (!empty($_FILES['logo']['name'])) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        $uploaded_file = wp_handle_upload($_FILES['logo'], ['test_form' => false]);
        if ($uploaded_file && !isset($uploaded_file['error'])) {
            update_option('home_logo', $uploaded_file['url']);
        } else {
            $error_message = 'File upload error: ' . $uploaded_file['error'];
        }
    }

    if (!empty($_POST['phone'])) {
        update_option('home_phone', sanitize_text_field($_POST['phone']));
    }

    if (!empty($_POST['email'])) {
        update_option('home_email', sanitize_email($_POST['email']));
    }

    if (empty($error_message)) {
        $success_message = 'Settings updated successfully.';
    }
}
?>

<div class="form-container">
    <form method="POST" enctype="multipart/form-data">
        <?php wp_nonce_field('admin_settings_action', 'admin_settings_nonce'); ?>
        <h1>Settings</h1>
        <div class="form-group">
            <label for="logo"><?php echo __("New Logo:"); ?></label>
            <input type="file" name="logo" id="logo">
        </div>

        <div class="form-group">
            <label for="phone"><?php echo __("New Phone Number:"); ?></label>
            <input type="text" name="phone" id="phone">
        </div>
        <div class="form-group">
            <label for="email"><?php echo __("New Email Address:"); ?></label>
            <input type="email" name="email" id="email">
        </div>
        <?php if ($success_message): ?>
            <p class="text-success"><?php echo esc_html($success_message); ?></p>
        <?php endif; ?>
        <?php if ($error_message): ?>
            <p class="text-danger"><?php echo esc_html($error_message); ?></p>
        <?php endif; ?>
        <button type="submit"><?php echo __("Update Settings"); ?></button>
    </form>
</div>

<?php get_footer(); ?>
