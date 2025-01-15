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

add_filter('gform_pre_send_email', function ($email, $form, $entry) {
    $form_id = 3; // Replace with your Gravity Form ID
    $hidden_field_id = 14; // Replace with your Hidden Field ID

    if ((int) $form['id'] === $form_id) {
        // Update the hidden field with the entry ID
        $entry_id = $entry['id'];
        $entry_id_ref = "FEEDBACK_" . $entry['id'];
        GFAPI::update_entry_field($entry_id, $hidden_field_id, $entry_id_ref);

        // Update the entry object for use in the email
        $entry[$hidden_field_id] = $entry_id_ref;
    }

    return $email;
}, 10, 3);