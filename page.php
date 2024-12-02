<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();

$theme = get_field('theme') ?: 'blue';
?>
<main id="main" class="theme--<?=$theme?>">
    <?php
    the_post();    
    the_content(); 
    ?>
</main>
<?php
get_footer();