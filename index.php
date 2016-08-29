<?php
	if (version_compare(PHP_VERSION, '5.2.1', '<')) {
		echo '<h2>Error</h2>';
		echo '<p>PHP 5.2.1 or higher is required to use ACMS.</p>';
		echo '<p>You are running '.PHP_VERSION.'</p>';
		exit;
	}

	define('ROOT', str_replace('\\', '/', dirname(__FILE__)));
	define('MODULE_DIR', 'modules');
	define('THEMES_DIR', 'themes');
	define('LIB_DIR', 'lib');
	define('CONFIG_DIR', 'config');

	require_once('lib/acms.inc.php');
	require_once('lib/content.inc.php');

	session_start();

	ACMS::initialize('config/app.json');
	$app = ACMS::getInstance();

	$app->initializeConnections('config/servers.json');

	$content = Content::getInstance('config/modules.json');

	$content->setDefaultModule($app->config('defaultModule'));

	$content->render(array(
		'basePath'		=> $app->config('BaseURI'),
		'useCleanUrls'	=> $app->config('UseCleanUrls'),
		'modulePath'	=> MODULE_DIR,
		'themesPath'	=> THEMES_DIR,
		'themeName'		=> $app->config('defaultTheme'),
		'defaultAction' => $app->config('defaultAction'),
		'missingActionModuleAction'	=>	array('main', 'page_not_found'),
		'missingViewModuleAction'	=>	array('main', 'page_not_found')
	));
?>