<?php

namespace EasyWPSMTP;

/**
 * Class ConnectionsManager.
 *
 * @since 2.0.0
 */
class ConnectionsManager {

	/**
	 * Primary connection object.
	 *
	 * @since 2.0.0
	 *
	 * @var ConnectionInterface
	 */
	private $primary_connection = null;

	/**
	 * Get the connection object that should be used for email sending.
	 *
	 * @since 2.0.0
	 *
	 * @return ConnectionInterface
	 */
	public function get_mail_connection() {

		return $this->get_primary_connection();
	}

	/**
	 * Get the primary connection object.
	 *
	 * @since 2.0.0
	 *
	 * @return ConnectionInterface
	 */
	public function get_primary_connection() {

		if ( is_null( $this->primary_connection ) ) {
			$this->primary_connection = new Connection();
		}

		return $this->primary_connection;
	}
}
