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

        <div class="row">
        	<div class="col-md-12 content-area" id="primary">
            	<main class="site-main" id="main">


<?php
if ( get_query_var('region') ) {
	//We're in the region stage now...
?>
			<div class="row d-none">
			    <div class="col-lg-3"></div>
			    <div class="col-lg-6 text-center">
        			<h6 class="h6">PROGRESS</h6>
			        <div class="progress mb-5">
			            <div class="progress-bar bg-primary text-black" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
			        </div>
			    </div>
			    <div class="col-lg-3"></div>
			</div>
			<div class="row">
				<div class="col text-center">
					<h2 class="h3 mt-0 mb-5">Your results:</h1>
				</div>
			</div>

<?php
//echo "division: " . $queried_object->term_id;
//echo "<hr>";
//echo "region: " . get_query_var('region');
//echo "<hr>";

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
			    <div class="col py-2">
			    	<hr>
			    </div>
			</div>
			<div class="row">
			    <div class="col-lg-3"></div>
			    <div class="col-lg-3 text-center d-flex align-items-center">
					<?php
					if (has_post_thumbnail( $post->ID ) ):
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
					?>
						<img src="<?php echo $image[0]; ?>" class="img-fluid w-100" alt="<?=get_the_title()?>">
					<?php
					endif;
					?>
				</div>
			    <div class="col-lg-3 text-center">
			    	<a href="/refer/?company=<?=get_the_ID()?>" class="btn btn-primary d-block mb-2 rounded-pill">Refer</a>
			    	<?php
			    	if ( get_field("contact_website") ) {
			    	?>
			    	<a href="<?=get_field("contact_website")?>" target="_blank" class="btn btn-primary d-block mb-2 rounded-pill">Website</a>
			    	<?php
			    	}
			    	?>
			    	<a href="/help/?company=<?=get_the_ID()?>" class="btn btn-primary d-block mb-0 rounded-pill">Contact</a>
			    </div>
			    <div class="col-lg-3"></div>
			</div>
<?php
	}
} else {
?>
			<div class="row">
			    <div class="col-lg-3"></div>
			    <div class="col-lg-6 text-center">
					<?php esc_html_e( 'We cannot find an exact OpCo to match your search, but please enter the referral details and we will get back to you with a suggestion.' ); ?>
            		<?php echo do_shortcode('[gravityform id="1" title="false" ajax="true" field_values=""]'); ?>
			    	<button onclick="history.back()" class="btn btn-primary d-block w-100 mb-0 mt-3 rounded-pill">< Back</button>
				</div>
			    <div class="col-lg-3"></div>
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
			<div class="row d-none">
			    <div class="col-lg-3"></div>
			    <div class="col-lg-6 text-center">
        			<h6 class="h6">PROGRESS</h6>
			        <div class="progress mb-5">
			            <div class="progress-bar bg-primary text-black" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
			        </div>
			    </div>
			    <div class="col-lg-3"></div>
			</div>

			<div class="row">
				<div class="col text-center">
					<h2 class="h3 mt-0 mb-2">Search for a <?=$queried_object->name?> service:</h1>
				</div>
			</div>

			<div class="row mb-5">
			    <div class="col-lg-3"></div>
			    <div class="col-lg-6 text-center">
			        <select class="selectpicker w-100" data-live-search="true">
			<?php
			$terms = get_terms( array(
			    'taxonomy'   => 'division', // Swap in your custom taxonomy name
			    'hide_empty' => false,
				'order_by' => 'name',
				'order' => 'ASC',
			    'parent' => $queried_object->term_id
			));

			// Loop through all terms with a foreach loop
			foreach( $terms as $term ) {
			    // Use get_term_link to get terms permalink
			    // USe $term->name to return term name
			    echo '<option value="/division/'. esc_attr( $term->slug ) .'/" data-tokens="'. str_replace("-"," ",$term->slug) .'">'. $term->name .'</option>';
			}
			?>
			        </select>
			    </div>
			    <div class="col-lg-3"></div>
			</div>

			<div class="row">
				<div class="col text-center">
					<button id="nextbutton" class="btn btn-primary">Next ></button>
				</div>
			</div>

			<div class="row d-none">
				<div class="col text-center">
					<h2 class="h3 mt-0 mb-5">Or select a <?=$queried_object->name?> service:</h1>
				</div>
			</div>

			<div class="row d-none">
			    <div class="col-lg-3"></div>
			    <div class="col-lg-6 text-center">
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
			    <div class="col-lg-3"></div>
			</div>
	<?php
	} else {
	?>			
			<div class="row d-none">
			    <div class="col-lg-3"></div>
			    <div class="col-lg-6 text-center">
       				<h6 class="h6">PROGRESS</h6>
			        <div class="progress mb-5">
			            <div class="progress-bar bg-primary text-black" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
			        </div>
			    </div>
			    <div class="col-lg-3"></div>
			</div>

			<div class="row">
				<div class="col text-center">
					<h2 class="h3 mt-0 mb-5">Select a region:</h1>
				</div>
			</div>

			<div class="row">
			    <div class="col-lg-3"></div>
			    <div class="col-lg-6 text-center">
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
			    <div class="col-lg-3"></div>
			</div>
<?php
	}	
}
?>

	</div><!-- #content -->


</main>
</div>
</div>
</div><!-- #archive-wrapper -->

<script>
jQuery( document ).ready(function($) {
	$('select#division_select').on('change', function() {
		//console.log( this.value );
		window.location = $(this).val();
	});

	$('#nextbutton').on('click', function() {
		window.location = $(".selectpicker").val();
	});
});
</script>

<?php
get_footer();