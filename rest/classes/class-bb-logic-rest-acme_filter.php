<?php

/**
 * REST API methods to retreive data for ACME Filter rules.
 *
 * test your route: //www.yourdomainname.com/wp-json/bb-logic/v1/acmefilter/actions
 *
 * @since 0.1
 */
class BB_Logic_REST_ACME_Filter {

	/**
	 * REST API namespace
	 *
	 * @since 0.1
	 * @var string $namespace
	 */
	static protected $namespace = 'bb-logic/v1/acmefilter';

	/**
	 * Register routes.
	 *
	 * @since  0.1
	 * @return void
	 */
	static public function register_routes() {
		register_rest_route(
			self::$namespace, '/actions', array(
				array(
					'methods'  => WP_REST_Server::READABLE,
					'callback' => __CLASS__ . '::actions',
				),
			)
		);

	}

	/**
	 * DEMO: Returns an array of posts with each item
	 * containing a label and value.
	 *
	 * @since  0.1
	 * @param object $request
	 * @return array
	 */
	static public function actions( $request ) {

		$response = array();

		/**
		 * should you need to pass in query_parameters with your route request
		 * you can add them here
		 *
		 */
		//$fieldtype = $request->get_param( 'fieldtype' );


			$response[] = array(
				'label' => 'Site Title',
				'value' => 'name',
			);

			$response[] = array(
				'label' => 'Site Language',
				'value' => 'language',
			);

		return rest_ensure_response( $response );


	}
}

BB_Logic_REST_ACME_Filter::register_routes();
