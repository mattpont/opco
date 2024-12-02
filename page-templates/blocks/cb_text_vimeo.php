<?php
$order_left = (get_field('order') == 'text') ? 'order-1 order-lg-2' : 'order-1 order-lg-1';
$fade_left = (get_field('order') == 'text') ? 'fade-left' : 'fade-right';
$order_right = (get_field('order') == 'text') ? 'order-2 order-lg-1' : 'order-2 order-lg-2';
$fade_right = (get_field('order') == 'text') ? 'fade-right' : 'fade-left';
// $bg = get_field('background') == 'dark' ? 'bg--blue-300' : '';
// $link = get_field('background') == 'dark' ? 'text--theme' : 'text--blue-600';
// $title = get_field('background') == 'dark' ? 'text--blue-600' : 'text--blue-600';
$bg = get_field('background') == 'dark' ? 'bg--theme' : '';
$link = 'fg--theme';
$title = 'fg--theme';

$classes = $block['className'] ?? null;

if (get_field('id')) {
    ?>
<a id="<?=get_field('id')?>" class="anchor"></a>
<?php
}

$overlay = (isset(get_field('background_pattern')[0]) && get_field('background_pattern')[0] == 'Yes') ? '<div class="overlay"></div>' : '';

$vimeo_id = get_field('vimeo_id') ?? null;

?>
<!-- text_image_5050 -->
<section
    class="text_image_5050 py-5 <?=$bg?> <?=$classes?>">
    <?=$overlay?>
    <div class="container animated wow fadeIn">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center text_image_5050__content <?=$order_left?>"
                data-aos="<?=$fade_left?>">
                <?php
                if (get_field('title')) {
                    echo '<h2 class="' . $title . '">' . get_field('title') . '</h2>';
                }
                if (get_field('subtitle')) {
                    echo '<h3 class="h4 mb-4">' . get_field('subtitle') . '</h3>';
                }
                echo get_field('content');
if (get_field('cta')) {
    $cta = get_field('cta');
    echo '<a href="' . $cta['url'] . '" target="' . $cta['target'] .'" class="arrow-link ' . $link . '">' . $cta['title'] . '</a>';
}
?>
            </div>
            <div class="col-lg-6 d-flex flex-column justify-content-center text_image_5050__image <?=$order_right?>"
                data-aos="<?=$fade_right?>">
                <div class="ratio ratio-4x3">
                    <iframe
                        src="https://player.vimeo.com/video/<?=$vimeo_id?>?badge=0&amp;autopause=0&amp;quality_selector=1&amp;player_id=0&amp;app_id=58479"
                        allow="autoplay; fullscreen; picture-in-picture"
                        style="position:absolute;top:0;left:0;width:100%;height:100%;"
                        title="AOS - White Gold"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
add_action('wp_footer', function () {
    ?>
<script src="https://player.vimeo.com/api/player.js"></script>
<?php
});
