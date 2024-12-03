<?php
/**
 * The template for displaying archive pages
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
$queried_object = get_queried_object();
?>

<div class="wrapper mb-5 mt-5" id="archive-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">



<?php
if ( get_query_var('region') ) {
	//We're in the region stage now...
?>
			<div class="row">
				<div class="col text-center">
					<h2 class="h3 mt-4 mb-5">Your results:</h1>
				</div>
			</div>

<?php
echo "division: " . $queried_object->term_id;
echo "<hr>";
echo "region: " . get_query_var('region');
echo "<hr>";

$args = array(
	'post_type' => 'opco',
	'posts_per_page' => -1,
	'orderby' => 'title',
	'order' => 'ASC',
	'tax_query' => array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'division',
			'field' => 'term_id',
			'terms' => $queried_object->term_id
		),
		array(
			'taxonomy' => 'region',
			'field' => 'slug',
			'terms' => get_query_var('region')
		),
	),
);
$the_query = new WP_Query( $args );

// The Loop.
if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
?>
			<div class="row">
			    <div class="col-lg-4"></div>
			    <div class="col-lg-4 text-center">
<?php
if (has_post_thumbnail( $post->ID ) ):
?>
  <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' ); ?>
  <img src="<?php echo $image[0]; ?>" class="img-fluid w-100" alt="<?=get_the_title()?>">
<?php endif; ?>
				</div>
			    <div class="col-lg-4"></div>
			</div>
<?php
	}
} else {
?>
			<div class="row">
			    <div class="col-lg-4"></div>
			    <div class="col-lg-4 text-center">
<?php
	esc_html_e( 'Sorry, no posts matched your criteria.' );
?>
				</div>
			    <div class="col-lg-4"></div>
			</div>
<?php
}
// Restore original Post Data.
wp_reset_postdata();
?>



<?php
} else {
	if ( $queried_object->parent == 0 ) {
?>
			<div class="row">
				<div class="col text-center">
					<h2 class="h3 mt-4 mb-5">Select a <?=$queried_object->name?> service:</h1>
				</div>
			</div>

			<div class="row">
			    <div class="col-lg-4"></div>
			    <div class="col-lg-4 text-center">
			<?php
			$taxonomies = get_terms( array(
				'taxonomy' => 'division',
				'hide_empty' => true,
				'parent' => $queried_object->term_id
			) );

			if ( !empty($taxonomies) ) :
				$output = '<select id="division_select" class="form-select bg-primary text-center fw-bold rounded-pill">';
				$output.= '<option value="0">Select</option>';
				foreach( $taxonomies as $category ) {
					$output.= '<option value="/division/'. esc_attr( $category->slug ) .'/">
						'. esc_html( $category->name ) .'</option>';
				}
				$output.='</select>';
				echo $output;
			endif;
			?>
				</div>
			    <div class="col-lg-4"></div>
			</div>
	<?php
	} else {
	?>
			<div class="row">
				<div class="col text-center">
					<h2 class="h3 mt-4 mb-5">Select a region:</h1>
				</div>
			</div>

			<div class="row">
			    <div class="col-lg-4"></div>
			    <div class="col-lg-4 text-center">
			<?php
			$taxonomies = get_terms( array(
				'taxonomy' => 'region',
				'hide_empty' => true,
				'parent' => 0
			) );

			if ( !empty($taxonomies) ) :
				$output = '<select id="division_select" class="form-select bg-primary text-center fw-bold rounded-pill">';
				$output.= '<option value="0">Select</option>';
				foreach( $taxonomies as $category ) {
					$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
					$output.= '<option value="'. $actual_link . "?region=" . esc_attr( $category->slug ) .'">
						'. esc_html( $category->name ) .'</option>';
				}
				$output.='</select>';
				echo $output;
			endif;
			?>
				</div>
			    <div class="col-lg-4"></div>
			</div>
<?php
	}	
}
?>

	</div><!-- #content -->

</div><!-- #archive-wrapper -->

<script>
jQuery( document ).ready(function($) {
	$('select#division_select').on('change', function() {
		console.log( this.value );
		window.location = $(this).val();
	});
});
</script>

<?php
get_footer();