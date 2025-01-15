<?php
add_shortcode( 'feedbackform', 'feedbackform' );
function feedbackform() {
ob_start();

$datereported = date("Y-m-d h:i:sa");
?>
<div class="row">
    <div class="col text-center">
        <h1 class="h3 mb-5">Your contact for help</h1>
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

add_action('gform_pre_submission_3', function ($entry, $form) {
    // Specify the form ID and the hidden field ID
    $form_id = 3; // Replace with your Gravity Form ID
    $hidden_field_id = 14; // Replace with the ID of the hidden field
    // Get the entry ID
    $entry_id = $entry['id'];
    $entry_id_ref = "FEEDBACK_" . $entry['id'];

    // Update the hidden field in the entry
    GFAPI::update_entry_field($entry_id, $hidden_field_id, $entry_id_ref);
}, 10, 2);