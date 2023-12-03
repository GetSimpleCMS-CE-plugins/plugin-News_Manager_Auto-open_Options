<?php
/*
	Plugin: News Manager Auto-open Post Options
	Requires: GetSimple CMS 3.1+, News Manager plugin

	To enable auto-open only when creating new posts, add this to your site's gsconfig.php file:
	define('NMAUTOOPEN','new');
	To enable auto-open only when editing existing posts:
	define('NMAUTOOPEN','edit');
	To disable auto-open without deactivating the plugin:
	define('NMAUTOOPEN',0);
*/

# get correct id for plugin
$thisfile = basename(__FILE__, '.php');

# register plugin
register_plugin(
	$thisfile,
	'News Manager Auto-open Post Options',
	'0.2',
	'Carlos Navarro',
	'http://www.cyberiada.org/cnb/',
	'Automatically open the post options when editing News Manager posts'
);

add_action('footer', 'nmautoopen_footer_include');

function nmautoopen_footer_include() {
	if (basename($_SERVER['PHP_SELF']) == 'load.php' && isset($_GET['id']) && $_GET['id'] == 'news_manager' && isset($_GET['edit'])) {
		$nmautoopen = defined('NMAUTOOPEN') ? trim(NMAUTOOPEN) : true;
		if ($nmautoopen && ($nmautoopen !== 'new' || empty($_GET['edit'])) && ($nmautoopen !== 'edit' || !empty($_GET['edit']))) {
			?>
			<script type="text/javascript">
				$(function() {
					$("#metadata_window").slideToggle('fast');
					$("#metadata_toggle").toggleClass('current');    
				});
			</script>
			<?php
		}
	}
}
