<?php
	if (version_compare(PHP_VERSION, '5.2.1', '<')) {
		echo '<h2>Error</h2>';
		echo '<p>PHP 5.2.1 or higher is required to use ACMS.</p>';
		echo '<p>You are running '.PHP_VERSION.'</p>';
		exit;
	}

	define('ROOT', str_replace('\\', '/', dirname(__FILE__)));
	define('MODULE_DIR', 'module');
	define('THEMES_DIR', 'themes');
	define('LIB_DIR', 'lib');
	define('CONFIG_DIR', 'config');

	require_once('config.php');
	require_once('lib/acms.inc.php');
	require_once('lib/content.inc.php');

	session_start();

	ACMS::getInstance('config/app.json');

	$content = Content::getInstance('config/modules.json');

	$content->setDefaultModule(ACMS::config('defaultModule'));

	$content->render(array(
		'basePath'		=> ACMS::config('BaseURI'),
		'useCleanUrls'	=> ACMS::config('UseCleanUrls'),
		'modulePath'	=> MODULE_DIR,
		'themesPath'	=> THEMES_DIR,
		'themeName'		=> ACMS::config('defaultTheme'),
		'defaultAction' => ACMS::config('defaultAction'),
		'missingActionModuleAction'	=>	array(
											'main'	=> 'page_not_found',
											'main'	=> 'page_not_found'),
		'missingViewModuleAction'	=>	array(
											'main'	=> 'page_not_found',
											'main'	=> 'page_not_found')
	));
?>
