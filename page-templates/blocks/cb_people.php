<?php
$classes = $block['classList'] ?? 'pb-5';
?>
<section class="people <?=$classes?>">
    <div class="container-xl">
        <div class="row g-4 justify-content-center">
    <?php
    $p = new WP_Query(array(
        'post_type' => 'people',
        'posts_per_page' => -1,
    ));
    $c = 1;
    while ($p->have_posts()) {
        $p->the_post();
        ?>
        <div class="col-md-3">
            <div class="people__card" data-bs-toggle="modal" data-bs-target="#p<?=$c?>">
                <img src="<?=get_the_post_thumbnail_url(get_the_ID(),'large')?>" alt="<?=get_the_title()?>">
                <h2 class="h3"></h2><?=get_the_title()?>
                <div class="people__role"><?=get_field('role',get_the_ID())?></div>
            </div>
        </div>
<div class="modal fade" id="p<?=$c?>">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close text-dark" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <img class="person__image mb-2" src="<?=get_the_post_thumbnail_url( get_the_ID(), 'large' )?>">
                    </div>
                    <div class="col-md-9">
                        <div class="person__title h3"><?=get_the_title()?></div>
                        <div class="person__role font-weight-bold h4"><?=get_field('role',get_the_id())?></div>
                        <div class="person__content"><?=null, false, get_the_content(get_the_ID())?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   
        <?php
        $c++;
    }
    ?>
        </div>
    </div>
</section>