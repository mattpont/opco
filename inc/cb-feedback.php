<?php
add_shortcode( 'feedbackform', 'feedbackform' );
function feedbackform() {
ob_start();

$datereported = date("Y-m-d h:i:sa");
?>
<style>
.bg-grey,
.nav-tabs .nav-link.active {
    background-color: #e5e5e5;
}

.nav-tabs .nav-link {
    background-color: #fff;
}

@media (max-width: 1199.98px) {
    .nav-sml {
        font-size: 0.6rem !important;
    }
}
</style>
<div class="row mb-3">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link d-none active" id="nav-start-tab" data-bs-toggle="tab" data-bs-target="#nav-start" type="button" role="tab" aria-controls="nav-start" aria-selected="true"></button>
                <button class="nav-link border border-dark border-bottom-0 text-secondary p-lg-3 p-1 pt-3 col-4" id="nav-speak-tab" data-bs-toggle="tab" data-bs-target="#nav-speak" type="button" role="tab" aria-controls="nav-speak" aria-selected="false">
                    <i class="fa-regular fa-comment fa-2xl" style="color: #1d4220;"></i>
                    <div class="mt-3 mb-2 fs-6 nav-sml">Speak Up</div>
                </button>
                <button class="nav-link border border-dark border-bottom-0 text-secondary p-lg-3 p-1 pt-3 col-4" id="nav-recommendation-tab" data-bs-toggle="tab" data-bs-target="#nav-recommendation" type="button" role="tab" aria-controls="nav-recommendation" aria-selected="false">
                    <i class="fa-regular fa-lightbulb fa-2xl" style="color: #1d4220;"></i>
                    <div class="mt-3 mb-2 fs-6 nav-sml">Recommendation</div>
                </button>
                <button class="nav-link border border-dark border-bottom-0 text-secondary p-lg-3 p-1 pt-3 col-4" id="nav-compliment-tab" data-bs-toggle="tab" data-bs-target="#nav-compliment" type="button" role="tab" aria-controls="nav-compliment" aria-selected="false">
                    <i class="fa-regular fa-thumbs-up fa-2xl" style="color: #1d4220;"></i>
                    <div class="mt-3 mb-2 fs-6 nav-sml">Compliment</div>
                </button>
            </div>
        </nav>
        <div class="tab-content bg-grey p-3 border border-dark border-top-0" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-start" role="tabpanel" aria-labelledby="nav-start-tab" tabindex="0">
                <p>Please select your form above.</p>
            </div>
            <div class="tab-pane fade" id="nav-speak" role="tabpanel" aria-labelledby="nav-speak-tab" tabindex="0">
                <?php echo do_shortcode('[gravityform id="4" title="false" ajax="true" field_values="&datereported=' . $datereported . '"]'); ?>
            </div>
            <div class="tab-pane fade" id="nav-recommendation" role="tabpanel" aria-labelledby="nav-recommendation-tab" tabindex="0">
                <?php echo do_shortcode('[gravityform id="5" title="false" ajax="true" field_values="&datereported=' . $datereported . '"]'); ?>
            </div>
            <div class="tab-pane fade" id="nav-compliment" role="tabpanel" aria-labelledby="nav-compliment-tab" tabindex="0">
                <?php echo do_shortcode('[gravityform id="6" title="false" ajax="true" field_values="&datereported=' . $datereported . '"]'); ?>
            </div>
        </div>
    </div>
    <div class="col-lg-3"></div>
</div>
<?php
return ob_get_clean();
}

add_action('gform_pre_submission', function ($form) {
    $numbers = [3, 4, 5];
    $hidden_field_id = 14; // Replace with your Hidden Field ID

    if (in_array($form['id'], $numbers)) {
        // Generate a placeholder value for the hidden field
        $unique_id = uniqid('andwishub_', true);
        $_POST['input_' . $hidden_field_id] = $unique_id;
    }
});