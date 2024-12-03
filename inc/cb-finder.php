<?php
add_shortcode( 'finder', 'finder' );
function finder() {
ob_start();
?>

<div class="row">
    <div class="col text-center">
        <h1 class="h5">Find an andwis group company</h1>
        <h2 class="h3 mt-4 mb-5">Select a division:</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-4"></div>
    <div class="col-lg-4 text-center">
<?php
$terms = get_terms( array(
    'taxonomy'   => 'division', // Swap in your custom taxonomy name
    'hide_empty' => false,
    'parent' => 0
));

// Loop through all terms with a foreach loop
foreach( $terms as $term ) {
    // Use get_term_link to get terms permalink
    // USe $term->name to return term name
    echo '<a href="'. get_term_link( $term ) .'" class="btn btn-primary d-block mb-4 rounded-pill">'. $term->name .'</a>';
}
?>
    </div>
    <div class="col-lg-4"></div>
</div>

<?php
return ob_get_clean();
}