<?php
/**
 * WP-CLI `pronamic i18n make-pot` command.
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2020 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Orbis\Notifications
 */

namespace Pronamic\WordPress\Orbis\Notifications;

if ( ! \class_exists( 'WP_CLI' ) ) {
	return;
}

/*
 * The `pronamic i18n make-pot` command requires the `i18n make-pot` command.
 *
 * @link https://make.wordpress.org/cli/2017/05/03/managing-command-dependencies/
 */
\WP_CLI::add_hook(
	'after_add_command:i18n make-pot',
	function() {

		/**
		 * Title: Make pot command.
		 * Description:
		 * Copyright: 2005-2020 Pronamic
		 * Company: Pronamic
		 *
		 * @author  Remco Tolsma
		 * @version 1.0.0
		 * @since   1.0.0
		 */
		class MakePotCommand extends \WP_CLI\I18n\MakePotCommand {
			/**
			 * Command constructor.
			 */
			public function __construct() {
				parent::__construct();

				// @link https://github.com/wp-cli/i18n-command/blob/v2.0.1/src/MakePotCommand.php#L36-L44
				$this->exclude = array_diff(
					$this->exclude,
					array(
						'vendor',
					)
				);

				$this->exclude = array_merge(
					$this->exclude,
					array(
						'wordpress',
						'wp-content',
					)
				);

				$this->include = array(
					'includes',
					'src',
					'templates',
				);
			}
		}

		// @link https://github.com/wp-cli/i18n-command/blob/v2.0.1/i18n-command.php
		\WP_CLI::add_command( 'pronamic i18n make-pot', '\Pronamic\WordPress\Orbis\Notifications\MakePotCommand' );

		/*
		 * Usage example:
		 *
		 * wp pronamic i18n make-pot . languages/orbis-notifications.pot --slug="orbis-notifications"
		 */
	}
);
