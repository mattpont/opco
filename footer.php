<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
?>
<div id="footer-top"></div>
<footer class="footer pt-4 pb-5">
    <div class="container-xl">
        <img src="<?=get_stylesheet_directory_uri()?>/img/iht-logo--wo.svg"
            alt="In House Training Consultancy Ltd." class="footer__logo">
        <div class="row mt-4">
            <div class="col-sm-6 col-lg-4 col-xl-4 order-xl-2 has-sm-border-right">
                <div class="footer__heading">About Us</div>
                <p><?=get_field('footer_about','option')?></p>
                Get in touch: <strong><?=do_shortcode('[contact_phone]')?></strong><br>
                <?=do_shortcode('[contact_email]')?>
            </div>
            <div class="col-sm-6 col-lg-3 col-xl-3 order-xl-3 has-md-border-right">
                <div class="footer__heading">Consultancy Services</div>
                <?=wp_nav_menu(array('theme_location' => 'footer_menu1'))?>
            </div>
            <div class="col-sm-6 col-lg-3 col-xl-3 order-xl-3 has-sm-border-right">
                <div class="footer__heading">Training Courses</div>
                <?=wp_nav_menu(array('theme_location' => 'footer_menu2'))?>
            </div>
            <div class="col-sm-6 col-lg-2 col-xl-2 order-xl-3">
                <div class="footer__heading">More</div>
                <?=wp_nav_menu(array('theme_location' => 'footer_menu3'))?>
            </div>
        </div>
    </div>
</footer>
<div class="colophon">
    <div class="container-xl py-2">
        <div class="d-flex flex-wrap justify-content-between lined">
            <div class="col-md-8 text-center text-md-start">
                &copy; <?=date('Y')?> In House Training Consultancy Ltd. 
            </div>
            <div
                class="col-md-4 d-flex align-items-center justify-content-center justify-content-md-end flex-wrap gap-1">
                <a href="https://www.chillibyte.co.uk/" rel="nofollow noopener" target="_blank" class="cb"
                    title="Digital Marketing by Chillibyte"></a>
            </div>
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>
