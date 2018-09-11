<?php
/**
 * Server side processing for ACME Filter rules.
 *
 * @since 1.0
 */
final class BB_Logic_Rules_ACME_Filter {
	/**
	 * Sets up callbacks for conditional logic rules.
	 *
	 * @since  1.0
	 * @return void
	 */
	static public function init() {


		$ACME_rules = array(
			'acme_filter/acme_field-demo' => __CLASS__ . '::site_actions'
		);

		/**
		 * Check for the existance of a certain class maybe? Here it
		 * checks for ACF but can be anything.
		 */
		if ( ! class_exists( 'acf' ) ) {
			/**
			 * because there is at least one rule return has been commented out.
			 * if the whole filter would be dependent of acf you can gracefully return
			 */
			// return;
		} else {

			// if exists merge in the rules that depend on this 'acf' class
			$ACME_rules = array_merge(
				$ACME_rules ,
				array(
					// default acf filters
					'acme_filter/archive-field' 		=> __CLASS__ . '::archive_field',
					'acme_filter/option-field' 			=> __CLASS__ . '::option_field',
					'acme_filter/post-field' 			=> __CLASS__ . '::post_field',
					'acme_filter/post-author-field' 	=> __CLASS__ . '::post_author_field',
					'acme_filter/user-field' 			=> __CLASS__ . '::user_field',
				)
			);

		}



		/**
		 * Register a list of Logic Rules that we can query.
		 * Here, we declare 5 options, each calling a different callback
		 * when applied to the conditional logic
		 *
		 * ORDER of 'options' here doesn't matter but should match options in index.js
		 */
		BB_Logic_Rules::register( $ACME_rules );

	}

	/**
	 * Archive field rule.
	 *
	 * @since  1.0
	 * @param object $rule
	 * @return bool
	 */
	static public function archive_field( $rule ) {
		$object = get_queried_object();

		if ( ! is_object( $object ) || ! isset( $object->taxonomy ) || ! isset( $object->term_id ) ) {
			$id = 'archive';
		} else {
			$id = $object->taxonomy . '_' . $object->term_id;
		}

		return self::evaluate_rule( $id, $rule );
	}

	/**
	 * Option field rule.
	 *
	 * @since  1.0
	 * @param object $rule
	 * @return bool
	 */
	static public function option_field( $rule ) {
		return self::evaluate_rule( 'option', $rule );
	}

	/**
	 * Post field rule.
	 *
	 * @since  1.0
	 * @param object $rule
	 * @return bool
	 */
	static public function post_field( $rule ) {
		global $post;
		$id = is_object( $post ) ? $post->ID : 0;
		return self::evaluate_rule( $id, $rule );
	}

	/**
	 * Post author field rule.
	 *
	 * @since  1.0
	 * @param object $rule
	 * @return bool
	 */
	static public function post_author_field( $rule ) {
		global $post;
		$id = is_object( $post ) ? $post->post_author : 0;
		return self::evaluate_rule( 'user_' . $id, $rule );
	}

	/**
	 * User field rule.
	 *
	 * @since  1.0
	 * @param object $rule
	 * @return bool
	 */
	static public function user_field( $rule ) {
		$user = wp_get_current_user();
		return self::evaluate_rule( 'user_' . $user->ID, $rule );
	}


	/**
	 *	DEMO Callback: Do some check on the blogs info
	 *
	 *  @param  objecet $rule
	 *  @return  bool
	 */
	static public function site_actions( $rule ) {

		//var_dump( get_bloginfo( $rule->siteaction ));

		$value = get_bloginfo( $rule->siteaction );

		// note that here we use the BB_Logic_Rules class,
		// NOT the self::evaluate_rule
		return BB_Logic_Rules::evaluate_rule( array(
			'value' 	=> $value,
			'operator' 	=> $rule->operator,
			'compare' 	=> $rule->compare,
			'isset'		=> $value
		));
	}

	/**
	 * Helper function to Process a rule based on the
	 * object ID of the * field location. Note that for
	 * ACF $object_id may also be 'option' or 'user_' . $id
	 *
	 * @since  1.0
	 * @param string $object_id
	 * @param object $rule
	 * @return bool
	 */
	static public function evaluate_rule( $object_id = false, $rule ) {

		// get the value of whatever we are querying
		// $object_id can be $id, 'option', 'user_' . $id
		$value = get_field( $rule->key, $object_id );

		if ( is_array( $value ) ) {
			$value = empty( $value ) ? 0 : 1;
		} elseif ( is_object( $value ) ) {
			$value = 1;
		}

		return BB_Logic_Rules::evaluate_rule( array(
			'value' 	=> $value,
			'operator' 	=> $rule->operator,
			'compare' 	=> $rule->compare,
			'end'		=> $rule->end,
			'isset' 	=> $value,
		) );
	}


}
BB_Logic_Rules_ACME_Filter::init();
