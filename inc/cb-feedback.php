<?php
add_shortcode( 'feedbackform', 'feedbackform' );
function feedbackform() {
ob_start();

$datereported = date("Y-m-d h:i:sa");
?>
<div class="row">
    <div class="col text-center">
        <h1 class="h3 mb-5">Feedback</h1>
    </div>
</div>
<div class="row mb-3">
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
        <?php echo do_shortcode('[gravityform id="3" title="false" ajax="true" field_values="&datereported=' . $datereported . '"]'); ?>
    </div>
    <div class="col-lg-4"></div>
</div>
<?php
return ob_get_clean();
}

add_action('gform_pre_submission', function ($form) {
    $form_id = 3; // Replace with your Gravity Form ID
    $hidden_field_id = 14; // Replace with your Hidden Field ID

    if ((int) $form['id'] === $form_id) {
        // Generate a placeholder value for the hidden field
        $unique_id = uniqid('andwishub_', true);
        $_POST['input_' . $hidden_field_id] = $unique_id;
    }
});