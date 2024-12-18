<?php
add_shortcode( 'finder', 'finder' );
function finder() {
ob_start();
?>
<div class="row d-none">
    <div class="col-lg-4"></div>
    <div class="col-lg-4 text-center">
        <h6 class="h6">PROGRESS</h6>
        <div class="progress mb-5">
            <div class="progress-bar bg-primary text-black" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
        </div>
    </div>
    <div class="col-lg-4"></div>
</div>

<div class="row">
    <div class="col text-center">
        <h1 class="h5">Find an andwis group company</h1>
        <h2 class="h3 mt-4 mb-5">Search by Service:</h1>
    </div>
</div>

<div class="row mb-3">
    <div class="col-lg-4"></div>
    <div class="col-lg-4 text-center">
        <select class="selectpicker w-100" data-live-search="true" title="Please type to filter these services...">
<?php
$terms = get_terms( array(
    'taxonomy'   => 'division', // Swap in your custom taxonomy name
    'hide_empty' => false,
    'order_by' => 'name',
    'order' => 'ASC',
    'parent' => 0
));

// Loop through all terms with a foreach loop
foreach( $terms as $term ) {
    // Use get_term_link to get terms permalink
    // USe $term->name to return term name
    //echo '<option value="/division/'. esc_attr( $term->slug ) .'/" data-tokens="'. get_term_link( $term ) .'">'. $term->name .'</option>';
    $terms_children = get_terms( array(
        'taxonomy'   => 'division', // Swap in your custom taxonomy name
        'hide_empty' => false,
        'order_by' => 'name',
        'order' => 'ASC',
        'parent' => $term->term_id
    ));
    foreach( $terms_children as $child ) {
        echo '<option value="/division/'. esc_attr( $child->slug ) .'/" data-tokens="'. str_replace("-"," ",$term->slug) .' '. str_replace("-"," ",$child->slug) .'">'. $term->name .' - '. $child->name .'</option>';
    }
}
?>
        </select>
    </div>
    <div class="col-lg-4"></div>
</div>

<div class="row mb-5">
    <div class="col text-center">
        <button id="nextbutton" class="btn btn-primary">Next ></button>
    </div>
</div>

<div class="row">
    <div class="col text-center">
        <h2 class="h3 mt-4 mb-5">Search by Division:</h1>
    </div>
</div>

<div class="row mb-5">
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

<script>
jQuery( document ).ready(function($) {
    $('#nextbutton').on('click', function() {
        window.location = $(".selectpicker").val();
    });
});
</script>
<?php
return ob_get_clean();
}