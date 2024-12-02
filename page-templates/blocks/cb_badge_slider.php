<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<section class="badge_slider bg--grey py-5">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-8">
                <h2 class="text--blue-400">Memberships &amp; Partnerships</h2>
            </div>
            <div class="col-md-4 d-flex">
                <a href="/about-us/" class="button"><img src="<?=get_stylesheet_directory_uri()?>/img/icon--arrow.svg"> Learn more</a>
            </div>
        </div>
        <div class="swiper">
            <div class="swiper-wrapper" id="swiper-wrapper">
        <?php
        foreach (get_field('badges','option') as $b) {
            ?>
<div class="swiper-slide"><?=wp_get_attachment_image($b,'large')?></div>
            <?php
        }
        ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>
<?php
add_action('wp_footer',function() {
    ?>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper('.swiper', {
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        spaceBetween: 18,
        slidesPerGroup: 1,
        breakpoints: {
            1200: {
                slidesPerView: 4,
            },
            768: {
                slidesPerView: 2,
            },
            0: {
                slidesPerView: 1,
            }
        }
    });
</script>
    <?php
});