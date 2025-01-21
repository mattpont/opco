<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<?php
if ( !is_page(array(57,61,65)) ) {
?>
<div id="footer-top"></div>
<div class="wrapper mt-5 fixed-bottom" id="wrapper-footer">
	<div class="container">
		<div class="row">
		    <div class="col-lg-4"></div>
		    <div class="col-lg-4 text-center">
				<a href="/help/" class="btn btn-primary d-block rounded-pill">Help</a>
			</div>
		    <div class="col-lg-4"></div>
		</div>
	</div>
</div><!-- #wrapper-footer -->
<?php
} elseif ( is_page(array(57,65)) ) {
?>
<div id="footer-top"></div>
<?php
}
?>

<?php // Closing div#page from header.php. ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>