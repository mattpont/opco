<?php
$classes = $block['classList'] ?? 'pb-5';
$numcards = get_field('num_cols') == '2' ? 'col-md-6' : 'col-md-3';
?>
<section class="expand <?=$classes?>">
    <div class="container-xl">
        <div class="row g-4 justify-content-center">
        <?php
        while (have_rows('cards')) {
            the_row();
            ?>
            <div class="<?=$numcards?>">
                <div class="expand__card">
                    <img src="<?=wp_get_attachment_image_url(get_sub_field('image'),'large')?>" alt="">
                    <h3><?=get_sub_field('title')?></h3>
                    <div class="expand__content">
                        <?=get_sub_field('content')?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const cards = document.querySelectorAll('.expand__card');

    cards.forEach(card => {
        card.addEventListener('click', function() {
            // Remove 'active' class from all cards
            // cards.forEach(c => c.classList.remove('active'));
            // Add 'active' class to the clicked card
            this.classList.add('active');
        });
    });
});
</script>