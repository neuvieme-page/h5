<?php

if ( ! function_exists( 'setup' ) ) :

function setup() {
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	/*
	 * http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu' ),
	) );
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'quote',
		'link',
	) );
}

endif;
add_action( 'after_setup_theme', 'setup' );


function h5_scripts() {
    wp_enqueue_script( 'froogaloop', 'http://a.vimeocdn.com/js/froogaloop2.min.js', true);
    // wp_enqueue_script( 'vimeo-player', 'https://player.vimeo.com/api/player.js', true);
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', ( 'https://code.jquery.com/jquery-2.1.4.min.js' ), false, null, true );
    wp_enqueue_script( 'masonry', 'https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.min.js', array('imagesloaded'), true);
    wp_enqueue_script( 'imagesloaded', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.2.0/imagesloaded.pkgd.min.js', array('jquery'), false);
	wp_enqueue_script( 'scrolldu', get_template_directory_uri() . '/assets/js/scrolldu.js', array('jquery'), true );

	wp_enqueue_script( 'mainjs', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), true );
    wp_enqueue_script( 'modernizr',  get_template_directory_uri() . '/assets/js/modernizr-custom.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'slickjs', get_template_directory_uri() . '/assets/slick-1.5.7/slick/slick.min.js', array('jquery'), true );

}
add_action( 'wp_enqueue_scripts', 'h5_scripts' );

function h5_styles() {
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/font-awesome.min.css' );
	wp_enqueue_style( 'slickcss', get_template_directory_uri() . '/assets/slick-1.5.7/slick/slick.css' );
	wp_enqueue_style( 'slickthemecss', get_template_directory_uri() . '/assets/slick-1.5.7/slick/slick-theme.css' );
	wp_enqueue_style( 'h5-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'h5_styles' );


add_filter( 'nav_menu_link_attributes', 'front_menu_atts', 10, 3 );
function front_menu_atts( $atts, $item, $args )
{
  // The ID of the target menu item
  $menu_target_news = 34;
  $menu_target_news_fr = 44;
  $menu_target_work = 93;
  $menu_target_work_fr = 43;
  $menu_target_art = 35;
  $menu_target_art_fr = 490;
  $menu_target_studio = 32;
  $menu_target_studio_fr = 491;
  $menu_target_contact = 31;
  $menu_target_contact_fr = 492;



  // inspect $item
  if ($item->ID == $menu_target_news || $item->ID == $menu_target_news_fr) {
    $atts['data-customaction'] = 'toggleClass(hidden) of .imageWrapper on mouseenter/mouseleave, toggleClass(hidden) of .sliding.news on mouseenter/mouseleave';
  }
  if ($item->ID == $menu_target_work || $item->ID == $menu_target_work_fr) {
    $atts['data-customaction'] = 'toggleClass(hidden) of .imageWrapper on mouseenter/mouseleave, toggleClass(hidden) of .sliding.work on mouseenter/mouseleave';
  }
  if ($item->ID == $menu_target_art || $item->ID == $menu_target_art_fr) {
    $atts['data-customaction'] = 'toggleClass(hidden) of .imageWrapper on mouseenter/mouseleave, toggleClass(hidden) of .sliding.art on mouseenter/mouseleave';
  }
  if ($item->ID == $menu_target_studio || $item->ID == $menu_target_studio_fr) {
    $atts['data-customaction'] = 'toggleClass(hidden) of .imageWrapper on mouseenter/mouseleave, toggleClass(hidden) of .sliding.studio on mouseenter/mouseleave';
  }
  if ($item->ID == $menu_target_contact || $item->ID == $menu_target_contact_fr) {
    $atts['data-customaction'] = 'toggleClass(hidden) of .imageWrapper on mouseenter/mouseleave, toggleClass(hidden) of .sliding.contact on mouseenter/mouseleave';
  }

  return $atts;
}

add_filter('show_admin_bar', '__return_false');

// Register mailchimp strings
pll_register_string('subscribe', 'Mailchimp subscribe', 'mailchimp', true);
pll_register_string('email', 'Mailchimp email', 'mailchimp', true);
pll_register_string('subscribebutton', 'Mailchimp subscribebutton', 'mailchimp', true);
pll_register_string('success', 'Mailchimp success', 'mailchimp', true);
pll_register_string('invalid', 'Mailchimp invalid', 'mailchimp', true);
pll_register_string('exists', 'Mailchimp user exists', 'mailchimp', true);
pll_register_string('error', 'Mailchimp generic error', 'mailchimp', true);

// Register front animation strings
pll_register_string('client_1', 'client_1', 'frontanim', true);
pll_register_string('client_2', 'client_2', 'frontanim', true);
pll_register_string('client_3', 'client_3', 'frontanim', true);
pll_register_string('client_4', 'client_4', 'frontanim', true);
pll_register_string('client_5', 'client_5', 'frontanim', true);
pll_register_string('client_6', 'client_6', 'frontanim', true);
pll_register_string('client_7', 'client_7', 'frontanim', true);
pll_register_string('client_8', 'client_8', 'frontanim', true);
pll_register_string('client_9', 'client_9', 'frontanim', true);


pll_register_string('crafts_1', 'crafts_1', 'frontanim', true);
pll_register_string('crafts_2', 'crafts_2', 'frontanim', true);
pll_register_string('crafts_3', 'crafts_3', 'frontanim', true);
pll_register_string('crafts_4', 'crafts_4', 'frontanim', true);
pll_register_string('crafts_5', 'crafts_5', 'frontanim', true);
pll_register_string('crafts_6', 'crafts_6', 'frontanim', true);
pll_register_string('crafts_7', 'crafts_7', 'frontanim', true);
pll_register_string('crafts_8', 'crafts_8', 'frontanim', true);
pll_register_string('crafts_9', 'crafts_9', 'frontanim', true);
pll_register_string('crafts_10', 'crafts_10', 'frontanim', true);

pll_register_string('philosophy_1', 'philosophy_1', 'frontanim', true);
pll_register_string('philosophy_2', 'philosophy_2', 'frontanim', true);
pll_register_string('philosophy_3', 'philosophy_3', 'frontanim', true);
pll_register_string('philosophy_4', 'philosophy_4', 'frontanim', true);
pll_register_string('philosophy_5', 'philosophy_5', 'frontanim', true);
pll_register_string('philosophy_6', 'philosophy_6', 'frontanim', true);
pll_register_string('philosophy_7', 'philosophy_7', 'frontanim', true);
pll_register_string('philosophy_8', 'philosophy_8', 'frontanim', true);
pll_register_string('philosophy_9', 'philosophy_9', 'frontanim', true);

pll_register_string('sectors_1', 'sectors_1', 'frontanim', true);
pll_register_string('sectors_2', 'sectors_2', 'frontanim', true);
pll_register_string('sectors_3', 'sectors_3', 'frontanim', true);
pll_register_string('sectors_4', 'sectors_4', 'frontanim', true);
pll_register_string('sectors_5', 'sectors_5', 'frontanim', true);
pll_register_string('sectors_6', 'sectors_6', 'frontanim', true);
pll_register_string('sectors_7', 'sectors_7', 'frontanim', true);
pll_register_string('sectors_8', 'sectors_8', 'frontanim', true);


// Set language class on body depending on language
add_filter('body_class', 'my_custom_body_class', 10, 2);
  function my_custom_body_class($classes) {
    $classes[] = get_bloginfo('language');
    return $classes;
}

/**
 * Register our sidebars and widgetized areas.
 *
 */
function h5_widgets_init() {

	register_sidebar( array(
		'name'          => 'Home right sidebar',
		'id'            => 'home_right_1',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'h5_widgets_init' );


/*
	Register admin area for api options
*/

/* ------------------------------------------------------------------------ *
 * Setting Registration
 * ------------------------------------------------------------------------ */

/**
 * Initializes the theme options page by registering the Sections,
 * Fields, and Settings.
 *
 * This function is registered with the 'admin_init' hook.
 */
add_action('admin_init', 'mailchimp_initialize_theme_options');
function mailchimp_initialize_theme_options() {

    // First, we register a section. This is necessary since all future options must belong to one.
    add_settings_section(
        'general_settings_section',         // ID used to identify this section and with which to register options
        'Mailchimp Options',                  // Title to be displayed on the administration page
        'mailchimp_general_options_callback', // Callback used to render the description of the section
        'general'                           // Page on which to add this section of options
    );

    // Next, we will introduce the fields for toggling the visibility of content elements.
    add_settings_field(
        'mailchimp_apikey',                      // ID used to identify the field throughout the theme
        'Mailchimp API key',                           // The label to the left of the option interface element
        'mailchimp_toggle_apikey_callback',   // The name of the function responsible for rendering the option interface
        'general',                          // The page on which this option will be displayed
        'general_settings_section'         // The name of the section to which this field belongs
    );

    add_settings_field(
        'mailchimp_listid',
        'Mailchimp List ID',
        'mailchimp_toggle_listid_callback',
        'general',
        'general_settings_section'
    );

    add_settings_field(
        'mailchimp_datacenter',
        'Mailchimp Datacenter ID',
        'mailchimp_toggle_datacenter_callback',
        'general',
        'general_settings_section'
    );

    // Finally, we register the fields with WordPress
    register_setting(
        'general',
        'mailchimp_apikey'
    );

    register_setting(
        'general',
        'mailchimp_listid'
    );

    register_setting(
        'general',
        'mailchimp_datacenter'
    );

} // end mailchimp_initialize_theme_options

/* ------------------------------------------------------------------------ *
 * Section Callbacks
 * ------------------------------------------------------------------------ */

/**
 * This function provides a simple description for the General Options page.
 *
 * It is called from the 'mailchimp_initialize_theme_options' function by being passed as a parameter
 * in the add_settings_section function.
 */
function mailchimp_general_options_callback() {
    echo '<p>Add details to integrate newsletter signups with mailchimp.</p>';
} // end mailchimp_general_options_callback

/* ------------------------------------------------------------------------ *
 * Field Callbacks
 * ------------------------------------------------------------------------ */

/**
 * This function renders the interface elements for toggling the visibility of the header element.
 *
 * It accepts an array of arguments and expects the first element in the array to be the description
 * to be displayed next to the checkbox.
 */
function mailchimp_toggle_apikey_callback($args) {

    // Note the ID and the name attribute of the element match that of the ID in the call to add_settings_field
    $html = '<input type="text" id="mailchimp_apikey" name="mailchimp_apikey" value="' . get_option('mailchimp_apikey') . '"/>';

    echo $html;

} // end mailchimp_toggle_apikey_callback

function mailchimp_toggle_listid_callback($args) {

    $html = '<input type="text" id="mailchimp_listid" name="mailchimp_listid" value="' . get_option('mailchimp_listid') . '"/>';

    echo $html;

} // end mailchimp_toggle_listid_callback

function mailchimp_toggle_datacenter_callback($args) {

    $html = '<input type="text" id="mailchimp_datacenter" name="mailchimp_datacenter" value="' . get_option('mailchimp_datacenter') . '"/>';

    echo $html;

} // end mailchimp_toggle_datacenter_callback


add_shortcode('geoloc', 'geoloc');

$geoipCache = array();

function geolocate($ip) {
	global $geoipCache;

	// Fail fast for nonsense IP
	$iplen = strlen($ip);
	if ($iplen < 3 || $iplen > 40)
		return false;

	if (isset($geoipCache[$ip]))
		return $geoipCache[$ip];

	$entry = getUrlContent(array(
		'url' => 'https://telize-v1.p.mashape.com/geoip/' . $ip,
		'headers' => array(
			'X-Mashape-Key' => 'eBml0LPRaHmshK8v0rVKPOBN1gh7p1ycvSHjsn1VdweOlxhd3J'
		)
	));
	if ($entry) {
		$entry = $entry['responseBody'];
		$geoipCache[$ip] = $entry;
		return $entry;
	}
	return false;
}

function requestorLoc() {
	$loc = false;

	if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if (isset($_SERVER['REMOTE_ADDR']))
		$ip = $_SERVER['REMOTE_ADDR'];
	else
		$ip = '';

	// Test hack
	//$ip = '88.206.249.45';

	if ($ip)
		$loc = geolocate($ip);

	return $loc;
}

function geoloc($atts) {
	if (isset($atts['from-lat']) && isset($atts['from-lon']) ) {
		$lat = floatval($atts['from-lat']);
		$lon = floatval($atts['from-lon']);

		$loc = requestorLoc();

		if ($loc
				&& isset($loc['latitude'])
				&& isset($loc['longitude'])) {
			return strval(intval(distanceKm($lat, $lon,
				$loc['latitude'], $loc['longitude'])));
		}

		return '[unknown]';
	} else if (isset($atts['key'])) {
		$loc = requestorLoc();

		return isset($loc[$atts['key']])
			? $loc[$atts['key']]
			: '[invalid geoloc key]';
	}
}

function distanceKm($lat1, $lon1, $lat2, $lon2) {
    $deg2rad = 3.14159265328979323 / 180.0;
    $φ1 = $lat1 * $deg2rad;
    $φ2 = $lat2 * $deg2rad;
    $Δλ = ($lon2-$lon1) * $deg2rad;
    $R = 6371; // gives d in km
	$d = acos( sin($φ1) * sin($φ2) +
               cos($φ1) * cos($φ2) *
               cos($Δλ) ) * $R;
    return $d;
}

add_action("wp_ajax_subscribe", "subscribe");
add_action("wp_ajax_nopriv_subscribe", "subscribe");

function getUrlContent($options){
	$ch = curl_init();
	try {
		curl_setopt($ch, CURLOPT_URL, $options['url']);

		if (isset($options['username']) && isset($options['password']))
			curl_setopt($ch, CURLOPT_USERPWD,
				$options['username'] . ":" . $options['password']);

		curl_setopt($ch, CURLOPT_USERAGENT,
			'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);

		if (isset($options['body']))
			curl_setopt($ch, CURLOPT_POSTFIELDS,
				$options['body'] );
		if (isset($options['contentType']))
			curl_setopt($ch, CURLOPT_HTTPHEADER,
				array('Content-Type: ' . $options['contentType']));
		if (isset($options['headers'])) {
			foreach ($options['headers'] as $name => $value)
				curl_setopt($ch, CURLOPT_HTTPHEADER,
					array($name . ':' . $value));
		}

		$data = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

		$contentTypeParts = explode('; ', $contentType);

		if ($contentTypeParts[0] === 'application/json'
				|| $contentTypeParts[0] === 'application/problem+json')
			$data = json_decode($data, true);

		return array(
			'responseCode' => $httpcode,
			'responseType' => $contentType,
			'responseBody' => $data
		);
	} finally {
		curl_close($ch);
	}
}

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class($classes, $item){
     if( in_array('current-menu-item', $classes) ){
             $classes[] = 'active ';
     }
     return $classes;
}




add_filter( 'parse_query', 'exclude_pages_from_admin' );
function exclude_pages_from_admin($query) {
    global $pagenow,$post_type;
    if (is_admin() && $pagenow=='edit.php' && $post_type =='page') {
        $query->query_vars['post__not_in'] = array('2342');
    }
}
add_filter('wp_list_pages_excludes', 'exclude_from_wp_list_pages');
function exclude_from_wp_list_pages($exclude_array){
$exclude_array = $exclude_array + array('2342');
return $exclude_array;
}

/*
function remove_core_updates(){
global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}

add_filter('pre_site_transient_update_core','remove_core_updates');
add_filter('pre_site_transient_update_plugins','remove_core_updates');
add_filter('pre_site_transient_update_themes','remove_core_updates');
*/

// Add an email to the subscriber list
function subscribe() {
	$email = $_REQUEST['email'];
	$fname = $_REQUEST['fname'];
	$lname = $_REQUEST['lname'];
	$apikey = get_option('mailchimp_apikey', '');
	$listid = get_option('mailchimp_listid', '');
	$dcid = get_option('mailchimp_datacenter', '');

	if ($apikey === '' || $dcid === '' || $listid === '') {
		http_response_code(500);
		echo 'Mailing list is not configured on webserver';
		return wp_die();
	}

	$response = getUrlContent(array(
		'url' => 'https://' . $dcid . '.api.mailchimp.com/3.0/lists/' . $listid . '/members',
		'username' => 'Unused',
		'password' => $apikey,
		'contentType' => 'application/json',
		'body' => json_encode(array(
		    'email_address' => $email,
    		"status" => "subscribed",
    		"merge_fields" => array(
    			"FNAME" => $fname,
        		"LNAME" => $lname
    		)
		))
	));

	if ($response['responseCode'] >= 400) {
		$result = array(
			'success' => false,
			'code' => $response['responseCode'],
			'detail' => $response['responseBody']['detail']
		);
	} else {
		$result = array(
			'success' => true
		);
	}

	http_response_code($response['responseCode']);
	header('Content-type: application/json');
	echo json_encode($result);

	wp_die();
}

?>