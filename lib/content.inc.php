<?php
require_once('lib/Config.inc.php');
require_once('lib/exception.inc.php');
require_once('lib/template.inc.php');

class Content {

	private static $instance;

	private $modConfig;

	private $defaultModule;

	private function __construct($pathToConfigFile) {

		$this->modConfig = new Config($pathToConfigFile);

	}

	public static function getInstance($pathToConfigFile) {

		if(!self::$instance) {
			self::$instance = new Content($pathToConfigFile);
		}

		return self::$instance;
	}

	public function setDefaultModule($defaultModule) {
		$this->defaultModule = $defaultModule;
	}

	public function render($config = array()) {

		echo 'test Content';

		$config 		= new Config($config);
		$arguments		= $config->get('arguments');
		$modulePath		= $config->get('modulePath');
		$themesPath		= $config->get('themesPath');
		$defaultModule  = $config->get('defaultModule');
		$themeName		= $config->get('themeName');
		$defaultAction	= $config->get('defaultAction');
		$missingActionModuleAction	= $config->get('missingActionModuleAction');
		$missingViewModuleAction	= $config->get('missingViewModuleAction');


		/*$include = sprintf("%s/%s/%s.php",$config->get("themesPath"),$config->get('themeName'),"header");
		if (file_exists($include)) {
			include($include);
		}*/

		if(!$defaultModule) {

			throw new ACMSException('');

		} else if(!$defaultAction) {

			throw new ACMSException('');

		}

		if(!$arguments) {
			$arguments = &$_REQUEST;
		}

		$args = new Config($parameters);
		$baseURI = ACMS::config('baseURI');

		if($args->get('module')) {
			$safetyArr = array('..', '/', '\\');
			$moduleName = str_replace($safetyArr, '', $arg->get('action'));

			if($args->get('action')) {
				$actionName = str_replace($safetyArr, '', $args->get('action'));
			} else {
				$actionName = $defaultAction;
			}

		} elseif(!$args->get('module') && !$args->get('action')) {
			$moduleName = $defaultModule;
			$actionName = $actionName;
		}


		$args->set('module', $moduleName);
		$args->set('action', $actionName);

		$templateArgs = array(
			'args'		=> $args,
			'basePath'	=> $basePath,
			'modulePath'=> $moduleName,
			'themePath'	=> $themeName,
			'themeName'	=> $actionName,
			'actionName'=> $actionName,
			'viewName'	=> $actionName,
			'headerName'=> 'header',
			'footerName'=> 'footer',
			'missingActionModuleAction' => $missingActionModuleAction,
			'missingViewModuleAction'	=> $missingViewModuleAction,
			'useCleanUrls'				=> $useCleanUrls
		);

		echo 'test Content';

		$templateArguments	= new Config($templateArgs);
		$template = Template::getInstance($templateArguments);

		$template->render();
	}
}
?>