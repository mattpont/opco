<?php
$classes = $block['className'] ?? null;

if (isset(get_field('short_hero')[0]) && get_field('short_hero')[0] == 'Yes') {
    $classes .= ' hero--short';
}
?>
<section class="hero <?=$classes?>">
    <?=wp_get_attachment_image(get_field('background'),'full',false,array('class' => 'hero__bg'))?>
    <div class="container-xl py-4">
        <div class="row">
            <div class="col-lg-8">
                <h1 data-aos="fade-right"><?=get_field('title')?></h1>
                <?php
                $delay = 300;
                if (get_field('subtitle')) {
                    ?>
                <h2 data-aos="fade-right" data-aos-delay="<?=$delay?>" class="mb-0"><?=get_field('subtitle')?></h2>
                    <?php
                    $delay += 300;
                }
                if (get_field('cta') || get_field('cta_2')) {
                    ?>
                <div class="hero__cta" data-aos="fade-right" data-aos-delay="<?=$delay?>">
                    <?php
                    if (get_field('cta')) {
                        ?>
                    <a href="<?=get_field('cta')['url']?>" class="button"><img src="<?=get_field('cta_icon')?>"> <?=get_field('cta')['title']?></a>
                        <?php
                    }
                    if (get_field('cta_2')) {
                        ?>
                    <a href="<?=get_field('cta_2')['url']?>" class="button"><img src="<?=get_field('cta_2_icon')?>"> <?=get_field('cta_2')['title']?></a>
                        <?php
                    }
                    ?>
                </div>
                    <?php
                }
                if (is_front_page() && get_field('hero_badges','options') ?? null) {
                    $badges = get_field('hero_badges','options')
                    ?>
                <div class="hero__badges">
                    <?php
                    foreach ($badges as $b) {
                        echo wp_get_attachment_image($b,'large',false,array('class' => 'hero__badge'));
                    }
                    ?>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>