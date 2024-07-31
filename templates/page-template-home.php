<?php
/*
Template Name: Home Template
*/

session_start();

get_header();

$logo_url = get_option('home_logo', \Elementor\Utils::get_placeholder_image_src());
$phone = get_option('home_phone', '+1234567890');
$email = get_option('home_email', 'example@example.com');

?>
<div class="header-section">
    <div class="logo">
        <img src="<?php echo esc_url($logo_url); ?>" alt="Logo">
    </div>
    <div class="contact-info">
        <a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a>
        <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
    </div>
</div>

<?php
if (have_posts()):
    while (have_posts()):
        the_post();
        the_content();
    endwhile;
endif;
?>

<?php get_footer(); ?>