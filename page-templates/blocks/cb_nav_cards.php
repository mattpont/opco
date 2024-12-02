<?php
?>
<div class="nav_cards py-5">
    <div class="container-xl">
        <div class="row g-4">
            <?php
            $d = 0;
            while(have_rows('cards')) {
                the_row();
                $colour = get_sub_field('background') ?? 'black';
                $l = get_sub_field('link') ?? null;
                ?>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?=$d?>">
                <a class="nav_cards__card" href="<?=$l?>">
                    <div class="nav_cards__icon bg--<?=$colour?>">
                        <img src="<?=get_sub_field('icon')?>" alt="<?=get_sub_field('title')?>">
                    </div>
                    <div class="nav_cards__inner bg--<?=$colour?>">
                        <h3><?=get_sub_field('title')?></h3>
                        <div class="nav_cards__content"><?=get_sub_field('content')?></div>
                        <div class="nav_cards__link"><i class="fa-solid fa-angle-right"></i> Learn more</div>
                    </div>
                </a>
            </div>
                <?php
                $d+=100;
            }
            ?>
        </div>
    </div>
</div>