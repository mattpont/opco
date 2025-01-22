<?php
add_shortcode( 'help', 'help' );
function help() {
ob_start();

$company = get_query_var('company');
?>

<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6 text-center">
        <h1 class="h3 mb-5">Your contact for help</h1>
    </div>
    <div class="col-lg-3"></div>
</div>

<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6 text-center">
        <form name="formhelp" action="/help-form/" method="POST">
<?php
$args = array(
    'post_type' => 'opco',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
);
$the_query = new WP_Query( $args );

// The Loop.

echo '<select name="help_company" id="help_company" class="form-select bg-primary text-center fw-bold rounded-pill" required>';
echo '<option value="">Your Company</option>';
if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        echo '<option value="'. get_the_ID() .'">'. get_the_title() .'</option>';
    }
}
// Restore original Post Data.
wp_reset_postdata();
echo '</select>';

$args = array(
    'post_type' => 'opco',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
);
$the_query = new WP_Query( $args );

// The Loop.

echo '<select name="help_company_contact" id="help_company_contact" class="form-select bg-primary text-center fw-bold rounded-pill mt-4" required>';
echo '<option value="">Company to Contact</option>';
if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        if ( $company == get_the_ID() ) {
            echo '<option value="'. get_the_ID() .'" selected>'. get_the_title() .'</option>';
        } else {
            echo '<option value="'. get_the_ID() .'">'. get_the_title() .'</option>';
        }
    }
}
// Restore original Post Data.
wp_reset_postdata();
echo '</select>';
?>
            <button type="submit" class="btn btn-primary-reverse d-block rounded-pill mt-4 w-100">Search <i class="ms-2 fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
    <div class="col-lg-3"></div>
</div>

<?php
return ob_get_clean();
}

add_shortcode( 'helpform', 'helpform' );
function helpform() {
ob_start();
?>

<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6 text-center">
        <h1 class="h3 mb-5">Ask your cross sell administrator for help</h1>
    </div>
    <div class="col-lg-3"></div>
</div>

<?php
if (isset($_POST['help_company_contact'])) {
    $args = array(
        'post_type' => 'opco',
        'p' => $_POST['help_company_contact']
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            $contact_name = get_field("contact_name");
            $contact_email = get_field("contact_email");
            $contact_phone = get_field("contact_phone");
            $contact_company = get_the_title();
?>

    <div class="row mb-3">
        <div class="col-lg-3"></div>
        <div class="col-lg-6 text-center">
            <b>Company:</b> <?=$contact_company?>
        </div>
        <div class="col-lg-3"></div>
    </div>
<?php
    if ( get_field("contact_name") ) {
    ?>
    <div class="row mb-3">
        <div class="col-lg-3"></div>
        <div class="col-lg-6 text-center">
            <b>Name:</b> <?=$contact_name?>
        </div>
        <div class="col-lg-3"></div>
    </div>
    <?php
    }

    if ( get_field("contact_phone") ) {
    ?>
    <div class="row mb-3">
        <div class="col-lg-3"></div>
        <div class="col-lg-6 text-center">
            <b>Telephone:</b> <a href="tel:<?=$contact_phone?>"><?=$contact_phone?></a>
        </div>
        <div class="col-lg-3"></div>
    </div>
    <?php
    }
    ?>

<?php
if (isset($_POST['help_company'])) {
    $args_sender = array(
        'post_type' => 'opco',
        'p' => $_POST['help_company']
    );
    $the_query_sender = new WP_Query( $args_sender );
    if ( $the_query_sender->have_posts() ) {
        while ( $the_query_sender->have_posts() ) {
            $the_query_sender->the_post();
            $sender_name = get_field("contact_name");
            $sender_email = get_field("contact_email");
            $sender_company = get_the_title();
        }
    }
    wp_reset_postdata();
}
?>


    <div class="row mb-3">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <?php echo do_shortcode('[gravityform id="1" title="false" ajax="true" field_values="sender_email=' . $sender_email . '&contact_email=' . $contact_email . '&sender_company=' . $sender_company . '"]'); ?>
            <a href="/help/" class="btn btn-primary d-block rounded-pill mt-4 w-100">< Back</a>
        </div>
        <div class="col-lg-3"></div>
    </div>
    <?php
        }
    }
    wp_reset_postdata();    
} else { 
    ?>
    <div class="row mb-3">
        <div class="col-lg-3"></div>
        <div class="col-lg-6 text-center">
            Cannot find contact - please try again.
            <a href="/help/" class="btn btn-primary d-block rounded-pill mt-4 w-100">< Back</a>
        </div>
        <div class="col-lg-3"></div>
    </div>
    <?php
}

return ob_get_clean();
}