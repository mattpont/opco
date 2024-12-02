<?php
$bg = get_field('background') == 'dark' ? 'bg--blue-300' : '';
$classes = $block['classList'] ?? null;
?>
<section class="two_col_text py-5 <?=$bg?> <?=$classes?>">
    <div class="container-xl">
        <?php
        if (get_field('title') != '') {
            ?>
        <h2><?=get_field('title')?></h2>
            <?php
        }
        ?>
        <div class="row g-4">
            <div class="col-md-6" data-aos="fade-right">
                <?php
                if (get_field('image_left')) {
                    ?>
                <img src="<?=wp_get_attachment_image_url(get_field('image_left'), 'large')?>"
                    alt="" class="two_col_text__image">
                <?php
                }
                ?>
                <?=apply_filters('the_content', get_field('content_left'))?>
            </div>
            <div class="col-md-6" data-aos="fade-left">
                <?php
if (get_field('image_right')) {
    ?>
                <img src="<?=wp_get_attachment_image_url(get_field('image_right'), 'large')?>"
                    alt="" class="two_col_text__image">
                <?php
}
?>
                <?=apply_filters('the_content', get_field('content_right'))?>
            </div>
        </div>
    </div>
</section>