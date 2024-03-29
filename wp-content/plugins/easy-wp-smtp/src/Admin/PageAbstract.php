<?php

namespace EasyWPSMTP\Admin;

use EasyWPSMTP\WP;

/**
 * Class PageAbstract.
 *
 * @since 2.0.0
 */
abstract class PageAbstract implements PageInterface {

	/**
	 * @var string Slug of a tab.
	 */
	protected $slug;

	/**
	 * Tab priority.
	 *
	 * @since 2.0.0
	 *
	 * @var int
	 */
	protected $priority = 999;

	/**
	 * Tab parent page.
	 *
	 * @since 2.0.0
	 *
	 * @var ParentPageAbstract
	 */
	protected $parent_page = null;

	/**
	 * Constructor.
	 *
	 * @since 2.0.0
	 *
	 * @param ParentPageAbstract $parent_page Tab parent page.
	 */
	public function __construct( $parent_page = null ) {

		$this->parent_page = $parent_page;
	}

	/**
	 * @inheritdoc
	 */
	public function get_link() {

		$page = Area::SLUG;

		if ( $this->parent_page !== null ) {
			$page .= '-' . $this->parent_page->get_slug();
		}

		return add_query_arg(
			'tab',
			$this->slug,
			WP::admin_url( 'admin.php?page=' . $page )
		);
	}

	/**
	 * Title of a tab.
	 *
	 * @since 2.0.0
	 *
	 * @return string
	 */
	public function get_title() {

		return $this->get_label();
	}

	/**
	 * Get tab slug.
	 *
	 * @since 2.0.0
	 *
	 * @return string
	 */
	public function get_slug() {

		return $this->slug;
	}

	/**
	 * Get tab priority.
	 *
	 * @since 2.0.0
	 *
	 * @return int
	 */
	public function get_priority() {

		return $this->priority;
	}

	/**
	 * Get parent page.
	 *
	 * @since 2.0.0
	 *
	 * @return ParentPageAbstract
	 */
	public function get_parent_page() {

		return $this->parent_page;
	}

	/**
	 * Get parent page slug.
	 *
	 * @since 2.0.0
	 *
	 * @return string
	 */
	public function get_parent_slug() {

		if ( is_null( $this->parent_page ) ) {
			return '';
		}

		return $this->parent_page->get_slug();
	}

	/**
	 * Register tab related hooks.
	 *
	 * @since 2.0.0
	 */
	public function hooks() {}

	/**
	 * Register tab related ajax hooks.
	 *
	 * @since 2.0.0
	 */
	public function ajax() {}

	/**
	 * Process tab form submission ($_POST ).
	 *
	 * @since 2.0.0
	 *
	 * @param array $data $_POST data specific for the plugin.
	 */
	public function process_post( $data ) {}

	/**
	 * Process tab & mailer specific Auth actions.
	 *
	 * @since 2.0.0
	 */
	public function process_auth() {}

	/**
	 * Print the nonce field for a specific tab.
	 *
	 * @since 2.0.0
	 */
	public function wp_nonce_field() {

		wp_nonce_field( Area::SLUG . '-' . $this->slug );
	}

	/**
	 * Make sure that a user was referred from plugin admin page.
	 * To avoid security problems.
	 *
	 * @since 2.0.0
	 */
	public function check_admin_referer() {

		check_admin_referer( Area::SLUG . '-' . $this->slug );
	}

	/**
	 * Save button to be reused on other tabs.
	 *
	 * @since 2.0.0
	 */
	public function display_save_btn() {

		?>
		<button type="submit" class="easy-wp-smtp-btn easy-wp-smtp-btn--primary easy-wp-smtp-btn--lg">
			<?php esc_html_e( 'Save Settings', 'easy-wp-smtp' ); ?>
		</button>
		<?php
		$this->post_form_hidden_field();
	}

	/**
	 * Form hidden field for identifying plugin POST requests.
	 *
	 * @since 2.0.0
	 */
	public function post_form_hidden_field() {

		echo '<input type="hidden" name="easy-wp-smtp-post" value="1">';
	}
}
