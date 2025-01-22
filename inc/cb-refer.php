<?php
add_shortcode( 'refer', 'refer' );
function refer() {
ob_start();

if (isset($_GET['company'])) {
    $args = array(
        'post_type' => 'opco',
        'p' => $_GET['company']
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            $contact_name = get_field("contact_name");
            $contact_email = get_field("contact_email");
            $contact_phone = get_field("contact_phone");
            $contact_company = get_the_title();
            }
    wp_reset_postdata();
    }
}
?>
<div class="row">
    <div class="col text-center">
        <?=get_field("referral_intro", 'option')?>
    </div>
</div>
<div class="row mb-3">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <?php echo do_shortcode('[gravityform id="2" title="false" ajax="false" field_values="company_email=' . $contact_email . '&recipient=' . $contact_company . '"]'); ?>
    </div>
    <div class="col-lg-3"></div>
</div>
<script>
//input_2_3
function initializeAutocomplete() {
    const input = document.querySelector('#input_2_3');

    if (!input) return; // Exit if the input field isn't present

    // Fetch data only once and reuse it
    fetch('<?php echo site_url(); ?>/wp-json/custom/v1/opcos')
        .then(response => response.json())
        .then(data => {
            // Initialize the autocomplete setup with fetched data
            setupAutocomplete(input, data);
        })
        .catch(error => console.error('Error fetching OPCO data:', error));
}

function setupAutocomplete(inp, arr) {
    let currentFocus;

    inp.addEventListener("input", function () {
        updateList(this.value, arr);
    });

    inp.addEventListener("focus", function () {
        updateList(this.value, arr); // Show all options on initial focus
    });

    inp.addEventListener("keydown", function (e) {
        let list = document.getElementById(this.id + "autocomplete-list");
        if (list) list = list.getElementsByTagName("div");
        if (e.keyCode === 40) {
            currentFocus++;
            addActive(list);
        } else if (e.keyCode === 38) {
            currentFocus--;
            addActive(list);
        } else if (e.keyCode === 13) {
            e.preventDefault();
            if (currentFocus > -1) {
                if (list) list[currentFocus].click();
            }
        }
    });

    function updateList(val, arr) {
        closeAllLists();
        if (!val && document.activeElement !== inp) return;

        currentFocus = -1;
        const list = document.createElement("div");
        list.setAttribute("id", inp.id + "autocomplete-list");
        list.setAttribute("class", "autocomplete-items");
        inp.parentNode.appendChild(list);

        arr.forEach(function (item) {
            if (!val || item.substr(0, val.length).toUpperCase() === val.toUpperCase()) {
                const itemDiv = document.createElement("div");
                itemDiv.innerHTML = `<strong>${item.substr(0, val.length)}</strong>${item.substr(val.length)}`;
                itemDiv.innerHTML += `<input type='hidden' value='${item}'>`;
                itemDiv.addEventListener("click", function () {
                    inp.value = this.getElementsByTagName("input")[0].value;
                    closeAllLists();
                });
                list.appendChild(itemDiv);
            }
        });
    }

    function addActive(list) {
        if (!list) return false;
        removeActive(list);
        if (currentFocus >= list.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = list.length - 1;
        list[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(list) {
        for (const item of list) {
            item.classList.remove("autocomplete-active");
        }
    }

    function closeAllLists(el) {
        const items = document.getElementsByClassName("autocomplete-items");
        for (const item of items) {
            if (el !== item && el !== inp) {
                item.parentNode.removeChild(item);
            }
        }
    }

    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}

// Use MutationObserver to detect when the input field is added dynamically
const observer = new MutationObserver((mutationsList) => {
    for (const mutation of mutationsList) {
        if (mutation.type === 'childList') {
            const input = document.querySelector('#opco-autocomplete');
            if (input) {
                initializeAutocomplete();
                break;
            }
        }
    }
});

// Start observing the parent container for changes
document.addEventListener('DOMContentLoaded', function () {
    const targetNode = document.body; // Adjust to a more specific parent container if possible
    const config = { childList: true, subtree: true }; // Monitor all child elements
    observer.observe(targetNode, config);

    // Initial page load setup
    initializeAutocomplete();
});
</script>
<?php
return ob_get_clean();
}

add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/opcos', array(
        'methods' => 'GET',
        'callback' => 'fetch_opco_data',
        'permission_callback' => '__return_true',
    ));
});

function fetch_opco_data() {
    $args = array(
        'post_type'      => 'opco',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby' => 'title',
        'order' => 'ASC',
    );

    $opco_query = new WP_Query($args);
    $opco_list = array();

    if ($opco_query->have_posts()) {
        while ($opco_query->have_posts()) {
            $opco_query->the_post();
            $opco_list[] = get_the_title();
        }
    }

    wp_reset_postdata();

    return $opco_list;
}