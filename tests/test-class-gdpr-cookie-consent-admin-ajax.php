<?php
/**
 * Class Test_Gdpr_Cookie_Consent_Ajax
 *
 * @package Gdpr_Cookie_Consent
 * @subpackage Gdpr_Cookie_Consent/Tests
 */

/**
 * Required file.
 */
require_once ABSPATH . 'wp-admin/includes/ajax-actions.php';

/**
 * Unit test cases for ajax request.
 *
 * @package    Gdpr_Cookie_Consent
 * @subpackage Gdpr_Cookie_Consent/Tests
 * @author     WPEka <hello@wpeka.com>
 */
class Test_Gdpr_Cookie_Consent_Admin_Ajax extends WP_Ajax_UnitTestCase {
	/**
	 * Class Instance.
	 *
	 * @var object $gdpr_cookie_consent Class Instance
	 * @access public
	 */
	public static $gdpr_cookie_consent;

	/**
	 * Class Instance.
	 *
	 * @var object $gdpr_cookie_consent_admin Class Instance
	 * @access public
	 */
	public static $gdpr_cookie_consent_admin_ajax;

	/**
	 * Set up function.
	 *
	 * @param class WP_UnitTest_Factory $factory class instance.
	 */
	public static function wpSetUpBeforeClass( WP_UnitTest_Factory $factory ) {
		self::$gdpr_cookie_consent            = new Gdpr_Cookie_Consent();
		self::$gdpr_cookie_consent_admin_ajax = new Gdpr_Cookie_Consent_Admin();
	}
	/**
	 * Test for gdpr_cookie_consent_ajax_restore_default_settings
	 */
	public function test_gdpr_cookie_consent_ajax_restore_default_settings() {
		$this->_setRole( 'administrator' );
		$_POST['security'] = wp_create_nonce( 'restore_default_settings' );
		try {
			$this->_handleAjax( 'gcc_restore_default_settings' );
		} catch ( WPAjaxDieContinueException $e ) {
			unset( $e );
		}
		$updated_options  = get_option( 'GDPRCookieConsent-9.0' );
		$expected_options = self::$gdpr_cookie_consent->gdpr_get_default_settings();
		$this->assertEquals( $updated_options, $expected_options );
	}
}