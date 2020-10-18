<?php

/**
 * Cartzilla engine room
 *
 * @package cartzilla
 */

/**
 * Assign the Cartzilla version to a var
 */
$theme              = wp_get_theme('cartzilla');
$cartzilla_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width)) {
    $content_width = 980; /* pixels */
}

$cartzilla = (object) array(
    'version'    => $cartzilla_version,

    /**
	 * Initialize all the things.
	 */
    'main'       => require get_template_directory() . '/inc/class-cartzilla.php',
    'customizer' => require get_template_directory() . '/inc/customizer/class-cartzilla-customizer.php',
);

/**
 * TGM Plugin Activation class.
 */
require get_template_directory() . '/classes/class-tgm-plugin-activation.php';

/**
 * Customizer Functions.
 */
require get_template_directory() . '/inc/customizer/cartzilla-customizer-functions.php';

/**
 * Departments Menu Walker
 */
require get_template_directory() . '/classes/walkers/class-cartzilla-walker-departments-menu.php';

/**
 * Menu Walker
 */
require get_template_directory() . '/classes/walkers/class-wp-bootstrap-navwalker.php';

/**
 * Category Walker
 */
require get_template_directory() . '/classes/walkers/class-cartzilla-walker-category.php';

/**
 * Custom Comment Walker template.
 */
require get_template_directory() . '/classes/walkers/class-cartzilla-walker-comment.php';

/**
 * Functions used in Cartzilla
 */
require get_template_directory() . '/inc/cartzilla-functions.php';

/**
 * Hooks and Filters used in Cartzilla
 */
require get_template_directory() . '/inc/cartzilla-template-hooks.php';

/**
 * Tags and Functions used in Cartzilla
 */
require get_template_directory() . '/inc/cartzilla-template-functions.php';

if (function_exists('cartzilla_is_jetpack_activated') && cartzilla_is_jetpack_activated()) {
    require get_template_directory() . '/inc/jetpack/cartzilla-jetpack-functions.php';
}

if (cartzilla_is_woocommerce_activated()) {
    $cartzilla->woocommerce                  = require get_template_directory() . '/inc/woocommerce/class-cartzilla-woocommerce.php';
    $cartzilla->woocommerce_customizer       = require get_template_directory() . '/inc/woocommerce/class-cartzilla-woocommerce-customizer.php';

    require get_template_directory() . '/inc/woocommerce/cartzilla-woocommerce-template-hooks.php';
    require get_template_directory() . '/inc/woocommerce/cartzilla-woocommerce-template-functions.php';
    require get_template_directory() . '/inc/woocommerce/integrations.php';
}

if (cartzilla_is_dokan_activated()) {
    $cartzilla->dokan_customizer = require get_template_directory() . '/inc/dokan/class-cartzilla-dokan-customizer.php';
    require get_template_directory() . '/inc/dokan/cartzilla-dokan-functions.php';
    require get_template_directory() . '/inc/dokan/cartzilla-dokan-template-hooks.php';
    require get_template_directory() . '/inc/dokan/cartzilla-dokan-template-functions.php';
}

if (cartzilla_is_wedocs_activated()) {
    $cartzilla->wedocs               = require get_template_directory() . '/inc/wedocs/class-cartzilla-wedocs.php';
    $cartzilla->wedocs_customizer    = require get_template_directory() . '/inc/wedocs/class-cartzilla-wedocs-customizer.php';

    require get_template_directory() . '/inc/wedocs/cartzilla-wedocs-template-hooks.php';
    require get_template_directory() . '/inc/wedocs/cartzilla-wedocs-template-functions.php';
    require get_template_directory() . '/inc/wedocs/cartzilla-wedocs-functions.php';
}

if (cartzilla_is_ocdi_activated()) {
    require get_template_directory() . '/inc/ocdi/hooks.php';
    require get_template_directory() . '/inc/ocdi/functions.php';
}

/**
 * Functions used for Cartzilla Custom Theme Color
 */
require get_template_directory() . '/inc/cartzilla-custom-color-functions.php';

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */
add_filter('woocommerce_checkout_create_order', 'mbm_alter_shipping', 10, 1);
function mbm_alter_shipping($order, $data)
{

    echo "<pre>";
    print_r($order->get_billing_postcode());
    echo "</pre>";
    // die();

    // return $order;
}

// 
// 

// add_action('woocommerce_after_checkout_validation', 'checkout_postcode_validation', 10, 2);
// function checkout_postcode_validation($fields, $errors)
// {
//     var_dump($fields);
//     // die();
//     // if ($fields['billing_postcode'] !== '6000') {
//         //     $errors->add('validation', 'Shipping is not avaiable with this ' . $fields['billing_postcode'] . ' post code');
//         // }

// }

// function my_woocommerce_add_error($error)
// {
//     if ('The generic error message' == $error) {
//         $error = 'The shiny brand new error message';
//     }
//     return $error;
// }
// add_filter('woocommerce_add_error', 'my_woocommerce_add_error');

// function validate($data, $errors)
// {
//     var_dump($data);
//     // Do your data processing here and in case of an 
//     // error add it to the errors array like:
//     $errors->add('validation', __('Please input that correctly.'));
// }
// add_action('woocommerce_after_checkout_validation', 'validate', 10, 2);



//////


/**
 * Process the checkout
 **/
add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');

function my_custom_checkout_field_process()
{

    $postcode = array(
        array("SA", 5701, 'WOOLUNDUNGA'),
        array("WA", 6740, "DRYSDALE RIVER"),
        array("WA", 6740, "MITCHELL PLATEAU"),
        array("WA", 6740, "OOMBULGURRI"),
        array("WA", 6740, "KALUMBURU"),
        array("WA", 6740, "PRINCE REGENT RIVER"),
        array("WA", 6740, "WYNDHAM"),
        array("WA", 6743, "WARMUN"),
        array("WA", 6743, "CAMBRIDGE GULF"),
        array("WA", 6743, "LAKE ARGYLE"),
        array("WA", 6743, "DURACK"),
        array("WA", 6743, "GIBB"),
        array("WA", 6743, "KUNUNURRA"),
        array("TAS", 7151, "HEARD ISLAND"),
        array("TAS", 7151, "DAVIS"),
        array("TAS", 7151, "MAWSON"),
        array("TAS", 7151, "MACQUARIE ISLAND"),
        array("TAS", 7151, "MCDONALD ISLANDS"),
        array("TAS", 7151, "CASEY"),
    );
    foreach (WC()->cart->get_cart() as $cart_item) {
        $product = $cart_item['data'];
        if (!empty($product)) {
            // $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->ID ), 'single-post-thumbnail' );
            echo "<pre>";
            print_r($product->get_id());
            echo "</pre>";
            // to display only the first product image uncomment the line bellow
            // break;
        }
    }

    // Check if set, if its not set add an error.
    if (!$_POST['przetwarzanie_danych_do_zamowienia']) {

        wc_add_notice(__('Please select required box'), 'error');
    }
}

add_filter('woocommerce_checkout_fields', 'partial_unsetting_checkout_fields');
function partial_unsetting_checkout_fields($fields)
{
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_postcode']);

    return $fields;
}
add_filter('woocommerce_default_address_fields', 'art_override_default_address_fields');
function art_override_default_address_fields($address_fields)
{

    // @ for state
    $address_fields['billing_state']['type'] = 'select';
    $address_fields['billing_state']['class'] = array('form-row form-group col-sm-6 address-field validate-required');
    $address_fields['billing_state']['required'] = true;
    $address_fields['billing_state']['label'] = __('State', 'my_theme_slug');
    $address_fields['billing_state']['placeholder'] = __('Enter state', 'my_theme_slug');
    $address_fields['billing_state']['default'] = 'act';
    $address_fields['billing_state']['options'] = array(
        'ACT' => 'Australian Capital Territory',
        'NSW' => 'New South Wales',
        'NT' => 'Northern Territory',
        'QLD' => 'Queensland',
        'SA' => 'South Australia',
        'TAS' => 'Tasmania',
        'VIC' => 'Victoria',
        'WA' => 'Western Australia',
    );

    // // @ for postcode
    // $address_fields['billing_postcode']['type'] = 'text';
    // $address_fields['billing_postcode']['class'] = array('form-row form-group col-sm-6 address-field validate-required');
    // $address_fields['billing_postcode']['required'] = true;
    // $address_fields['billing_postcode']['label'] = __('Postcode', 'my_theme_slug');
    // $address_fields['billing_postcode']['placeholder'] = __('Enter your postcode', 'my_theme_slug');

    return $address_fields;
}
add_filter('woocommerce_checkout_fields', 'addBootstrapToCheckoutFields');
function addBootstrapToCheckoutFields($fields)
{
    $fields['billing']['billing_billing_postcode']['input_class'][] = 'input-text form-control';
    return $fields;
}


