<?php
/*
Plugin Name: MtricLytics	
Plugin URI: http://wordpress.org/extend/plugins/metriclytics/
Description: Enables <a href="http://www.metriclytics.com">MetricLytics</a> on all pages.
Version: 0.2
Author: MetricLytics Team
Author URI: http://www.metriclytics.com/
*/

if (!defined('WP_CONTENT_URL'))
      define('WP_CONTENT_URL', get_option('siteurl').'/wp-content');
if (!defined('WP_CONTENT_DIR'))
      define('WP_CONTENT_DIR', ABSPATH.'wp-content');
if (!defined('WP_PLUGIN_URL'))
      define('WP_PLUGIN_URL', WP_CONTENT_URL.'/plugins');
if (!defined('WP_PLUGIN_DIR'))
      define('WP_PLUGIN_DIR', WP_CONTENT_DIR.'/plugins');

function activateMetriclytics() {
  add_option('webTokenId', '');
}

function deactive_metriclytics() {
  delete_option('webTokenId');
}

function adminInitMetriclytics() {
  register_setting('metriclytics', 'webTokenId');
}

function adminMenuMetriclytics() {
  add_options_page('MetricLytics', 'MetricLytics', 8, 'metriclytics', 'optionsPageMetriclytics');
}

function optionsPageMetriclytics() {
  include(WP_PLUGIN_DIR.'/metriclytics/options.php');  
}

function trackerMetriclytics($webTokenId=''){
	if($webTokenId!=''){
	?>
	<script language="JavaScript" src="http://t.metriclytics.com/?js" type="text/javascript"></script>
	<script language="JavaScript" type="text/javascript">
	try{ metricly.tics("<?php echo $webTokenId; ?>"); }catch(e){}
	</script><noscript><img border="0" width="0" src="http://t.metriclytics.com/?img=a&d=<?php echo $webTokenId; ?>" height="0"/></noscript>
	<?php
	}
}

function metriclytics() { 
  $webTokenId = get_option('webTokenId');
  trackerMetriclytics($webTokenId);
}

register_activation_hook(__FILE__, 'activateMetriclytics');
register_deactivation_hook(__FILE__, 'deactive_metriclytics');

if (is_admin()) {
  add_action('admin_init', 'adminInitMetriclytics');
  add_action('admin_menu', 'adminMenuMetriclytics');
}

if (!is_admin()) {
	add_action('wp_footer', 'metriclytics');
}

?>