<?php
/**
 * Post model
**/
class EH_User_Model {

	public $user;

	public function __construct() {

		//dump();

	}

	/**
	 * Set user
	 *
	 * @param $user
	 */
	public function set($user) {
		$this->user = $user;
	}

	/**
	 * Get user
	 *
	 * @return mixed
	 */
	public function get() {
		return $this->user;
	}

	/**
	 * Activate user
	 *
	 * @param $user_id integer
	 */
	public function activate( $user_id ) {
		global $wpdb;
		$wpdb->update( $wpdb->users, array( 'user_activation_key' => '' ), array( 'ID' => $user_id ) );
	}

	/**
	 * Check if user activated
	 *
	 * @param null $user_id
	 *
	 * @return bool
	 */
	public function activated( $user_id=0 ) {
		if ( !$user_id ) {
			$user = wp_get_current_user();
			if ( !empty($user->ID) ) $user_id = $user->ID;
		}

		if ( $user_id ) {
			$user = get_user_by( 'ID', $user_id );
			if ( empty($user->data->user_activation_key ) || preg_match('/^[0-9]+:/', $user->data->user_activation_key) ) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Get user information
	 **/
	public function get_user_details( $user_id = 0, $account=false ) {
		global $eh_core;

		if ( !$user_id ) $user_id = $this->user->ID;

		/*

			if ( is_user_logged_in() ) {
				$user = wp_get_current_user();
				if ( !empty($user->ID) ) $user_id = $user->ID;
			}
		}
		*/
		if ( !$user_id ) return null;

		$meta = get_user_meta($user_id);
		//dd($user);

		if ( !$account ) {
			$data = array(
				'country'   => ! empty( $meta['_eh_user_country'][0] ) ? $meta['_eh_user_country'][0] : '',
				'firstname' => ! empty( $meta['first_name'][0] ) ? $meta['first_name'][0] : '',
				'lastname'  => ! empty( $meta['last_name'][0] ) ? $meta['last_name'][0] : '',
				'city'      => ! empty( $meta['_eh_user_city'][0] ) ? $meta['_eh_user_city'][0] : '',
				'state'     => ! empty( $meta['_eh_user_state'][0] ) ? $meta['_eh_user_state'][0] : '',
				'address'   => ! empty( $meta['_eh_user_address'][0] ) ? $meta['_eh_user_address'][0] : '',
				'zip'       => ! empty( $meta['_eh_user_zip'][0] ) ? $meta['_eh_user_zip'][0] : '',
				'tel'       => ! empty( $meta['_eh_user_tel'][0] ) ? $meta['_eh_user_tel'][0] : '',
				'mob'       => ! empty( $meta['_eh_user_mob'][0] ) ? $meta['_eh_user_mob'][0] : '',
			);
		} else {
			$data = array(
				'plan_id'   => !empty($meta['_eh_account_plan_id'][0]) ? $meta['_eh_account_plan_id'][0]:'',
				'period'    => !empty($meta['_eh_account_period'][0]) ? $meta['_eh_account_period'][0]:'',
				'type'      => !empty($meta['_eh_account_type'][0]) ? $meta['_eh_account_type'][0]:'',

				'country'   => !empty($meta['_eh_account_country'][0]) ? $meta['_eh_account_country'][0]:'',
				'firstname' => !empty($meta['_eh_account_firstname'][0]) ? $meta['_eh_account_firstname'][0]:'',
				'lastname'  => !empty($meta['_eh_account_lastname'][0]) ? $meta['_eh_account_lastname'][0]:'',
				'city'      => !empty($meta['_eh_account_city'][0]) ? $meta['_eh_account_city'][0]:'',
				'state'     => !empty($meta['_eh_account_state'][0]) ? $meta['_eh_account_state'][0]:'',
				'zip'       => !empty($meta['_eh_account_zip'][0]) ? $meta['_eh_account_zip'][0]:'',
				'address'   => !empty($meta['_eh_account_address'][0]) ? $meta['_eh_account_address'][0]:'',
			);
		}
		$data['email'] = $eh_core->model->user->data->user_email;
		$data['result'] = 'Ok';

		//dd($data);
		return $data;

	}

	/**
	 * Update user information
	 **/
	public function update_user_details( $user_id = 0, $data, $account=false ) {

		if ( !$user_id ) $user_id = $this->user->ID;

		if ( !$account ) {
			update_user_meta( $user_id, 'first_name', $data['firstname'] );
			update_user_meta( $user_id, 'last_name', $data['lastname'] );
			update_user_meta( $user_id, '_eh_user_country', $data['country'] );
			update_user_meta( $user_id, '_eh_user_state', $data['state'] );
			update_user_meta( $user_id, '_eh_user_city', $data['city'] );
			update_user_meta( $user_id, '_eh_user_address', $data['address'] );
			update_user_meta( $user_id, '_eh_user_zip', $data['zip'] );
		} else {
			if ( !empty($data['source']) && $data['source']=='order' ) {
				update_user_meta( $user_id, '_eh_account_plan_id', $data['plan_id'] );
				update_user_meta( $user_id, '_eh_account_period', $data['period'] );
				update_user_meta( $user_id, '_eh_account_type', $data['type'] );
			}

			update_user_meta( $user_id, '_eh_account_firstname', $data['firstname'] );
			update_user_meta( $user_id, '_eh_account_lastname', $data['lastname'] );
			update_user_meta( $user_id, '_eh_account_country', $data['country'] );
			update_user_meta( $user_id, '_eh_account_state', $data['state'] );
			update_user_meta( $user_id, '_eh_account_city', $data['city'] );
			update_user_meta( $user_id, '_eh_account_address', $data['address'] );
			update_user_meta( $user_id, '_eh_account_zip', $data['zip'] );
		}

		wp_update_user( array( 'ID' => $user_id, 'user_email' => $data['email'] ) );
	}

	/**
	 * Register user
	 **/
	public function register_user( $data ) {

		// Check email
		if ( email_exists($data['email']) ) {
			return array('error' => __('User with a such email already exists', 'engine-hosting-core' ));
		}

		// Check user name
		$user_name = mb_strtolower( $data['firstname'], 'UTF-8' );
		$user_id = username_exists( $user_name );
		if ( $user_id ) {
			return array('error' => __('User with a such name already exists', 'engine-hosting-core'));
		}

		/**
		 * Create user
		 */
		if ( empty($data['password']) ) {
			// Generate password
			$data['password'] = wp_generate_password( $length = 6, $include_standard_special_chars = false );
		}

		$user_id = wp_create_user( $user_name, $data['password'], $data['email'] );

		if ($user_id && is_int((int)$user_id))
		{
			$wp_user_object = new WP_User($user_id);

			$wp_user_object->set_role('customer');

			// Generate and update activation key
			$activation_key = md5( $data['password'] );
			//$activation_key = sha1($salt . $user_email . uniqid(time(), true));

			global $wpdb;
			$wpdb->update( $wpdb->users, array( 'user_activation_key' => $activation_key ), array( 'ID' => $user_id ) );
		} else
			return array('error' => __('Cannot register user', 'engine-hosting-core'));

		return array(
			'user_id'       => $user_id,
			'user_name'     => $user_name,
			'user_passwd'   => $data['password'],
			'new_user'      => true,
			'activation_key'=> $activation_key
		);
	}


	public function __get( $name ) {
		return $this->user->$name;
	}

}
