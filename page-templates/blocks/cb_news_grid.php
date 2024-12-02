<?php
$q = new WP_Query(array(
    'posts_per_page' => 4
))
?>
<section class="news_grid py-5 bg--green-200">
    <div class="container-xl">
        <h2 class="text--blue-600">
            <?=get_field('title')?>
        </h2>
        <div class="news_grid__grid mb-4">
            <?php
while ($q->have_posts()) {
    $q->the_post();
    $img = get_the_post_thumbnail_url(get_the_ID(), 'large');
    $cat = 'News';
    $catClass = 'news';
    $categories = get_the_category();
    if (! empty($categories)) {
        $cat = $categories[0]->name;
        $catClass = $categories[0]->slug;
    }
    ?>
            <a href="<?=get_the_permalink()?>"
                class="news_grid__item"
                style="background-image:url(<?=$img?>)"
                data-aos="fade">
                <div class="overlay <?=$catClass?>"></div>
                <!-- <div class="catflash <?=$catClass?>"><?=$cat?>
        </div> -->
        <h3><?=get_the_title()?></h3>
        <div class="news_meta">
            <div class="news_meta__date">
                <?=get_the_date('j F Y')?>
            </div>
        </div>
        </a>
        <?php
}
?>
    </div>
    <div class="text-center">
        <a href="/news/" class="btn btn-primary">All news</a>
    </div>
    </div>
</section>