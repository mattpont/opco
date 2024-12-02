<?php
/**
 * The header for the theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package cb-iht2024
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
session_start();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta
        charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, minimum-scale=1">
    <link rel="preload"
        href="<?=get_stylesheet_directory_uri()?>/fonts/open-sans-v40-latin-700.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload"
        href="<?=get_stylesheet_directory_uri()?>/fonts/open-sans-v40-latin-regular.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <?php
if (!is_user_logged_in()) {
    if (get_field('ga_property', 'options')) {
        ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async
        src="https://www.googletagmanager.com/gtag/js?id=<?=get_field('ga_property', 'options')?>">
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config',
            '<?=get_field('ga_property', 'options')?>'
            );
    </script>
        <?php
    }
    if (get_field('gtm_property', 'options')) {
        ?>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer',
            '<?=get_field('gtm_property', 'options')?>'
            );
    </script>
    <!-- End Google Tag Manager -->
        <?php
    }
}
if (get_field('google_site_verification', 'options')) {
    echo '<meta name="google-site-verification" content="' . get_field('google_site_verification', 'options') . '" />';
}
if (get_field('bing_site_verification', 'options')) {
    echo '<meta name="msvalidate.01" content="' . get_field('bing_site_verification', 'options') . '" />';
}

wp_head();
?>

    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "Organization",
            "name": "IHT Consultancy",
            "url": "https://ihtconsultancy.com/",
            "logo": "https://ihtconsultancy.com/wp-content/theme/cb-iht2024/img/iht-logo.jpg",
            "description": "Workplace Training &amp; Workplace Consultancy in Bristol &amp; Taunton including Fire Safety, Health &amp; Safety, First Aid Courses and Consultancy Services.",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Higher Ford",
                "addressLocality": "Wiveliscombe",
                "addressRegion": "Taunton",
                "postalCode": "TA4 2RL",
                "addressCountry": "GB"
            },
            "telephone": "+44 (0) 1984 623450",
            "email": "info@ihtconsultancy.com"
        }
    </script>

</head>

<body <?php body_class(); ?>
    <?php understrap_body_attributes(); ?>>
    <?php
do_action('wp_body_open');
if (!is_user_logged_in()) {
    if (get_field('gtm_property', 'options')) {
        ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe
        src="https://www.googletagmanager.com/ns.html?id=<?=get_field('gtm_property', 'options')?>"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <?php
    }
}
?>
<header id="wrapper-navbar" class="fixed-top p-0">
    <section class="top_nav d-none d-lg-block py-2">
        <div class="container-xl">
            <ul class="mb-0">
                <li><a href="/about/">About Us</li>
                <li><a href="/news/">News</li>
                <li><a href="/contact/">Contact Us</li>
                <li><?=do_shortcode('[social_fb_icon]')?></li>
                <li><?=do_shortcode('[social_ig_icon]')?></li>
                <li><?=do_shortcode('[social_in_icon]')?></li>
            </ul>
        </div>
    </section>
    <nav class="navbar navbar-expand-lg p-0">
        <div class="container-xl py-2 nav-top align-items-end">
            <div class="text-lg-center logo-container"><a href="/" class="logo" aria-label="IHT Consultancy Homepage"></a></div>
            <div class="button-container d-lg-none">
                <button class="navbar-toggler mt-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                </button>
            </div>
            
            <div class="collapse navbar-collapse" id="navbar">
                    <?php
                    wp_nav_menu(
    array(
        'theme_location'  => 'primary_nav',
        'container_class' => 'w-100',
        // 'container_id'    => 'primaryNav',
        'menu_class'      => 'navbar-nav justify-content-around w-100',
        'fallback_cb'     => '',
        'menu_id'         => 'navbarr',
        'depth'           => 3,
        'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
    )
);
?>
            </div>
        </div>
    </nav>
</header>