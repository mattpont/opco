<?php
$classes = $block['className'] ?? null;
// $sticky = get_field('sticky') ?? null ? 'sticky' : '';
$sticky = 'sticky';
$r = random_str(8);
?>
<section
    class="buttons inlinks <?=$classes?> <?=$sticky?> py-2">
    <div class="container-xl">
        <div class="d-none d-lg-flex gap-4 justify-content-around flex-wrap">
            <?php
    while(have_rows('links')) {
        the_row();
        $l = get_sub_field('link');
        ?>
            <a href="<?=$l['url']?>" target="<?=$l['target']?>" class="btn btn-solid btn--small"><?=$l['title']?></a>
            <?php
    }
?>
        </div>
        <div class="inlinks__select d-lg-none">
            <div class="inlinks__select_title">Quick Links</div>
            <select class="form-select" id="inlinks_<?=$r?>">
                <?php
while(have_rows('links')) {
    the_row();
    $l = get_sub_field('link');
    ?>
                <option
                    value="<?=$l['url']?>">
                    <?=$l['title']?>
                </option>
                <?php
}
?>
            </select>
        </div>
    </div>
</section>
<?php
add_action('wp_footer', function () use ($r) {
    ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const select = document.querySelector('#inlinks_<?=$r?>');

        select.addEventListener('change', function() {
            const selectedValue = select.value;
            if (selectedValue) {
                window.location.href = selectedValue; // Redirect to the selected link
            }
        });
    });
</script>
<?php
});
?>