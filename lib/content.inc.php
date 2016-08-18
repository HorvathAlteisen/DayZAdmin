<?php
require_once('lib/Config.inc.php');

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

		$config 		= new Config($config);
		$parameters		= $config->get('parameters');
		$modulePath		= $config->get('modulePath');
		$themesPath		= $config->get('themesPath');
		$defaultModule= $config->get('defaultModule');
		$themeName		= $config->get('themeName');
		$defaultAction	= $config->get('defaultAction');
		$missingActionModuleAction	= $config->get('missingActionModuleAction');
		$missingViewModuleAction	= $config->get('missingViewModuleAction');


		$include = sprintf("%s/%s/%s.php",$config->get("themesPath"),$config->get('themeName'),"header");
		if (file_exists($include)) {
			include($include);
		}
	}

	private function get() {


	}
}
?>