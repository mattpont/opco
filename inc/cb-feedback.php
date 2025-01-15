<?php
add_shortcode( 'feedbackform', 'feedbackform' );
function feedbackform() {
ob_start();
?>

<div class="row">
    <div class="col text-center">
        <h1 class="h3 mb-5">Your contact for help</h1>
    </div>
</div>
<div class="row mb-3">
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
        <?php echo do_shortcode('[gravityform id="3" title="false" ajax="true"]'); ?>
    </div>
    <div class="col-lg-4"></div>
</div>
<?php
return ob_get_clean();
}