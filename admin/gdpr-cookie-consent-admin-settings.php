<?php
/**
 * Provide a admin area view for the settings.
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @package    Gdpr_Cookie_Consent
 * @subpackage Gdpr_Cookie_Consent/admin
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$baseurl = '';
if ( isset( $_SERVER['PHP_SELF'] ) ) {
	$baseurl = esc_url_raw( wp_unslash( $_SERVER['PHP_SELF'] ) );
}
?>
<div class="gdpr-cookie-consent-app-container" id="gdpr-cookie-consent-settings-app">
	<c-container class="gdpr-cookie-consent-settings-container">
		<c-form id="gcc-save-settings-form" spellcheck="false" class="gdpr-cookie-consent-settings-form">
			<input type="hidden" name="gcc_settings_form_nonce" value="<?php echo wp_create_nonce( 'gcc-settings-form-nonce' ); ?>"/>
			<div class="gdpr-cookie-consent-settings-top">
				<div class="gdpr-cookie-consent-save-button">
					<c-button color="info" @click="saveCookieSettings"><span>Save Changes</span></c-button>
				</div>
			</div>
			<div class="gdpr-cookie-consent-settings-content">
				<div id="gdpr-cookie-consent-save-settings-alert">Settings saved</div>	
				<c-tabs variant="pills" ref="active_tab" class="gdpr-cookie-consent-settings-nav">
					<c-tab title="<?php esc_attr_e( 'Compliances', 'gdpr-cookie-consent' ); ?>" href="#compliances">
						<c-card>
							<c-card-header><?php esc_html_e( 'Cookie Notice', 'gdpr-cookie-consent' ); ?></c-card-header>
							<c-card-body>
								<c-row>
									<c-col class="col-sm-4"><label><?php esc_attr_e( 'Enable Cookie Notice', 'gdpr-cookie-consent' ); ?> <c-icon name="cib-google-keep" color="primary" v-c-tooltip="'<?php esc_html_e( 'Select the font.', 'gdpr-cookie-consent' ); ?>'"></c-icon></label></c-col>
									<c-col class="col-sm-8">
										<c-switch v-bind="labelIcon" v-model="cookie_is_on" id="gdpr-cookie-consent-cookie-on" variant="3d"  color="success" :checked="cookie_is_on" v-on:update:checked="onSwitchCookieEnable"></c-switch>
										<input type="hidden" name="gcc-cookie-enable" v-model="cookie_is_on">
									</c-col>
								</c-row>
								<c-row>
									<c-col class="col-sm-4"><label><?php esc_attr_e( 'Select the type of law', 'gdpr-cookie-consent' ); ?> <c-icon name="cib-google-keep" color="primary" v-c-tooltip="'<?php esc_html_e( 'Select the font.', 'gdpr-cookie-consent' ); ?>'"></c-icon></label></c-col>
									<c-col class="col-sm-8">
										<v-select class="form-group" id="gdpr-cookie-consent-policy-type" :reduce="label => label.code" :options="policy_options" v-model="gdpr_policy">
										</v-select>
										<input type="hidden" name="gcc-gdpr-policy" v-model="gdpr_policy">
									</c-col>
								</c-row>
							</c-card-body>
						</c-card>
					</c-tab>
				</c-tabs>
			</div>
			<div class="gdpr-cookie-consent-settings-bottom">
				<div class="gdpr-cookie-consent-save-button">
					<c-button color="info" @click="saveCookieSettings"><span>Save Changes</span></c-button>
				</div>
			</div>
		</c-form>
	</c-container>
</div>
<?php
