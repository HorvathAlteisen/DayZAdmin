<?php

require_once('exception.inc.php');

class Template {

	private static $instance;
	private $defaultData;

	private $actionPath;

	private function __construct($arguments) {

		$this->params                    = $arguments->get('params');
		$this->basePath                  = $arguments->get('basePath');
		$this->modulePath                = $arguments->get('modulePath');
		$this->moduleName                = $arguments->get('moduleName');
		$this->themesPath                = $arguments->get('themesPath');
		$this->themeName                 = $arguments->get('themeName');
		$this->actionName                = $arguments->get('actionName');
		$this->viewName                  = $arguments->get('viewName');
		$this->headerName                = $arguments->get('headerName');
		$this->footerName                = $arguments->get('footerName');
		$this->useCleanUrls              = $arguments->get('useCleanUrls');
		$this->missingActionModuleAction = $arguments->get('missingActionModuleAction', false);
		$this->missingViewModuleAction   = $arguments->get('missingViewModuleAction', false);
		$this->referer                   = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
	}

	public static function getInstance($arguments) {

		if(!self::$instance) {
			self::$instance = new Template($arguments);
		}

		return self::$instance;

	}

	public function setDefaultData(array &$data) {

		$this->defaultData = $data;
		return $data;

	}

	public function render() {

		$app = ACMS::getInstance();

		$this->actionPath = $this->createPath(array($this->modulePath, $this->moduleName, $this->actionName));

		$this->checkFileForExistence($this->actionPath, $this->missingViewModuleAction);

		$this->viewPath = $this->createPath(array($this->themesPath, $this->themeName,$this->moduleName, $this->actionName));

		$this->checkFileForExistence($this->viewPath, $this->missingViewModuleAction);

		// Action File - PHP code part of the Module
		include($this->actionPath);

		// Header File
		include($this->createPath(array($this->themesPath, $this->themeName, $this->headerName)));

		// Content File - Layout part of the Module
		include($this->viewPath);

		// footer file
		include($this->createPath(array($this->themesPath, $this->themeName, $this->footerName)));

	}

	private function createPath($join = array()) {

		return sprintf('%s.php', join(DIRECTORY_SEPARATOR,$join));

	}

	private function checkFileForExistence($pathToFile, $missingViewModuleAction = array(), $override = false) {

		if(count($missingViewModuleAction) == 0) {

			// Throws an Exception because no array was given
			throw new ACMSException("Error! No ");

			return false;
		} elseif(!file_exists($pathToFile)) {

			$this->moduleName = $this->missingActionModuleAction[0];
			$this->actionName = $this->missingActionModuleAction[1];
			$this->viewName	  = $this->missingActionModuleAction[1];

		}

		return true;
	}
}
?>