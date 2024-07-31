<?php
/*
Template Name: Thank You Template
*/

session_start();

get_header();

$url = $_GET['url'] ?? '';

$parsed_url = parse_url($url);
$base_url = $parsed_url['scheme'] . '://' . $parsed_url['host'] . ($parsed_url['path'] ?? '');
?>
<div class="thank-you-container">
    <h1 style="text-align:center; border-bottom: 1px solid #ccc; padding-bottom: 5px">Thank You!</h1>
    <p>Name: <?php echo htmlspecialchars($_GET['user_name'] ?? ''); ?></p>
    <p>Phone: <?php echo htmlspecialchars($_GET['phone'] ?? ''); ?></p>
    <p>Email: <?php echo htmlspecialchars($_GET['email'] ?? ''); ?></p>
    <p>Service Type: <?php echo htmlspecialchars($_GET['serviceType'] ?? ''); ?></p>
    <p>Submitted from URL: <?php echo htmlspecialchars($base_url); ?></p>
    <p>User Agent: <?php echo htmlspecialchars($_GET['userAgent'] ?? ''); ?></p>
</div>

<?php get_footer(); ?>

<style>
    .thank-you-container {
        background: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: 20px auto;
        text-align: left;
    }

    .thank-you-container h1 {
        margin-bottom: 20px;
        font-size: 24px;
    }

    .thank-you-container p {
        margin: 10px 0;
        font-size: 18px;
    }
</style>