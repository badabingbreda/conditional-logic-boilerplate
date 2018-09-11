<?php
/**
 * @since 1.0
 */

/**
 * Check if the Theme Builder / Beaver Themer is 1.2 or higher
 */
if ( defined( 'FL_THEME_BUILDER_VERSION' ) && version_compare( FL_THEME_BUILDER_VERSION, '1.2', '>=' ) ) {

	add_action( 'bb_logic_init'				, 'acme_filter_beaver_bb_logic_init');
	add_action( 'rest_api_init' 			, 'acme_filter_beaver_bb_logic_rest' );
	add_action( 'bb_logic_enqueue_scripts'	, 'acme_filter_beaver_bb_logic_enqueue' );

}

/**
 * Enqueue the script necessary for the acme_filter rules
 * @return void
 */
function acme_filter_beaver_bb_logic_enqueue() {

	wp_enqueue_script(

		'bb-logic-rules-acme-filter',
		BOILERPLATE_URL . 'rules/acme_filter/build/index.js',
		array( 'bb-logic-core' ),
		BOILERPLATE_VERSION,
		true

	);
}

/**
 * Load the class for the rules
 * @return void
 */
function acme_filter_beaver_bb_logic_init() {

	require_once BOILERPLATE_DIR . 'rules/acme_filter/classes/class-bb-logic-rules-acme_filter.php';

}

/**
 * Load the class for the rest routes
 * @return void
 */
function acme_filter_beaver_bb_logic_rest() {

	require_once BOILERPLATE_DIR . 'rest/classes/class-bb-logic-rest-acme_filter.php';

}
