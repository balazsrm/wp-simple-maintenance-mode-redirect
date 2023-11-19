<?php
/**
 * Plugin Name: Maintenance Mode Redirect
 * Description: Redirects all non-logged-in users to a specific page when activated, excluding wp-admin and wp-login.
 * Version: 1.0
 * Author: Your Name
 */

// Add settings page
function mmr_add_settings_page() {
	add_options_page('Maintenance Mode Settings', 'Maintenance Mode', 'manage_options', 'maintenance-mode', 'mmr_settings_page');
}

// Display settings page
function mmr_settings_page() {
	?>
	<div class="wrap">
		<h2>Maintenance Mode Settings</h2>
		<form method="post" action="options.php">
			<?php
			settings_fields('maintenance-mode-settings');
			do_settings_sections('maintenance-mode-settings');
			submit_button();
			?>
		</form>
	</div>
	<?php
}

// Register settings and fields
function mmr_register_settings() {
	register_setting('maintenance-mode-settings', 'maintenance_mode_page');
	add_settings_section('main_section', null, null, 'maintenance-mode-settings');
	add_settings_field('maintenance_mode_page', 'Redirect Page', 'mmr_dropdown_pages', 'maintenance-mode-settings', 'main_section');
}

// Dropdown for selecting a page
function mmr_dropdown_pages() {
	$args = array(
		'selected' => get_option('maintenance_mode_page'),
		'name'     => 'maintenance_mode_page',
		'id'       => 'maintenance_mode_page',
		'echo'     => 1,
		'show_option_none' => '— None —',
		'option_none_value' => 0
	);
	wp_dropdown_pages($args);
}

// Add admin bar warning
function mmr_admin_bar_warning($wp_admin_bar) {
	if (get_option('maintenance_mode_page')) {
		$wp_admin_bar->add_node([
			'id'    => 'maintenance-mode-warning',
			'title' => '⚠️ Maintenance Mode Active',
			'href'  => admin_url('options-general.php?page=maintenance-mode')
		]);
	}
}

// Redirect non-logged-in users
function mmr_redirect_non_logged_in_users() {
	if (is_user_logged_in() || is_admin() || $GLOBALS['pagenow'] === 'wp-login.php') {
		return;
	}

	$redirect_page_id = get_option('maintenance_mode_page');

	if ($redirect_page_id && get_the_ID() !== $redirect_page_id) {
		$redirect_url = get_permalink($redirect_page_id);
		if ($redirect_url && !is_page($redirect_page_id)) {
			wp_redirect($redirect_url, 302);
			exit;
		}
	}
}

// Hook everything
add_action('admin_menu', 'mmr_add_settings_page');
add_action('admin_init', 'mmr_register_settings');
add_action('admin_bar_menu', 'mmr_admin_bar_warning', 100);
add_action('wp', 'mmr_redirect_non_logged_in_users');
